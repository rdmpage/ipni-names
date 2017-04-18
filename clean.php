<?php

require_once(dirname(__FILE__) . '/lib.php');
require_once(dirname(__FILE__) . '/adodb5/adodb.inc.php');



//--------------------------------------------------------------------------------------------------
$db = NewADOConnection('mysql');
$db->Connect("localhost", 
	$config['db_user'] , $config['db_passwd'] , $config['db_name']);

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

$publication = 'Blumea 61';

$sql = "SELECT * FROM names WHERE Publication LIKE '" . $publication . "%';";

$sql = "SELECT * FROM names WHERE updated > '2016-11-30'";


$result = $db->Execute($sql);
if ($result == false) die("failed [" . __FILE__ . ":" . __LINE__ . "]: " . $sql);

while (!$result->EOF) 
{	
	$Id  = $result->fields['Id'];
	$string  = $result->fields['Publication'];
	
	//echo $string. "\n";
	
	$matched = false;
	
	if (!$matched)
	{
		if (preg_match('/(?<journal>.*)\s+\d+(\(\d+\))?:\s+\d+/u', $string, $m))
		{
			//print_r($m);
			
			echo "UPDATE names SET Publication='" . $m['journal'] . "' WHERE Id='" . $Id . "';" . "\n";
		}
	}
	
$result->MoveNext();
}
	


?>


