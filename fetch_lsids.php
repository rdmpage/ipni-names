<?php

require_once (dirname(__FILE__) . '/lib.php');


/*
-- IPNI where we are missing RDF
SELECT concat("'", names.Id, "',") FROM names LEFT JOIN rdf_ids USING(Id) WHERE rdf_ids.Id IS NULL;
*/

$ids = array('17026850-1',
'17033870-1',
'17048950-1',
'17049100-1',
'272340-2',
'51703-1',
'55513-1',
'55732-2',
'60462555-2',
'60468671-2',
'675892-1',
'678687-1',
'683975-1',
'77143993-1',
'77148295-1',
'77150891-1',
'77153466-1',
'935416-1',
'935879-1',
'93831-2');

$base_dir = 'rdf';

$count = 0;

foreach ($ids as $id)
{
	$lsid = 'urn:lsid:ipni.org:names:' . $id;

	$url = 'http://ipni.org/' . $lsid;
	
	echo "-- $url\n";
	
	$rdf = get($url, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/600.5.17 (KHTML, like Gecko) Version/8.0.5 Safari/600.5.17');
	
	if ($rdf != '')
	{
		$dirname = $id;
		$dirname = preg_replace('/-\d+$/', '', $dirname);
		
		$dir = floor($id / 1000);
		
		$dir = dirname(__FILE__) . "/$base_dir/" . $dir;
		if (!file_exists($dir))
		{
			$oldumask = umask(0); 
			mkdir($dir, 0777);
			umask($oldumask);
		}
		
		$f = $dir . '/' . $id . '.xml';
		$file = fopen($f, "w");
		fwrite($file, $rdf);
		fclose($file);	
	
	}
	
	if (($fetch_count++ % 5) == 0)
	{
		$rand = rand(1000000, 3000000);
		echo '-- sleeping for ' . round(($rand / 1000000),2) . ' seconds' . "\n";
		usleep($rand);
	}
		
	
}

?>