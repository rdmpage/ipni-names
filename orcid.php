<?php

// ORCID(s) for DOI

require_once(dirname(__FILE__) . '/lib.php');
require_once(dirname(__FILE__) . '/adodb5/adodb.inc.php');

//--------------------------------------------------------------------------------------------------
$db = NewADOConnection('mysql');
$db->Connect("localhost", 
	$config['db_user'] , $config['db_passwd'] , $config['db_name']);

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;



$obj = new stdclass;

$obj->results = array();

if (isset($_GET['doi']))
{
	
	$sql = 'SELECT * FROM doi_orcid WHERE doi="' . $_GET['doi'] . '"';
	
	$result = $db->Execute($sql);
	if ($result == false) die("failed [" . __FILE__ . ":" . __LINE__ . "]: " . $sql);

	while (!$result->EOF) 
	{	
		$hit = new stdclass;
		$hit->orcid = $result->fields['orcid'];
		$hit->name = $result->fields['name'];
		$obj->results[] = $hit;
	
		$result->MoveNext();
	}
	
	echo json_encode($obj);
	exit();
		
}

?>


