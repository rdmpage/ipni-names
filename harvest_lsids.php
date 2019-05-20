<?php

// Harvest data from RDF folders


function rdf2obj($rdf)
{
	// Fix IPNI bugs
	$rdf = preg_replace('/ & /', ' &amp; ', $rdf);
	$rdf = preg_replace('/< /', '&lt; ', $rdf);
	
	

	$obj = new stdclass;
	
	// extract extra details...
	$dom= new DOMDocument;
	$dom->loadXML($rdf);
	$xpath = new DOMXPath($dom);
	
	$xpath->registerNamespace("rdf", 		"http://www.w3.org/1999/02/22-rdf-syntax-ns#");
	$xpath->registerNamespace("dc", 		"http://purl.org/dc/elements/1.1/" );
	$xpath->registerNamespace("dcterms", 	"http://purl.org/dc/terms/");
	$xpath->registerNamespace("tn", 		"http://rs.tdwg.org/ontology/voc/TaxonName#");
	$xpath->registerNamespace("tm", 		"http://rs.tdwg.org/ontology/voc/Team#" );
	$xpath->registerNamespace("tcom", 		"http://rs.tdwg.org/ontology/voc/Common#" );
	$xpath->registerNamespace("p", 			"http://rs.tdwg.org/ontology/voc/Person#" );
	$xpath->registerNamespace("owl", 		"http://www.w3.org/2002/07/owl#" );
	
	
	$nodeCollection = $xpath->query ("//tn:TaxonName/@rdf:about");
	foreach($nodeCollection as $node)
	{
		$obj->Id = $node->firstChild->nodeValue;
		$obj->Id = str_replace('urn:lsid:ipni.org:names:', '', $obj->Id);
	}
	
	$nodeCollection = $xpath->query ("//owl:versionInfo");
	foreach($nodeCollection as $node)
	{
		$obj->versionInfo = $node->firstChild->nodeValue;
		$obj->Id = str_replace(':' . $obj->versionInfo, '', $obj->Id);
	}
	
	$nodeCollection = $xpath->query ("//tn:year");
	foreach($nodeCollection as $node)
	{
		$obj->year = $node->firstChild->nodeValue;
	}

	$nodeCollection = $xpath->query ("//tn:nameComplete");
	foreach($nodeCollection as $node)
	{
		$obj->nameComplete = $node->firstChild->nodeValue;
	}

	$nodeCollection = $xpath->query ("//tn:genusPart");
	foreach($nodeCollection as $node)
	{
		$obj->genusPart = $node->firstChild->nodeValue;
	}

	$nodeCollection = $xpath->query ("//tn:infragenericEpithet");
	foreach($nodeCollection as $node)
	{
		$obj->infragenericEpithet = $node->firstChild->nodeValue;
	}

	$nodeCollection = $xpath->query ("//tn:specificEpithet");
	foreach($nodeCollection as $node)
	{
		$obj->specificEpithet = $node->firstChild->nodeValue;
	}

	$nodeCollection = $xpath->query ("//tn:infraspecificEpithet");
	foreach($nodeCollection as $node)
	{
		$obj->infraspecificEpithet = $node->firstChild->nodeValue;
	}

	$nodeCollection = $xpath->query ("//tn:rankString");
	foreach($nodeCollection as $node)
	{
		$obj->rankString = $node->firstChild->nodeValue;
	}

	if ($obj->rankString == 'gen.')
	{
		// tn:uninomial Diphyllocalyx
		$nodeCollection = $xpath->query ("//tn:uninomial");
		foreach($nodeCollection as $node)
		{
			$obj->uninomial = $node->firstChild->nodeValue;
		}		
	}

	//------------------------ authors -----------------------------------------------
	$nodeCollection = $xpath->query ("//tn:authorship");
	foreach($nodeCollection as $node)
	{
		$obj->authorship = $node->firstChild->nodeValue;
	}		
	
	
	/*
	<tm:Team>
	<tm:name>Gagnon, G.P.Lewis &amp; C.E.Hughes</tm:name>
	<tm:hasMember rdf:resource="urn:lsid:ipni.org:authors:20028451-1"
	*/
	
	$nodeCollection = $xpath->query ("//tm:Team/tm:hasMember/@rdf:resource");
	foreach($nodeCollection as $node)
	{
		$obj->team[] = str_replace('urn:lsid:ipni.org:authors:', '', $node->firstChild->nodeValue);
	}
	

	//------------------------ publication--------------------------------------------
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

	//----------------------- synonyms -----------------------------------------------
	// Basionym
	// tn:basionymAuthorship
	$nodeCollection = $xpath->query ("//tn:basionymAuthorship");
	foreach($nodeCollection as $node)
	{
		$obj->basionymAuthorship = $node->firstChild->nodeValue;
	}
	// tn:hasBasionym
	$nodeCollection = $xpath->query ("//tn:hasBasionym/@rdf:resource");
	foreach($nodeCollection as $node)
	{
		$obj->hasBasionym = str_replace('urn:lsid:ipni.org:names:', '', $node->firstChild->nodeValue);
	}

	// NomenclaturalNote (e.g., replacement name)
	$nodeCollection = $xpath->query ("//tn:NomenclaturalNote");
	foreach($nodeCollection as $node)
	{
		$noteType = '';
		$nc = $xpath->query ("tn:noteType/@rdf:resource", $node);
		foreach($nc as $n)
		{
			$noteType = str_replace('http://rs.tdwg.org/ontology/voc/TaxonName#', '', $n->firstChild->nodeValue);
		}
		
		if ($noteType != '' )
		{
			$nc = $xpath->query ("tn:objectTaxonName/@rdf:resource", $node);
			foreach($nc as $n)
			{
				$obj->{$noteType} = str_replace('urn:lsid:ipni.org:names:', '', $n->firstChild->nodeValue);
			}
		}
	}
	
	// types
	/*
	<tn:typifiedBy>
<tn:NomenclaturalType>
<dc:title>Arquita mimosifolia (Griseb.) Gagnon, G.P.Lewis &amp; C.E.Hughes</dc:title>
<tn:typeName rdf:resource="urn:lsid:ipni.org:names:77148634-1"/>
</tn:NomenclaturalType>
</tn:typifiedBy>       */

/* <tn:typifiedBy>
<tn:NomenclaturalType>
<dc:title>T.M.Salter 5119, BOL (holo)</dc:title>
<tn:typeSpecimen>T.M.Salter 5119, BOL</tn:typeSpecimen>
<tn:typeOfType rdf:resource="http://rs.tdwg.org/ontology/voc/TaxonName#holo"/>
</tn:NomenclaturalType>
</tn:typifiedBy>
*/
	$nodeCollection = $xpath->query ("//tn:typifiedBy/tn:NomenclaturalType");
	foreach($nodeCollection as $node)
	{
		$nc = $xpath->query ("tn:typeName/@rdf:resource", $node);
		foreach($nc as $n)
		{
			$obj->typeName = str_replace('urn:lsid:ipni.org:names:', '', $n->firstChild->nodeValue);
		}
		$nc = $xpath->query ("tn:typeSpecimen", $node);
		foreach($nc as $n)
		{
			$typeSpecimen = $n->firstChild->nodeValue;
			
			$nnc = $xpath->query ("tn:typeOfType/@rdf:resource", $node);
			foreach($nnc as $nn)
			{
				$type = $nn->firstChild->nodeValue;
				$type = str_replace('http://rs.tdwg.org/ontology/voc/TaxonName#', '', $type);
				$typeSpecimen .= ' (' . $type . ')';
			}
			$obj->typeSpecimen[] = $typeSpecimen;

		}
		
	}

	
	
	// unset stuff if needed
	unset($obj->Publication);
	unset($obj->Collation);


	return $obj;
}

