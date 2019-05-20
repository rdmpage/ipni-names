<?php

// Match types to GBIF

require_once(dirname(__FILE__) . '/fingerprint.php');
require_once(dirname(__FILE__) . '/adodb5/adodb.inc.php');


//----------------------------------------------------------------------------------------
function get($url, $user_agent='', $content_type = '')
{	
	$data = null;

	$opts = array(
	  CURLOPT_URL =>$url,
	  CURLOPT_FOLLOWLOCATION => TRUE,
	  CURLOPT_RETURNTRANSFER => TRUE
	);

	if ($content_type != '')
	{
		$opts[CURLOPT_HTTPHEADER] = array("Accept: " . $content_type);
	}
	
	$ch = curl_init();
	curl_setopt_array($ch, $opts);
	$data = curl_exec($ch);
	$info = curl_getinfo($ch); 
	curl_close($ch);
	
	return $data;
}

//--------------------------------------------------------------------------
// Does URL exist?
function url_exists($url)
{
	$data = null;
	
	$headers = array(
		"Accept-Language: en-us",
		"User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)",
		"Connection: Keep-Alive",
		"Cache-Control: no-cache"
		);
	
	$referer = 'http://www.google.com/search';
    	
	$opts = array(
	  CURLOPT_URL =>$url,
	  CURLOPT_FOLLOWLOCATION => TRUE,
	  CURLOPT_RETURNTRANSFER => TRUE,
	  CURLOPT_HEADER => TRUE,
	  CURLOPT_HTTPHEADER => $headers,
	  CURLOPT_SSL_VERIFYPEER => FALSE,	
	  CURLOPT_REFERER => $referer,	
	);

	$ch = curl_init();
	curl_setopt_array($ch, $opts);
	$data = curl_exec($ch);
	$info = curl_getinfo($ch); 
	
	$http_code = $info['http_code'];
	
	curl_close($ch);
		
	$result = ($http_code == 200);	
	return $result;
}

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
function get_gbif_specimens($name, $types = true)
{
	$nub = 'd7dddbf4-2cf0-4f39-9b2a-bb099caae36c';

	$gbif_types = array();
	
	$url = 'http://api.gbif.org/v1/species?name=' . urlencode($name) . '&datasetKey=' . $nub;

	$json = get($url);
	
	$obj = json_decode($json);

	if (count($obj->results) == 1)
	{
		$id = $obj->results[0]->key;
	}

	if ($id != 0)
	{
		// get types
		$url = 'http://api.gbif.org/v1/occurrence/search?taxonKey=' . $id;
		
		if ($types)
		{
			$url .= '&typeStatus=*';
		}
		
		$json = get($url);
		$obj = json_decode($json);
	
		foreach ($obj->results as $occurrence)
		{
			$code = array();
			
			if (isset($occurrence->institutionCode))
			{
		
				$institutionCode = $occurrence->institutionCode;
		
				switch ($occurrence->institutionCode)
				{
					case 'BPBM':
						$institutionCode ='BISH';
						if (isset($occurrence->recordedBy))
						{
							$code[] = $occurrence->recordedBy;
						}
						if (isset($occurrence->recordNumber))
						{
							$code[] = $occurrence->recordNumber;
						}
						//$code = str_replace('Collector Number:', '', $code);
						break;
		
					case 'UEFS':
						$institutionCode ='HUEFS';
						if (isset($occurrence->recordedBy))
						{
							$code[] = $occurrence->recordedBy;
						}
						if (isset($occurrence->recordNumber))
						{
							$code[] =' ' . $occurrence->recordNumber;
						}
						if (isset($occurrence->fieldNumber))
						{
							$code[] = ' ' . $occurrence->fieldNumber;
						}
						break;				
		
		
					case 'MO':
						if (isset($occurrence->recordNumber))
						{
							$code[] = $occurrence->recordNumber;
						}
						break;
				
					case 'MNHN':
						$institutionCode ='P';
						if (isset($occurrence->recordedBy))
						{
							$code[] = $occurrence->recordedBy;
						}
						if (isset($occurrence->recordNumber))
						{
							$code[] = ' ' . $occurrence->recordNumber;
						}
						if (isset($occurrence->fieldNumber))
						{
							$code[] = ' ' . $occurrence->fieldNumber;
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
							$code[] = $occurrence->recordedBy;
						}
						if (isset($occurrence->recordNumber))
						{
							$code[] = ' ' . $occurrence->recordNumber;
						}
						break;		
				
					case 'NHMUK':
						$institutionCode = 'BM';
						if (isset($occurrence->recordedBy))
						{
							$code[] = $occurrence->recordedBy;
						}
						if (isset($occurrence->recordNumber))
						{
							$code[] = ' ' . $occurrence->recordNumber;
						}
						if (isset($occurrence->fieldNumber))
						{
							$code[] = ' ' . $occurrence->fieldNumber;
						}
						break;
						
				
					case 'F':
					case 'K':
					default:
						if (isset($occurrence->recordedBy))
						{
							$code[] = $occurrence->recordedBy;
						}
						if (isset($occurrence->recordNumber))
						{
							$code[] = ' ' . $occurrence->recordNumber;
						}
						if (isset($occurrence->fieldNumber))
						{
							$code[] = ' ' . $occurrence->fieldNumber;
						}
						break;
				
				
				}
			}
			else
			{
				switch ($occurrence->datasetKey)
				{
					case '15f819bd-6612-4447-854b-14d12ee1022d':
						$institutionCode = 'L';
						
						if (isset($occurrence->recordedBy))
						{
							$code[] = $occurrence->recordedBy;
						}
						if (isset($occurrence->recordNumber))
						{
							$code[] = ' ' . $occurrence->recordNumber;
						}
						if (isset($occurrence->fieldNumber))
						{
							$code[] = ' ' . $occurrence->fieldNumber;
						}
						break;
						
					default:
						$institutionCode = 'unknown';
						break;
				
				}
			
			}
			
			$code = array_unique($code);
			$c = join(' ', $code);

			// clean
			$c = clean($c);
		
			$type = new stdclass;
			$type->occurrence = $occurrence;
			$type->id = $occurrence->key;
			$type->code = $c;
		
			$gbif_types[$institutionCode][] = $type;
		}
	}
	
	return $gbif_types;
}

