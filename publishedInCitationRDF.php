<?php

// Dump links between names and publications
require_once(dirname(__FILE__) . '/config.inc.php');
require_once(dirname(__FILE__) . '/adodb5/adodb.inc.php');

//--------------------------------------------------------------------------------------------------
$db = NewADOConnection('mysqli');
$db->Connect("localhost", 
	$config['db_user'] , $config['db_passwd'] , $config['db_name']);

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

$db->EXECUTE("set names_indexfungorum 'utf8'"); 

$result = $db->Execute('SET max_heap_table_size = 1024 * 1024 * 1024');
$result = $db->Execute('SET tmp_table_size = 1024 * 1024 * 1024');


// Get data
$page = 10;
$offset = 0;

$done = false;

// DOIs
// to do: BHL pageIDs (as annotations, see Annotation.md)

while (!$done)
{
	$sql = 'SELECT * FROM `names`';	
	//$sql .= ' WHERE doi IS NOT NULL AND doi <> ""';	
	$sql .= ' WHERE doi="10.3969/j.issn.1000-3142.2007.06.001"';
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
		
		echo "<$id> <http://rs.tdwg.org/ontology/voc/Common#publishedInCitation> <https://doi.org/" . $doi . "> . \n";
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