<?php

// Dump simiflied data to csv

require_once (dirname(__FILE__) . '/adodb5/adodb.inc.php');

//--------------------------------------------------------------------------------------------------
$db = NewADOConnection('mysql');
$db->Connect("localhost", 
	'root', '', 'ipni');

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

$db->EXECUTE("set names 'utf8'"); 



$page = 1000;
$offset = 0;

$result = $db->Execute('SET max_heap_table_size = 1024 * 1024 * 1024');
$result = $db->Execute('SET tmp_table_size = 1024 * 1024 * 1024');


$done = false;

$keys = array(
	'Id',
	'Family',
	'Genus',
	'Species',
	'Infra_species',
	'Rank',
	'Full_name_without_family_and_authors',
	'Publication',
	'Collation',
	'Publication_year_full',
	'issn',
	'doi',
	'jstor',
	'biostor',
	'bhl',
	'url',
	'pdf',
	'handle',
	'isbn'
);


$file = fopen('dump.csv', 'w');

// save the column headers
fputcsv($file, $keys);


while (!$done)
{
	$sql = 'SELECT * FROM `names` LIMIT ' . $page . ' OFFSET ' . $offset;

	$result = $db->Execute($sql);
	if ($result == false) die("failed [" . __FILE__ . ":" . __LINE__ . "]: " . $sql);

	while (!$result->EOF && ($result->NumRows() > 0)) 
	{	
		$row = array();
		
		foreach ($keys as $key)
		{
			$value = $result->fields[$key];
			
			switch ($key)
			{
				case 'doi':
				    if ($value != '')
				    {
				    	$value = 'https://doi.org/' . $value;
				    }
					break;
					
				default:
					break;
			}
			$row[] = $value;
		}
		
		//echo join($delimiter, $row) . "\n";
		fputcsv($file, $row);


		$result->MoveNext();
	}
	
	
	
	if ($result->NumRows() < $page)
	{
		$done = true;
	}
	else
	{
		$offset += $page;
		
		//if ($offset > 3000) { $done = true; }
	}
	
	
}

fclose($file);



?>