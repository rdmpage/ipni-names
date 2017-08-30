<?php

// IPNI data browser

require_once(dirname(__FILE__) . '/config.inc.php');
require_once(dirname(__FILE__) . '/adodb5/adodb.inc.php');


//--------------------------------------------------------------------------------------------------
$db = NewADOConnection('mysql');
$db->Connect("localhost", 
	$config['db_user'] , $config['db_passwd'] , $config['db_name']);

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

$db->EXECUTE("set names 'utf8'"); 




	$name = 'Billolivia';
	
	
	$cluster_id = '';
	
	$rows = array();
	
	$sql = 'SELECT * FROM names WHERE `Full_name_without_family_and_authors` = "' . $name . '"';

	$result = $db->Execute($sql);
	if ($result == false) die("failed [" . __LINE__ . "]: " . $sql);
	while (!$result->EOF) 
	{
		$record = new stdclass;
		$record->id = $result->fields['Id'];
		$record->name = $result->fields['Full_name_without_family_and_authors'];
		$record->authors = $result->fields['Authors'];
		$record->year = $result->fields['Publication_year_full'];
		
		if (preg_match('/^(?<year>[0-9]{4})/', $record->year, $m))
		{
			$record->year = $m['year'];
		}
		
		if (preg_match('/\d+-1$/', $record->id))
		{
			$cluster_id = $record->id;
		}
		
		$rows[] = $record;
		$result->MoveNext();	
	
	}

	if ($cluster_id == '')
	{
		$cluster_id = $rows[0]->id;
	}

	echo $cluster_id . "\n";
	print_r($rows);
	
	// compare
	$same = true;
	
	$n = count($rows);
	for ($i = 1; $i < $n; $i++)
	{
		for ($j = 0; $j < $i; $j++)
		{
			//echo "$i $j \n";
			if ($rows[$i]->authors != $rows[$j]->authors)
			{
				$same = false;
			}
			/*
			if ($rows[$i]->year != $rows[$j]->year)
			{
				$same = false;
			}
			*/
		}
	}
	
	if ($same)
	{
		foreach ($rows as $row)
		{
			echo'UPDATE `names` SET cluster_id ="' . $cluster_id . '" WHERE Id="' . $row->id . '";' . "\n";
		}
	}
	
	