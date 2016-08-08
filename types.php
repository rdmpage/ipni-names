<?php

require_once(dirname(__FILE__) . '/lib.php');
require_once(dirname(__FILE__) . '/fingerprint.php');
require_once(dirname(__FILE__) . '/adodb5/adodb.inc.php');


//----------------------------------------------------------------------------------------
function clean($code)
{
	$code = preg_replace('/et al/u', '', $code);


	$code = preg_replace('/[A-Z]\./u', '', $code);
	$code = preg_replace('/\s[A-Z][A-Z]+\b/u', '', $code);
	$code = preg_replace('/\b[A-Z]\b/u', '', $code);
	$code = preg_replace('/;/u', '', $code);
	$code = preg_replace('/\|/u', '', $code);
	$code = finger_print($code);
	$code = preg_replace('/\s\s+/u', ' ', $code);
	$code = preg_replace('/^\s+/u', '', $code);

	return $code;
}


$debug = true;
$debug = false;

$nub = 'd7dddbf4-2cf0-4f39-9b2a-bb099caae36c';

$name = 'Scutellaria albituba';
//$name = 'Scutellaria sipilensis';
//$name = 'Scutellaria tenuipetiolata';

$name = 'Garcinia obliqua';
$name = 'Begonia masoalaensis';
$name = 'Begonia aequatoguineensis';
$name = 'Begonia scottii';
$name = 'Begonia brevipedunculata';
$name = 'Begonia rantemarioensis';

$name = '';

$ipni_id = '77112438-1';
//$ipni_id = '1000479-1';
//$ipni_id = '77112736-1';
$ipni_id = '77112736-1';

if (isset($_GET['id']))
{
	$ipni_id = $_GET['id'];
}
if (isset($_GET['debug']))
{
	$debug=true;
}

$api_obj = new stdclass;
$api_obj->results = array();

//----------------------------------------------------------------------------------------
// Type data from IPNI

//--------------------------------------------------------------------------------------------------
$db = NewADOConnection('mysql');
$db->Connect("localhost", "root", "", "ipni");

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;


$ipni_types = array();

$sql = 'SELECT * FROM rdf_specimens WHERE id="' . $ipni_id . '"';

$result = $db->Execute($sql);
if ($result == false) die("failed [" . __LINE__ . "]: " . $sql);
while (!$result->EOF) 
{
	$code = $result->fields['specimen'];
	
	if (preg_match('/(?<code>.*),\s+(?<herbarium>[A-Z]+)\s+(\((?<typeoftype>\w+)\))?/', $code, $m))
	{
		$code = $m['code'];
		$code = clean($code);
		$ipni_types[$m['herbarium']][] = $code;
	}
	
	$name = $result->fields['nameComplete'];

	$result->MoveNext();	
}



if ($debug)
{
	echo '<pre>';
	print_r($ipni_types);
	echo '</pre>';
}
//exit();

//----------------------------------------------------------------------------------------
// Type data from GBIF
$id = 0;


// 1. find GBIF id


$url = 'http://api.gbif.org/v1/species?name=' . urlencode($name) . '&datasetKey=' . $nub;

//echo $url . "\n";

$json = get($url);

//echo $json;

$obj = json_decode($json);

if (count($obj->results) == 1)
{
	$id = $obj->results[0]->key;
}

if ($id != 0)
{
	// get types
	
	// FFS it's broken
	
	//$url = 'http://api.gbif.org/v1/species/' . $id . '/typeSpecimens';
	
	$url = 'http://api.gbif.org/v1/occurrence/search?taxonKey=' . $id . '&typeStatus=*';
	
	//echo $url;
	
	$json = get($url);

	$obj = json_decode($json);
	
	//print_r($obj);
	
	
	$gbif_types = array();
	
	
	
	foreach ($obj->results as $occurrence)
	{
		$code = '';
		
		$institutionCode = $occurrence->institutionCode;
		
		switch ($occurrence->institutionCode)
		{
			case 'BPBM':
				$institutionCode ='BISH';
				if (isset($occurrence->recordedBy))
				{
					$code = $occurrence->recordedBy;
				}
				if (isset($occurrence->recordNumber))
				{
					$code .= ' ' . $occurrence->recordNumber;
				}
				$code = str_replace('Collector Number:', '', $code);
				break;
		
			case 'UEFS':
				$institutionCode ='HUEFS';
				if (isset($occurrence->recordedBy))
				{
					$code = $occurrence->recordedBy;
				}
				if (isset($occurrence->recordNumber))
				{
					$code .= ' ' . $occurrence->recordNumber;
				}
				if (isset($occurrence->fieldNumber))
				{
					$code .= ' ' . $occurrence->fieldNumber;
				}
				break;				
		
		
			case 'MO':
				if (isset($occurrence->recordNumber))
				{
					$code = $occurrence->recordNumber;
				}
				break;
				
			case 'MNHN':
				$institutionCode ='P';
				if (isset($occurrence->recordedBy))
				{
					$code = $occurrence->recordedBy;
				}
				if (isset($occurrence->recordNumber))
				{
					$code .= ' ' . $occurrence->recordNumber;
				}
				if (isset($occurrence->fieldNumber))
				{
					$code .= ' ' . $occurrence->fieldNumber;
				}
				break;				
				
				
			case 'Naturalis':
				if (preg_match('/^WAG/', $occurrence->catalogNumber))
				{
					$institutionCode ='WAG';
				}
				if (preg_match('/^L\s+/', $occurrence->catalogNumber))
				{
					$institutionCode ='L';
				}
				if (isset($occurrence->recordedBy))
				{
					$code = $occurrence->recordedBy;
				}
				if (isset($occurrence->recordNumber))
				{
					$code .= ' ' . $occurrence->recordNumber;
				}
				break;				
				
			case 'F':
			case 'K':
			default:
				if (isset($occurrence->recordedBy))
				{
					$code = $occurrence->recordedBy;
				}
				if (isset($occurrence->recordNumber))
				{
					$code .= ' ' . $occurrence->recordNumber;
				}
				if (isset($occurrence->fieldNumber))
				{
					$code .= ' ' . $occurrence->fieldNumber;
				}
				break;
		}
		
		if ($code != '')
		{
			// clean
			$code = clean($code);
			
			$type = new stdclass;
			$type->occurrence = $occurrence;
			$type->id = $occurrence->key;
			$type->code = $code;
			
			$gbif_types[$institutionCode][] = $type;
		}
	}
	
	
		
	
}
	

if ($debug)
{
	echo '<pre>';
	print_r($gbif_types);
	echo '</pre>';
}
//exit();
//print_r($ipni_types);

// compare

foreach ($ipni_types as $k => $v)
{
	if (isset($gbif_types[$k]))
	{
		foreach ($v as $ipni_code)
		{
			foreach($gbif_types[$k] as $type)
			{
				// for now...
				$one = explode(" ", $ipni_code);
				$two = explode(" ", $type->code);
				
				
				$count = 0;
				for ($i = 0; $i < count($one); $i++)
				{
					if (in_array($one[$i], $two))
					{
						$count++;
					}
				}
				
				/*
				echo '<pre>';
				print_r($one);
				print_r($two);
				echo $count;
				echo '</pre>';exit();
				*/
				
				
				//$d = levenshtein($ipni_code, $type->code);
				//if ($d < 2)
				
				// Minimum number of matches to be a match
				$min = min(2, count($one));
				
				
				if ($count >= $min)
				{
					//$hit = new stdclass;
					$hit = $type->occurrence;

					$api_obj->results[] = $hit;
				}
			}
		}
	}
}

//print_r($results);

echo json_encode($api_obj);

?>


