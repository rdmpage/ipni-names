<?php

require_once (dirname(__FILE__) . '/config.inc.php');
require_once (dirname(__FILE__) . '/adodb5/adodb.inc.php');

//----------------------------------------------------------------------------------------
$db = NewADOConnection('mysql');
$db->Connect("localhost", 
	$config['db_user'] , $config['db_passwd'] , $config['db_name']);

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

//----------------------------------------------------------------------------------------
function get_issn($journal)
{
	global $db;
	
	$issn = '';
	
	$sql = 'SELECT issn FROM `names` WHERE Publication=' . $db->qstr($journal) . ' AND `issn` IS NOT NULL LIMIT 1';
	
	$result = $db->Execute($sql);
	if ($result == false) die("failed [" . __FILE__ . ":" . __LINE__ . "]: " . $sql);
	
	if ($result->NumRows() == 1) 
	{
		$issn = $result->fields['issn'];
	}
	
	return $issn;
}


$sql = 'select distinct `Publication` from `2014` where `issn` IS NULL';

$sql = 'select distinct `Publication` from `names` where updated > "2015-12-06"';

$sql = 'select distinct `Publication` from `names` where updated > "2017-04-16"';

$result = $db->Execute('SET max_heap_table_size = 1024 * 1024 * 1024');
$result = $db->Execute('SET tmp_table_size = 1024 * 1024 * 1024');

$result = $db->Execute($sql);
if ($result == false) die("failed [" . __FILE__ . ":" . __LINE__ . "]: " . $sql);

while (!$result->EOF) 
{	
	$journal = $result->fields['Publication'];
	
	echo "-- $journal\n";
	
	$issn = get_issn($journal);
	if ($issn != '')
	{
		$sql = 'UPDATE `names` SET `issn`="' . $issn . '" WHERE  `Publication`=' . $db->qstr($journal) . ' AND DATE_SUB(CURDATE(),INTERVAL 3 DAY) <= updated;';
		echo $sql . "\n";
	}
	
	


	$result->MoveNext();
}

?>