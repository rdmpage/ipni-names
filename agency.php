<?php

// Get DOI agency for a set of DOI prefixes

// get list of DOIs, one per prefix from doi_by_prefix.php


require_once (dirname(__FILE__) . '/lib.php');



$dois=array();

$dois=array(
"10.5354/0717-8883.1863.19855",
"10.1080/00173137409429902",
"10.3406/jatba.1925.4331",
"10.33736/bjrst.593.2017",
"10.22092/ijb.2017.107596.1132",
"10.7677/ynzwyj201312041");

$count = 1;

foreach ($dois as $doi)
{
	echo "-- $doi\n";
	
	$prefix = substr($doi, 0, strpos($doi, "/"));
	
	//$url = 'http://api.crossref.org/works/' . $doi . '/agency';
	
	$url = 'http://doi.org/ra/' . $doi;
	
	$json = get($url);
	
	//echo $url . "\n";
	//echo $json;
	
	if ($json != '')
	{
		$obj = json_decode($json);
		
		if (isset($obj->message->agency))
		{
			echo "-- $prefix " . $obj->message->agency->id . "\n";
			
			//echo 'UPDATE names_indexfungorum SET doi_agency="' . $obj->message->agency->id . '" WHERE doi LIKE "' . $prefix . '%";' . "\n";
			echo 'UPDATE names SET doi_agency="' . $obj->message->agency->id . '" WHERE doi LIKE "' . $prefix . '%";' . "\n";
		}
		
		if (isset($obj[0]->RA))
		{
			echo "-- $prefix " . $obj[0]->RA . "\n";
			
			//echo 'UPDATE names_indexfungorum SET doi_agency="' . $obj->message->agency->id . '" WHERE doi LIKE "' . $prefix . '%";' . "\n";
			echo 'UPDATE names SET doi_agency="' . strtolower($obj[0]->RA) . '" WHERE doi LIKE "' . $prefix . '%";' . "\n";
		}
		
	}
	
	if (($count++ % 10) == 0)
	{
		$rand = rand(1000000, 3000000);
		echo '-- sleeping for ' . round(($rand / 1000000),2) . ' seconds' . "\n";
		usleep($rand);
	}
	
}	

?>