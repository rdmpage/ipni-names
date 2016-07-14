<?php

require_once (dirname(__FILE__) . '/lib.php');


$ids = array(
'77146153-1',
'77145627-1',
'77138101-1',
'77138102-1',
'77138099-1',
'77149209-1',
'77134719-1',
'77132617-1',
'77138190-1',
'77138192-1',
'77138191-1',
'77138189-1',
'77138187-1',
'77136835-1',
'77136831-1',
'60467634-2',
'77132559-1',
'77132560-1',
'77137090-1',
'77137091-1',
'77136832-1',
'77134150-1',
'77134151-1',
'77134152-1',
'77134720-1',
'77138735-1',
'77138736-1',
'77138737-1',
'77138739-1',
'77138738-1',
'77138193-1',
'77138194-1',
'77145626-1',
'77145625-1',
'77152081-1',
'77152083-1');

$ids=array(
'60466505-2',
'77142310-1',
'77142311-1',
'60466502-2',
'77142308-1',
'77142312-1',
'77142313-1',
'77142309-1',
);

$count = 0;

foreach ($ids as $id)
{
	$lsid = 'urn:lsid:ipni.org:names:' . $id;

	$url = 'http://ipni.org/' . $lsid;
	
	echo "-- $url\n";
	
	$rdf = get($url, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/600.5.17 (KHTML, like Gecko) Version/8.0.5 Safari/600.5.17');
	
	if ($rdf != '')
	{
	
		// Fix IPNI bug
		$rdf = preg_replace('/ & /', ' &amp; ', $rdf);

		$obj = new stdclass;
		$obj->Id = $id;
	
	
		// extract extra details...
		$dom= new DOMDocument;
		$dom->loadXML($rdf);
		$xpath = new DOMXPath($dom);
	
		$nodeCollection = $xpath->query ("//owl:versionInfo");
		foreach($nodeCollection as $node)
		{
			$obj->Version = $node->firstChild->nodeValue;
		}
		
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
		
			$matched = false;
		
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
	
	
		//print_r($obj);
		//echo "\n";	
	
		if (isset($obj->Collation))
		{
			$sql = 'UPDATE `names` SET `Collation` = "' . $obj->Collation . '" WHERE Id="' . $id . '";' . "\n";
			echo $sql;
		}
	
		/*
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
	
	
		$sql = 'INSERT IGNORE INTO names(' . join(',', $keys) . ') VALUES (' . join(',', $values) . ');' . "\n";
	
		echo $sql;
		*/
	
	}
	
	if (($fetch_count++ % 5) == 0)
	{
		$rand = rand(1000000, 3000000);
		echo '-- sleeping for ' . round(($rand / 1000000),2) . ' seconds' . "\n";
		usleep($rand);
	}
		
	
}

?>