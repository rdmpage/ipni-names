<?php

// fix DOIs in remarks if I've not parsed them correctly

require_once (dirname(__FILE__) . '/config.inc.php');
require_once (dirname(__FILE__) . '/adodb5/adodb.inc.php');

//----------------------------------------------------------------------------------------
$db = NewADOConnection('mysqli');
$db->Connect("localhost", 
	$config['db_user'] , $config['db_passwd'] , $config['db_name']);

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;




$sql = 'select * FROM `names` WHERE `Remarks` LIKE "doi:10.15625%"';

$sql = 'select * FROM `names` WHERE `doi` ="10.1093/botlinnean"';


$result = $db->Execute('SET max_heap_table_size = 1024 * 1024 * 1024');
$result = $db->Execute('SET tmp_table_size = 1024 * 1024 * 1024');

$result = $db->Execute($sql);
if ($result == false) die("failed [" . __FILE__ . ":" . __LINE__ . "]: " . $sql);

while (!$result->EOF) 
{	
	$remarks = $result->fields['Remarks'];
	$id = $result->fields['Id'];
	
	echo "-- $remarks\n";
	
	if (preg_match('/doi:(?<doi>10\.\d+\/[a-zA-Z0-9\-\[\(\)\];\.\\/]+)/i', $remarks, $m))
	{
		echo 'UPDATE names SET doi="' . $m['doi'] . '" WHERE Id="' . $id . '";' . "\n";
	}


	$result->MoveNext();
}

?>