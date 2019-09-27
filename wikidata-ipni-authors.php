<?php

// Do a big SPARQL query to get all IPNI authors know to Wikidata, and their names
// in various languages

$queries = array();

$queries['en'] = 
'select ?wikidata ?author_id ?name where { 
  ?wikidata wdt:P586 ?author_id .
  ?wikidata rdfs:label ?name .
  filter (lang(?name)="en") . 
}';

$queries['zh'] = 
'select ?wikidata ?author_id ?name where { 
  ?wikidata wdt:P586 ?author_id .
  ?wikidata rdfs:label ?name .
  filter (lang(?name)="zh") . 
}';

$queries['fr'] = 
'select ?wikidata ?author_id ?name where { 
  ?wikidata wdt:P586 ?author_id .
  ?wikidata rdfs:label ?name .
  filter (lang(?name)="fr") . 
}';

$queries['ja'] = 
'select ?wikidata ?author_id ?name where { 
  ?wikidata wdt:P586 ?author_id .
  ?wikidata rdfs:label ?name .
  filter (lang(?name)="ja") . 
}';

$queries['de'] = 
'select ?wikidata ?author_id ?name where { 
  ?wikidata wdt:P586 ?author_id .
  ?wikidata rdfs:label ?name .
  filter (lang(?name)="de") . 
}';

// Get all languages
$queries['all'] = 
'select ?wikidata ?author_id ?name where { 
  ?wikidata wdt:P586 ?author_id .
  ?wikidata rdfs:label ?name .
}';


//----------------------------------------------------------------------------------------
// get
function get($url, $format = "application/json")
{
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: " . $format));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

	$response = curl_exec($ch);
	if($response == FALSE) 
	{
		$errorText = curl_error($ch);
		curl_close($ch);
		die($errorText);
	}
	
	$info = curl_getinfo($ch);
	$http_code = $info['http_code'];
	
	curl_close($ch);
	
	return $response;
}
//----------------------------------------------------------------------------------------

$heading = array();
$first = true;

$page = 100;
$offset = 0;

$language = 'zh';
$language = 'fr';
$language = 'ja';

$language = 'all';

$done = false;

while (!$done)
{
	$sparql = $queries[$language];
		
	$sparql .= "\nLIMIT $page";
	$sparql .= "\nOFFSET $offset";


		$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);

		//echo $url;

		$json = get($url);
		
		// echo $json;

		$obj = json_decode($json);
		
		//print_r($obj);

		foreach ($obj->results as $results)
		{
			foreach ($results as $binding)
			{
				//print_r($binding);
				
				// dump results 
				
				$row = array();
				
				$lang = array();
				
				foreach ($binding as $k => $v)
				{
					if (!isset($heading[$k]))
					{
						$heading[] = $k;
					}
					
					$row[$k] = $v->value;
					
					if (isset($v->{'xml:lang'}))
					{
						$lang[$k] = $v->{'xml:lang'};
					}	
					
									
				}
				
				if ($first)
				{
					//echo join("\t", $heading) . "\n";
					$first = false;
				}
				else
				{
					//echo join("\t", $row) . "\n";
					
					//print_r($row);
					
					$row['wikidata'] = str_replace('http://www.wikidata.org/entity/', '', $row['wikidata']);
					
					$keys = array();
					$values = array();
					
					foreach ($row as $k => $v)
					{
						$keys[] = $k;
						$values[] = '"' . addcslashes($v, '"') . '"';
					}
					
					$keys[] = 'language';
					
					if ($language == 'all')
					{
						$values[] = '"' . $lang['name'] . '"';
					}
					else
					{
						$values[] = '"' . $language . '"';
					}
					
					$sql = 'REPLACE INTO ipni_wikidata_authors(' . join(',', $keys) . ') VALUES (' . join(',', $values) . ');';
					
					echo $sql . "\n";
				}
			}
		}

	if (count($obj->results->bindings) < $page)
	{
		$done = true;
	}
	else
	{
		$offset += $page;
	}
	
	
}

?>

