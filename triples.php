<?php

// Dump IPNI as simple RDF

require_once(dirname(__FILE__) . '/adodb5/adodb.inc.php');



//--------------------------------------------------------------------------------------------------
$db = NewADOConnection('mysql');
$db->Connect("localhost", "root", "", "ipni");

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

$db->EXECUTE("set names 'utf8'"); 


$sql = "SELECT * FROM names 
WHERE `Publication_year_full` LIKE '201%' AND doi IS NOT NULL;"; //  LIMIT 100;";

/*
$sql = "SELECT * FROM names 
WHERE `Publication_year_full` LIKE '201%' AND doi IS NOT NULL AND Basionym_Id IS NOT NULL LIMIT 10;";
*/

$result = $db->Execute($sql);
if ($result == false) die("failed [" . __LINE__ . "]: " . $sql);
while (!$result->EOF) 
{
	$obj = new stdclass;
	
	$obj->Id = $result->fields['Id'];
	
	$obj->nameComplete = $result->fields['Genus'];
	
	if ($result->fields['infra_genus'] != '')
	{
		$obj->nameComplete .= ' ' . $result->fields['Rank'] . ' ' . $result->fields['infra_genus'];
	}
	
	if ($result->fields['Species'] != '')
	{
		$obj->nameComplete .= ' ' . $result->fields['Species'];
	}
	if ($result->fields['infra_species'] != '')
	{
		$obj->nameComplete .= ' ' . $result->fields['Rank'] . ' ' . $result->fields['infra_species'];
	}
	
	$obj->publishedIn = $result->fields['Publication'];
	if ($result->fields['Collation'] != '')
	{
		$obj->publishedIn .= ' ' . $result->fields['Collation'];
	}
	if ($result->fields['Publication_year_full'] != '')
	{
		$obj->publishedIn .= ' ' . $result->fields['Publication_year_full'];
	}
	if ($result->fields['doi'] != '')
	{
		$obj->doi = trim($result->fields['doi']);
	}
	if ($result->fields['Basionym_Id'] != '' && $result->fields['Basionym_Id'] != '0-0')
	{
		$obj->hasBasionym = $result->fields['Basionym_Id'];
	}
	
	
	//print_r($obj);
	
	echo '<urn:lsid:ipni.org:names:' . $obj->Id . '> <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://rs.tdwg.org/ontology/voc/TaxonName#TaxonName> .' . "\n";
	
	if (isset($obj->doi))
	{
		echo '<urn:lsid:ipni.org:names:' . $obj->Id . '> <http://rs.tdwg.org/ontology/voc/TaxonName#nameComplete> "' . $obj->nameComplete . '" .' . "\n";
	}
	if (isset($obj->publishedIn))
	{
		echo '<urn:lsid:ipni.org:names:' . $obj->Id . '> <http://rs.tdwg.org/ontology/voc/Common#publishedIn> "' . $obj->publishedIn . '" .' . "\n";
	}
	if (isset($obj->publishedIn))
	{
		echo '<urn:lsid:ipni.org:names:' . $obj->Id . '> <http://rs.tdwg.org/ontology/voc/Common#publishedInCitation> <http://identifiers.org/doi/' . $obj->doi . '> .' . "\n";
	}
	if (isset($obj->hasBasionym))
	{
		echo '<urn:lsid:ipni.org:names:' . $obj->Id . '> <http://rs.tdwg.org/ontology/voc/TaxonName#hasBasionym> <urn:lsid:ipni.org:names:' . $obj->hasBasionym . '> .' . "\n";
	}
	
	echo "\n";

	$result->MoveNext();	
}


?>


