<?php

// collation mess
// when harvestig IPNI the parsing of the collationfrom RDF somethimes failes, resulting in 
// messing up the Publication field.

require_once (dirname(__FILE__) . '/config.inc.php');
require_once (dirname(__FILE__) . '/adodb5/adodb.inc.php');

//----------------------------------------------------------------------------------------
$db = NewADOConnection('mysql');
$db->Connect("localhost", 
	$config['db_user'] , $config['db_passwd'] , $config['db_name']);

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;


$sql = 'select `Id`, `Publication` from `names` where updated > "2017-04-16"';

//$sql = 'select `Id`, `Publication` from `names` where Id="77161618-1"';

$result = $db->Execute('SET max_heap_table_size = 1024 * 1024 * 1024');
$result = $db->Execute('SET tmp_table_size = 1024 * 1024 * 1024');

$result = $db->Execute($sql);
if ($result == false) die("failed [" . __FILE__ . ":" . __LINE__ . "]: " . $sql);

while (!$result->EOF) 
{	
	$publication = $result->fields['Publication'];
	
	$matched = false;
	
	//echo $publication . "\n";
	
	$pub = '';
	
	if (!$matched) 
	{
		if (preg_match('/(?<publication>.*)\s+(?<collation>\d.*)/Uu', $publication, $m))
		{
			//print_r($m);
			$pub = $m['publication'];
			$matched = true;
		}
	}
	
	if ($matched)
	{
		$sql = 'UPDATE `names` SET `Publication`="' . $pub . '" WHERE  `Id`="' .  $result->fields['Id'] . '";'; 
		echo $sql . "\n";
	}
	


	$result->MoveNext();
}

?>