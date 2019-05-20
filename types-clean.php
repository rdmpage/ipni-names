<?php

require_once(dirname(__FILE__) . '/lib.php');
require_once(dirname(__FILE__) . '/fingerprint.php');
require_once(dirname(__FILE__) . '/adodb5/adodb.inc.php');


//----------------------------------------------------------------------------------------
function clean($code)
{
	$code = preg_replace('/et al/u', '', $code);

	$code = preg_replace('/[A-Z]\./u', '', $code);
	//$code = preg_replace('/\s[A-Z][A-Z]+\b/u', '', $code);
	//$code = preg_replace('/\b[A-Z]\b/u', '', $code);
	$code = preg_replace('/;/u', '', $code);
	$code = preg_replace('/\|/u', '', $code);
	$code = finger_print($code);
	$code = preg_replace('/\s\s+/u', ' ', $code);
	$code = preg_replace('/^\s+/u', '', $code);

	return $code;
}

//----------------------------------------------------------------------------------------


$debug = true;
$debug = false;



//----------------------------------------------------------------------------------------
// Type data from IPNI

//--------------------------------------------------------------------------------------------------
$db = NewADOConnection('mysqli');
$db->Connect("localhost", "root", "", "ipni");

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

$db->EXECUTE("set names 'utf8'"); 


$sql = 'SELECT * FROM rdf_specimens LIMIT 1000';

//$sql = 'SELECT * FROM rdf_specimens WHERE specimen like "% POM%" LIMIT 100';
$sql = 'SELECT * FROM rdf_specimens WHERE specimen like "% Herb.%" LIMIT 10';

$sql = 'SELECT * FROM rdf_specimens WHERE nameComplete LIKE "Trichilia%"';

$result = $db->Execute($sql);
if ($result == false) die("failed [" . __LINE__ . "]: " . $sql);
while (!$result->EOF) 
{

	$obj = new stdclass;
	
	$obj->id = $result->fields['id'];
	$obj->name = $result->fields['specimen'];
	
	if (preg_match('/(?<code>.*)\s*,\s+(?<herbarium>[^(]+)(\((?<typeoftype>\w+)\))?/', $obj->name, $m))
	{
		$code = $m['code'];		
		$obj->collector = $code; 
		
		$obj->cleaned = clean($code);
				
		$obj->code = trim($m['herbarium']);
		
		if ($m['typeoftype'] != '')
		{
			$obj->typeoftype =  $m['typeoftype'];
		}
		
		print_r($obj);
		
		// UPDATE
		
		$parts = array();
		foreach ($obj as $k => $v)
		{
			switch($k)
			{
				case 'code':
				case 'collector':
				case 'cleaned':
				case 'typeoftype':
					$parts[] = $k . '="' . addcslashes($v, '"') . '"';
					break;
			
				default:
					break;
			}
		}
		
		echo 'UPDATE rdf_specimens SET ' . join(', ', $parts) . ' WHERE id="' . $obj->id . '" AND specimen="' . addcslashes($obj->name, '"') . '";' . "\n";
		
	}

	//print_r($obj);

	$result->MoveNext();	
}



?>