//----------------------------------------------------------------------------------------
$db = NewADOConnection('mysqli');
$db->Connect("localhost", "root", "", "ipni");

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

$db->EXECUTE("set names 'utf8'"); 


$sql = 'SELECT * FROM rdf_specimens LIMIT 1000';

//$sql = 'SELECT * FROM rdf_specimens WHERE specimen like "% POM%" LIMIT 100';
$sql = 'SELECT * FROM rdf_specimens WHERE specimen like "% Herb.%" LIMIT 10';

$sql = 'SELECT * FROM rdf_specimens WHERE nameComplete = "Miliusa viridiflora"';

//$sql = 'SELECT * FROM rdf_specimens WHERE nameComplete = "Convolvulus infantispinosus"';

$sql = 'SELECT * FROM rdf_specimens WHERE nameComplete LIKE "Miliusa %"';

//$sql = 'SELECT * FROM rdf_specimens WHERE nameComplete = "Miliusa lanceolata"';

//$sql = 'SELECT * FROM rdf_specimens WHERE nameComplete = "Miliusa amplexicaulis"';

$sql = 'SELECT * FROM rdf_specimens WHERE nameComplete LIKE "Zingiber %"';

$result = $db->Execute($sql);
if ($result == false) die("failed [" . __LINE__ . "]: " . $sql);
while (!$result->EOF) 
{
	
	$name = $result->fields['nameComplete'];
	
	$specimen = $result->fields['specimen'];
	
	echo "-----\n";
	echo $name . ' ' . $specimen . "\n";
	
	$gbif_types = get_gbif_specimens($name, true);
	
	//print_r($gbif_types);
	
	// Do we have specimen from this herbarium in GBIF?
	if (isset($gbif_types[$result->fields['code']]))
	{
		$one = explode(" ", $result->fields['cleaned']);

		foreach ($gbif_types[$result->fields['code']] as $specimen)
		{
			$two = explode(" ", $specimen->code);
			
			//print_r($one);
			//print_r($two);
			
			$common = array_intersect($one, $two);
			
			// print_r($common);
			
			$matched = (count($common) >= 1);
			
			if ($matched)
			{
				// we have a hit
			
				echo $specimen->occurrence->key . "\n";
				echo $specimen->occurrence->occurrenceID . "\n";
				echo $specimen->occurrence->catalogNumber . "\n";
				
				$jstor = '';
				
				$jstor_prefix = 'https://plants.jstor.org/stable/10.5555/al.ap.specimen.';
				
				// JSTOR
				switch ($result->fields['code'])
				{
					case 'A':
						$jstor = $jstor_prefix . str_replace('barcode-', 'a', $specimen->occurrence->catalogNumber);
						break;
				
					case 'E':
					case 'K':
						$jstor = $jstor_prefix . strtolower($specimen->occurrence->catalogNumber);
						break;
						
					case 'US':
						$barcode = '';
						
						foreach ($specimen->occurrence->media as $media)
						{
							if (isset($media->description))
							{
								if (preg_match('/Barcode (?<barcode>\d+)/', $media->description, $m))
								{
									$barcode = $m['barcode'];
								}							
							}
						}
						
						if ($barcode != '')
						{
							$jstor = $jstor_prefix . 'us' . $barcode;
						}
						break;
				
					default:
						break;
				}
				
				if ($jstor != '')
				{
					// need to chekc if URL exists
				
					echo $jstor . "\n";
					
					if (url_exists($jstor, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13'))
					{
						echo "exists\n";
					}
				}
			}
			
		}

	
	}
	
	$result->MoveNext();	
	
}


?>
