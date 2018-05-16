<?php

// Dump links between names and publications
require_once(dirname(__FILE__) . '/config.inc.php');
require_once(dirname(__FILE__) . '/adodb5/adodb.inc.php');

//--------------------------------------------------------------------------------------------------
$db = NewADOConnection('mysql');
$db->Connect("localhost", 
	$config['db_user'] , $config['db_passwd'] , $config['db_name']);

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

$db->EXECUTE("set names_indexfungorum 'utf8'"); 

$result = $db->Execute('SET max_heap_table_size = 1024 * 1024 * 1024');
$result = $db->Execute('SET tmp_table_size = 1024 * 1024 * 1024');


// Set up nanopub

$nano_date = date(DATE_ISO8601);

// URL is GitHub raw file (check that https://rawgit.com has correct mime type)
$base_uri 		= 'https://raw.githubusercontent.com/rdmpage/ipni-names/master/nanopub.nq';

$head_uri 		= $base_uri . '#head';
$assertion_uri 	= $base_uri . '#assertion';
$provenance_uri = $base_uri . '#provenance';
$pubInfo_uri	= $base_uri . '#pubInfo';

echo "<$base_uri> <http://www.nanopub.org/nschema#hasAssertion> <$assertion_uri> <$head_uri> .\n";
echo "<$base_uri> <http://www.nanopub.org/nschema#hasProvenance> <$provenance_uri> <$head_uri> .\n";
echo "<$base_uri> <http://www.nanopub.org/nschema#hasPublicationInfo> <$pubInfo_uri> <$head_uri> .\n";
echo "<$base_uri> <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://www.nanopub.org/nschema#Nanopublication> <$head_uri> .\n";

// pubInfo
echo "<$base_uri> <http://purl.org/dc/terms/created> \"$nano_date\"^^<http://www.w3.org/2001/XMLSchema#dateTime> <$pubInfo_uri> .\n";
echo "<$base_uri> <http://purl.org/pav/createdBy> <https://orcid.org/0000-0002-7101-9767> <$pubInfo_uri> .\n";
echo "<$base_uri> <http://schema.org/license> <https://creativecommons.org/publicdomain/zero/1.0/> <$pubInfo_uri> .\n";

// provenance
echo "<$assertion_uri> <http://www.w3.org/ns/prov#hadPrimarySource> <https://github.com/rdmpage/ipni-names> <$provenance_uri> .\n";

// Get data
$page = 10;
$offset = 0;

$done = false;

// DOIs
// to do: BHL pageIDs (as annotations, see Annotation.md)


while (!$done)
{
	$sql = 'SELECT * FROM `names`';	
	$sql .= ' WHERE doi IS NOT NULL AND doi <> ""';	
	$sql .= ' LIMIT ' . $page . ' OFFSET ' . $offset;

	$result = $db->Execute($sql);
	if ($result == false) die("failed [" . __FILE__ . ":" . __LINE__ . "]: " . $sql);

	while (!$result->EOF && ($result->NumRows() > 0)) 
	{	
		$id = 'urn:lsid:ipni.org:names:' . $result->fields['Id'];
		
		$doi = $result->fields['doi'];
		
		// encode any characters that will cause problems for triples		
		$doi = str_replace('<', '%3C', $doi);
		$doi = str_replace('>', '%3E', $doi);
		
		echo "<$id> <http://rs.tdwg.org/ontology/voc/Common#publishedInCitation> <https://doi.org/" . $doi . "> <$assertion_uri> . \n";
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
		
		if ($offset >= 10) { $done = true; }
	}
	
	
}
	



?>