//----------------------------------------------------------------------------------------
// Extract stuff
$basedir = '/Volumes/G-DRIVE slim/ipni-rdf';
$basedir = 'rdf';
$basedir = 'rdf-1';
$basedir = '/Users/rpage/Sites/linked-data-fragments/resolvers/cache/ipni/names/';



$ids_filename 			= 'rdf_ids.txt';
$specimens_filename 	= 'rdf_specimens.txt';
$names_filename 		= 'rdf_names.tsv';

file_put_contents($ids_filename, "");
file_put_contents($specimens_filename, "Id\tnameComplete\ttypeSpecimen\n");

$headings = array("Id", "nameComplete", "authorship", "hasBasionym", "replacementNameFor");
file_put_contents($names_filename, join("\t", $headings) . "\n");


$files1 = scandir($basedir);
foreach ($files1 as $directory)
{
	if (preg_match('/^\d+$/', $directory))
	{			
		$files2 = scandir($basedir . '/' . $directory);
		foreach ($files2 as $filename)
		{
			if (preg_match('/\.xml$/', $filename))
			{	
				$xml = file_get_contents($basedir . '/' . $directory . '/' . $filename);
		
				echo $filename . "\n";
				//echo str_replace('.xml', '', $filename) . "\n";
				//echo $xml;
		
				
				$obj = rdf2obj($xml);
		
				//print_r($obj);
		
				// Ids so can see what we missed
				file_put_contents($ids_filename, $obj->Id . "\n", FILE_APPEND);
		
				// Specimens (to compare with GBIF)
				if (isset($obj->typeSpecimen))
				{
					foreach ($obj->typeSpecimen as $typeSpecimen)
					{
						file_put_contents($specimens_filename, $obj->Id . "\t" . $obj->nameComplete . "\t" . $typeSpecimen . "\n", FILE_APPEND);
					}
				}
		
				// Basic data
		
				//= array("Id", "nameComplete", "authorship", "hasBasionym", "replacementNameFor");
		
				$row = array();
		
				$row[] = $obj->Id;
				$row[] = $obj->nameComplete;
		
				if (isset($obj->authorship))
				{
					$row[] = $obj->authorship;
				}
				else
				{
					$row[] = '';
				}

				if (isset($obj->hasBasionym))
				{
					$row[] = $obj->hasBasionym;
				}
				else
				{
					$row[] = '';
				}
		
				if (isset($obj->replacementNameFor))
				{
					$row[] = $obj->replacementNameFor;
				}
				else
				{
					$row[] = '';
				}
		
				file_put_contents($names_filename, join("\t", $row) . "\n", FILE_APPEND);
				
			}
		}
	}
}

				



?>

