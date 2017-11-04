<?php

// Fetch names that are missing

require_once (dirname(dirname(__FILE__)) . '/lib.php');



$names = array('Billolivia');

$count = 0;


foreach ($names as $name)
{
	$genus = $name;
	$species = '';
	
	if (preg_match('/(?<genus>\w+)\s+(?<species>\w+)/', $name, $m))
	{
		$genus = $m['genus'];
		$species = $m['species'];
	}

	$url = 'http://www.ipni.org/ipni/advPlantNameSearch.do?find_family='
	 . '&find_genus=' . $genus
	 . '&find_species=' . $species
	 . '&find_infrafamily=&find_infragenus=&find_infraspecies=&find_authorAbbrev=&find_includePublicationAuthors=on&find_includePublicationAuthors=off&find_includeBasionymAuthors=on&find_includeBasionymAuthors=off&find_publicationTitle=&show_extras=on&find_geoUnit='
	 . '&find_addedSince='
	 . '&find_modifiedSince=&find_isAPNIRecord=on&find_isAPNIRecord=false&find_isGCIRecord=on&find_isGCIRecord=false&find_isIKRecord=on&find_isIKRecord=false&find_rankToReturn=all&output_format=delimited&find_sortByFamily=on&find_sortByFamily=off&query_type=by_query&back_page=plantsearch';
    

	//echo $url . "\n";
	
	
	$text = get($url);
	$text = trim($text);
	
	//echo $text;
	
	//exit();

	// Get array of individual lines
	$lines = explode ("\n", $text);
	
	print_r($lines);
	
			
	// Extract headings from first line
	$parts = explode ("%", $lines[0]);
	$size=count($parts);
	$heading = array();
	for ($i=0; $i < $size; $i++)
	{
		$heading[$parts[$i]] = $i;
	}
	
	print_r($heading);
	//exit();
	
	// Read each remaining line				
	$size=count($lines);
	for ($i=1; $i < $size; $i++)
	{
		$parts = explode ("%", $lines[$i]);
			
		print_r($parts);
		echo "\n";
		
		
		$obj = new stdclass;
	
		$obj->Id = $parts[$heading["Id"]];
		$obj->Version = $parts[$heading["Version"]];
		$obj->Family = $parts[$heading["Family"]];
		$obj->Full_name_without_family_and_authors = $parts[$heading["Full name without family and authors"]];
		$obj->Authors = $parts[$heading["Authors"]];

		$obj->Publication = $parts[$heading["Publication"]];
		$obj->Collation = $parts[$heading["Collation"]];
		
		$obj->Genus = $parts[$heading["Genus"]];
		$obj->Species = $parts[$heading["Species"]];
		$obj->Infra_genus = $parts[$heading["Infra genus"]];
		$obj->Infra_species = $parts[$heading["Infra species"]];
		$obj->Rank = $parts[$heading["Rank"]];
		$obj->Remarks = $parts[$heading["Remarks"]];

		$obj->Hybrid_genus = $parts[$heading["Hybrid_genus"]];
		$obj->Hybrid = $parts[$heading["Hybrid"]];
		
		if (preg_match('/\s+(?<year>[0-9]{4})/', $parts[$heading["Reference"]], $m))
		{
			$obj->Publication_year_full = $m['year'];
		}
		
		
		// DOI
		if (preg_match('/doi:(?<doi>10\.\d+\/[a-zA-Z0-9\-\[\(\)\];\.]+)/i', $parts[$heading["Remarks"]], $m))
		{
			//print_r($m);exit();
			$obj->doi = $m['doi'];
		}
		
		
		
		// Fetch more details
		//$url = 'http://www.ipni.org/ipni/plantNameByVersion.do?id=' . $parts[$heading["Id"]] . '&version=' . $parts[$heading["Version"]]
		//	. '&output_format=lsid-metadata';
		
		//echo $url;
		$id = $parts['0'];
		$lsid = 'urn:lsid:ipni.org:names:' . $id;
		$url = 'http://ipni.org/' . $lsid;
			
		echo "-- $url\n";
	
		$rdf = get($url, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/600.5.17 (KHTML, like Gecko) Version/8.0.5 Safari/600.5.17');
		
		if ($rdf != '')
		{
		
			// Store RDF
			{
				$rdf_id = $id;
				$rdf_id = preg_replace('/-\d+$/', '', $rdf_id);
		
				$dir = floor($rdf_id / 1000);
		
				$dir = dirname(__FILE__) . "/rdf/" . $dir;
				if (!file_exists($dir))
				{
					$oldumask = umask(0); 
					mkdir($dir, 0777);
					umask($oldumask);
				}
		
				$f = $dir . '/' . $id . '.xml';
				$file = fopen($f, "w");
				fwrite($file, $rdf);
				fclose($file);
			
				if (($count++ % 5) == 0)
				{
					$rand = rand(1000000, 3000000);
					echo '...sleeping for ' . round(($rand / 1000000),2) . ' seconds' . "\n";
					usleep($rand);
				}
			
			}	
		
		
			//$rdf = get($url);
		
			//echo $rdf;
			
			
		
		
			// Fix IPNI bug
			$rdf = preg_replace('/ & /', ' &amp; ', $rdf);
		
			// extract extra details...
			$dom= new DOMDocument;
			$dom->loadXML($rdf);
			$xpath = new DOMXPath($dom);
		
			$nodeCollection = $xpath->query ("//tn:year");
			foreach($nodeCollection as $node)
			{
				$obj->Publication_year_full = $node->firstChild->nodeValue;
			}

			$nodeCollection = $xpath->query ("//tn:nameComplete");
			foreach($nodeCollection as $node)
			{
				$obj->Full_name_without_family_and_authors = $node->firstChild->nodeValue;
			}
		
			$nodeCollection = $xpath->query ("//tn:genusPart");
			foreach($nodeCollection as $node)
			{
				$obj->Genus = $node->firstChild->nodeValue;
			}

			$nodeCollection = $xpath->query ("//tn:infragenericEpithet");
			foreach($nodeCollection as $node)
			{
				$obj->Infra_genus = $node->firstChild->nodeValue;
			}

			$nodeCollection = $xpath->query ("//tn:specificEpithet");
			foreach($nodeCollection as $node)
			{
				$obj->Species = $node->firstChild->nodeValue;
			}
		
			$nodeCollection = $xpath->query ("//tn:infraspecificEpithet");
			foreach($nodeCollection as $node)
			{
				$obj->Infra_species = $node->firstChild->nodeValue;
			}
		
			$nodeCollection = $xpath->query ("//tn:rankString");
			foreach($nodeCollection as $node)
			{
				$obj->Rank = $node->firstChild->nodeValue;
			}
		
			if ($obj->Rank == 'gen.')
			{
				// tn:uninomial Diphyllocalyx
				$nodeCollection = $xpath->query ("//tn:uninomial");
				foreach($nodeCollection as $node)
				{
					$obj->Genus = $node->firstChild->nodeValue;
				}		
			}

			$nodeCollection = $xpath->query ("//tcom:publishedIn");
			foreach($nodeCollection as $node)
			{
				$publishedIn = $node->firstChild->nodeValue;
			
				$obj->Publication = $publishedIn;
			
				// debug
				$obj->publishedIn = $publishedIn;
			
				if (!$matched)
				{
					if (preg_match('/(?<publication>.*)\s+(?<collation>\d.*)\.\s+\(?(?<year>[0-9]{4})\)?/Uu', $publishedIn, $m))
					{
						$obj->Publication = $m['publication'];
						$obj->Collation = $m['collation'];
						$matched = true;
					}
				}
		
		
				if (!$matched)
				{
					if (preg_match('/(?<publication>.*)\s+(?<collation>\d.*)\.?\s+\(?(?<year>[0-9]{4})\)?/Uu', $publishedIn, $m))
					{
						$obj->Publication = $m['publication'];
						$obj->Collation = $m['collation'];
						$matched = true;
					}
				}
			}
		
			// Basionym
			// tn:basionymAuthorship
			$nodeCollection = $xpath->query ("//tn:basionymAuthorship");
			foreach($nodeCollection as $node)
			{
				$obj->Basionym_author = $node->firstChild->nodeValue;
			}
			// tn:hasBasionym
			$nodeCollection = $xpath->query ("//tn:hasBasionym/@rdf:resource");
			foreach($nodeCollection as $node)
			{
				$obj->Basionym_Id = str_replace('urn:lsid:ipni.org:names:', '', $node->firstChild->nodeValue);
			}
			
		}
		
		print_r($obj);
		echo "\n";	
		
		$keys = array();
		$values = array();
		
		foreach ($obj as $k => $v)
		{
			switch ($k)
			{
				case 'publishedIn':
					break;
					
				default:
					$keys[] = $k;
					$values[] = '"' . addcslashes($v, '"') . '"';
					break;
			}
		}
		
		$sql .= 'INSERT IGNORE INTO names(' . join(',', $keys) . ') VALUES (' . join(',', $values) . ');' . "\n";
		
		
		
	}
	
	
}

echo $sql . "\n";

//echo $sql;

?>