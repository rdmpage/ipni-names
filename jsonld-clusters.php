<?php

// JSON-LD dump of one processed IPNI record (a cliuster of one or more names)

// Dump links between names and publications
require_once(dirname(__FILE__) . '/config.inc.php');
require_once(dirname(__FILE__) . '/adodb5/adodb.inc.php');

//--------------------------------------------------------------------------------------------------
$db = NewADOConnection('mysqli');
$db->Connect("localhost", 
	$config['db_user'] , $config['db_passwd'] , $config['db_name']);

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

$db->EXECUTE("set names 'utf8'"); 

$result = $db->Execute('SET max_heap_table_size = 1024 * 1024 * 1024');
$result = $db->Execute('SET tmp_table_size = 1024 * 1024 * 1024');


$cluster_id = '981551-1';

if (isset($_GET['id']))
{
	$cluster_id = $_GET['id'];
}




$sql = 'SELECT * FROM names WHERE cluster_id="' . $cluster_id . '";';


$data = new stdclass;

$data->{'@context'} = new stdclass;
$data->{'@context'}->{'@vocab'} = 'http://schema.org/';

$data->{'@context'}->tcom = 'http://rs.tdwg.org/ontology/voc/Common#';
$data->{'@context'}->tn = 'http://rs.tdwg.org/ontology/voc/TaxonName#'; 

$data->{'@id'} = 'http://bionames.org/ipni/cluster/' . $cluster_id;

$data->{'@type'} = 'DataFeed';
$data->dataFeedElement = array();


$result = $db->Execute($sql);
if ($result == false) die("failed [" . __FILE__ . ":" . __LINE__ . "]: " . $sql);

while (!$result->EOF) 
{	
	$id = 'urn:lsid:ipni.org:names:' . $result->fields['Id'];
	
	$obj = new stdclass;
	$obj->{'@id'} = 'urn:lsid:ipni.org:names:' . $result->fields['Id'];
	
	if (1)
	{
		//$obj->{'@type'} = 'tn:TaxonName';	
		$obj->{'name'} = $result->fields['Full_name_without_family_and_authors'];
	}
	
	// pick suitable guid for publication
	
	$guid = '';
	
	if ($guid == '')
	{
		if ($result->fields['biostor'] != '')
		{
			$guid = 'https://biostor.org/reference/' . strtolower($result->fields['biostor']);
		}
	}
	
	if ($guid == '')
	{
		if ($result->fields['doi'] != '')
		{
			$guid = 'https://doi.org/' . strtolower($result->fields['doi']);
		}
	}
	
	if ($guid == '')
	{
		if ($result->fields['jstor'] != '')
		{
			$guid = 'https://www.jstor.org/stable/' . strtolower($result->fields['jstor']);
		}
	}

	if ($guid == '')
	{
		if ($result->fields['handle'] != '')
		{
			$guid = 'https://hdl.handle.net/' . strtolower($result->fields['handle']);
		}
	}

	if ($guid == '')
	{
		if ($result->fields['cinii'] != '')
		{
			$guid = 'https://ci.nii.ac.jp/naid/' . strtolower($result->fields['cinii'] . '#article');
		}
	}

	if ($guid == '')
	{
		if ($result->fields['url'] != '')
		{
			$guid = $result->fields['url'];
		}
	}

	if ($guid == '')
	{
		if ($result->fields['pdf'] != '')
		{
			$guid = $result->fields['pdf'];
		}
	}
	
  	if ($guid != '')
  	{
  		$publishedInCitation = new stdclass;
  		$publishedInCitation->{'@id'} = $guid;
  		$obj->{'tcom:publishedInCitation'} = $publishedInCitation;
  	}
	
	
	// BHL?
	

	$data->dataFeedElement[]  = $obj;

	$result->MoveNext();
}

//print_r($data);

echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);



?>