<?php

// Dump data for darwin core style export to CouchDB
require_once(dirname(__FILE__) . '/config.inc.php');
require_once(dirname(__FILE__) . '/adodb5/adodb.inc.php');

require_once (dirname(__FILE__). '/couchsimple.php');



//--------------------------------------------------------------------------------------------------
$db = NewADOConnection('mysql');
$db->Connect("localhost", 
	$config['db_user'] , $config['db_passwd'] , $config['db_name']);

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

$db->EXECUTE("set names_indexfungorum 'utf8'"); 


$page = 100;
$offset = 0;

$result = $db->Execute('SET max_heap_table_size = 1024 * 1024 * 1024');
$result = $db->Execute('SET tmp_table_size = 1024 * 1024 * 1024');


$done = false;

while (!$done)
{
	$sql = 'SELECT * FROM `names` LIMIT ' . $page . ' OFFSET ' . $offset;
	
	$name = 'Poissonia%';
	$name = 'Begonia%';
	$name = 'Agathis%';
	$name = 'Afrothismia%';
	$name = 'Thismia%';
	$name = 'Rafflesia%';
	$name = 'Begonia%';
	$name = 'Oxygyne%';
	$name = 'Schismatoglottis%';
	//$name = 'Tremulina%';
	//$name = 'Myoxanthus%';
	$name = 'Lecanorchis%';
	//$name = 'Bucephalandra%';
	//$name = 'Jaltomata%';
	//$name = 'Aphananthe%';
	$sql = 'SELECT * FROM `names` WHERE Full_name_without_family_and_authors LIKE "' . $name . '"';

	// journal
	//$sql = 'SELECT * FROM `names` WHERE Publication = "Lankesteriana"';

	
	//$sql .= ' AND updated > "2017-06-29"';
	$sql .= ' LIMIT ' . $page . ' OFFSET ' . $offset;
	
	/*
	//$id = '204916-2';
	//$id = '105873-1';
	$id = '1007000-1';
	$id = '50425702-2';
	$id = '121461-2';
	$id = '77131502-1';
	$id='77102806-1';
	$id = '1018275-2';
	$sql = 'SELECT * FROM `names` WHERE Id="' . $id . '"';
	*/

	$result = $db->Execute($sql);
	if ($result == false) die("failed [" . __FILE__ . ":" . __LINE__ . "]: " . $sql);

	while (!$result->EOF && ($result->NumRows() > 0)) 
	{	
		$obj = new stdclass;
		
		$obj->id 					= 'urn:lsid:ipni.org:names:' . $result->fields['Id'];
		
		$obj->type = 'http://rs.tdwg.org/ontology/voc/TaxonName#TaxonName';
		
		if ($result->fields['cluster_id'] != '')
		{
			$obj->cluster_id   = 'urn:lsid:ipni.org:names:' . $result->fields['cluster_id'];
		}		
		else
		{
			$obj->cluster_id = $obj->id;
		}
		
		$obj->html = '<i>' . $result->fields['Genus'] . '</i>';
		
		switch ($result->fields['Rank'])
		{
			case 'sect.':
			case 'ser.':
			case 'subgen.':
				$obj->html .= ' ' . $result->fields['Rank'] . '<i> ' . $result->fields['Infra_genus'] . '</i>';					
				break;
				
			case 'spec.':
				$obj->html .= ' <i>' . $result->fields['Species'] . '</i>';
				
				$record->name .= ' ' . $result->fields['Species'];
				break;
				
			case 'f.':
			case 'forma':
			case 'subsp.':
			case 'var.':
				$obj->html .= ' <i>' . $result->fields['Species'] . '</i> ' . $result->fields['Rank'] . ' <i>' . $result->fields['Infra_species'] . '</i>';					
				break;
			
			default:
				break;
		}
		$obj->html .= ' ' . utf8_encode($result->fields['Authors']);
		
		if ($result->fields['Publication_year_full'] != '')
		{
			$obj->html .= ', ' . $result->fields['Publication_year_full'];
		}		

		
		$obj->scientificNameID 		= 'urn:lsid:ipni.org:names:' . $result->fields['Id'];
		$obj->version 				= $result->fields['Version'];
		
		if ($result->fields['Basionym_Id'] != '')
		{
			$obj->originalNameUsageID   = 'urn:lsid:ipni.org:names:' . $result->fields['Basionym_Id'];
		}		
		if ($result->fields['Basionym'] != '')
		{
			$obj->originalNameUsage   = $result->fields['Basionym'];
		}		
		
		$obj->scientificName  		= utf8_encode($result->fields['Full_name_without_family_and_authors']);
		
		if ($result->fields['Authors'] != '')
		{
			$obj->scientificNameAuthorship  = utf8_encode($result->fields['Authors']);
		}
		
		if ($result->fields['Genus'] != '')
		{
			$obj->genus = $result->fields['Genus'];
		}	
		if ($result->fields['Species'] != '')
		{
			$obj->specificEpithet  = $result->fields['Species'];
		}		
		if ($result->fields['Infra_species'] != '')
		{
			$obj->infraspecificEpithet  = $result->fields['Infra_species'];
		}		
		
		if ($result->fields['Rank'] != '')
		{
			$obj->verbatimTaxonRank  = $result->fields['Rank'];
		}		
		
		// Classification
		$obj->kingdom 	=  'Plantae';
		
		if ($result->fields['Family'] != '')
		{
			$obj->family  = $result->fields['Family'];
		}		


		$obj->nomenclaturalCode 	= 'ICBN';
		
		
		// publication
		
		
		$publication_parts = array();
		
		if ($result->fields['Publication'] != '')
		{
			$publication_parts[] = utf8_encode($result->fields['Publication']);
			
			$obj->source = utf8_encode($result->fields['Publication']);
		}		
		if ($result->fields['Collation'] != '')
		{
			$publication_parts[] = utf8_encode($result->fields['Collation']);
		}		
		if ($result->fields['Publication_year_full'] != '')
		{
			$publication_parts[] = $result->fields['Publication_year_full'];
		}		
		
		if (count($publication_parts) > 0)
		{
			$obj->namePublishedIn = join(', ',  $publication_parts);
		}
		
		if ($result->fields['Publication_year_full'] != '')
		{
			$obj->namePublishedInYear  = $result->fields['Publication_year_full'];
		}		
		
		
		// identifiers and links
		if ($result->fields['issn'] != '')
		{
			$obj->issn  = $result->fields['issn'];
		}		
		
		if ($result->fields['doi'] != '')
		{
			$obj->doi  = $result->fields['doi'];
			$obj->doi = strtolower($obj->doi);
			
			$obj->namePublishedInID = 'doi:' . $obj->doi;
		}		
		
		if ($result->fields['jstor'] != '')
		{
			$obj->jstor  = $result->fields['jstor'];
			
			if (!isset($obj->namePublishedInID))
			{	
				$obj->namePublishedInID = 'http://www.jstor.org/stable/' . $obj->jstor;
			}
		}	
		
		if ($result->fields['biostor'] != '')
		{
			$obj->biostor  = $result->fields['biostor'];
			
			if (!isset($obj->namePublishedInID))
			{	
				$obj->namePublishedInID = 'http://biostor.org/reference/' . $obj->biostor;
			}
		}		
			
		
		if ($result->fields['url'] != '')
		{
			$obj->url  = $result->fields['url'];

			if (!isset($obj->namePublishedInID))
			{	
				$obj->namePublishedInID = $obj->url;
			}
		}	
			
		if ($result->fields['pdf'] != '')
		{
			$obj->pdf  = $result->fields['pdf'];
		}
				
		if ($result->fields['bhl'] != '')
		{
			$obj->bhl  = $result->fields['bhl'];
		}
				
		if ($result->fields['isbn'] != '')
		{
			$obj->isbn  = $result->fields['isbn'];
			
			if (!isset($obj->namePublishedInID))
			{	
				$obj->namePublishedInID = 'isbn:' . $obj->isbn;
			}
			
		}
		
		
		
		// comments
		if ($result->fields['Remarks'] != '')
		{
			$obj->taxonRemarks .= '(' . $result->fields['Remarks'] . ')';
		}
			
		if ($result->fields['updated'] != '')
		{
			$obj->timestamp  = strtotime($result->fields['updated']);
		}		
		
		// message is a text/csv (we are simulating a row in a database)
		// https://tools.ietf.org/html/rfc4180
		$doc = new stdclass;
		
		$doc->_id = $obj->id;
		$doc->{'message-timestamp'} = date("c", time());
		$doc->{'message-modified'} 	= $doc->{'message-timestamp'};
		$doc->{'message-format'} 	= 'text/csv';
		
		$doc->message = $obj;
		
		print_r($doc);
		
		
		// Upload 
		echo "CouchDB...";
		$couch->add_update_or_delete_document($doc,  $doc->_id);


		
		$count++;

		$result->MoveNext();
	}
	
	//echo "-------\n";
	
	if ($result->NumRows() < $page)
	{
		$done = true;
	}
	else
	{
		$offset += $page;
		
		//if ($offset > 3000) { $done = true; }
	}
	
	
}
	



?>