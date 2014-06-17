<?php

require_once(dirname(__FILE__) . '/config.inc.php');
require_once(dirname(__FILE__) . '/adodb5/adodb.inc.php');


//--------------------------------------------------------------------------------------------------
$db = NewADOConnection('mysql');
$db->Connect("localhost", 
	$config['db_user'] , $config['db_passwd'] , $config['db_name']);

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;


$path = 'journals';

$views = array(
'acta phytotax. geobot.',
'amer. j. bot.',
'amer. midl. naturalist',
'ann. bot. fenn.',
'ann. missouri bot. gard.',
'ark. bot.',
'arnaldoa',
'austral. syst. bot.',
'blumea',
'bot. gaz.',
'bot. jahrb. syst.',
'bot. mag. (tokyo)',
'bothalia',
'brittonia',
'brunonia',
'bull. herb. boissier',
'bull. jard. bot. etat bruxelles',
'bull. jard. bot. buitenzorg',
'bull. misc. inform. kew',
'bull. nat. hist. mus. london, bot.',
'bull. soc. bot. france',
'bull. torrey bot. club',
'candollea',
'contr. u.s. natl. herb.',
'edinburgh j. bot.',
'feddes repert.',
'fieldiana, bot.',
'gayana, bot.',
'int. j. pl. sci.',
'j. arnold arbor.',
'j. linn. soc., bot.',
'j. syst. evol.',
'j. wash. acad. sci.',
'kew bull.',
'mem. new york bot. gard.',
'molec. phylogen. evol.',
'nordic j. bot.',
'novon',
'pacific sci.',
'phytokeys',
'phytologia',
'phytotaxa',
'pl. syst. evol.',
'proc. biol. soc. washington',
'repert. spec. nov. regni veg.',
'revista peru. biol.',
'rhodora',
's. african j. bot.',
'sida',
'smithsonian contr. bot.',
'syst. bot.',
'syst. bot. monogr.',
'taxon',
'telopea',
'thai forest bull., bot.',
'trans. linn. soc. london',
'turkish j. bot.'
);

foreach ($views as $view)
{
	$filename = str_replace(' ', '_', $view) . '.tsv';
	
	$tmpfile = '/tmp/' . $filename;
	$outfile = $path . '/' . $filename;

	if (file_exists($tmpfile))
	{
		unlink($tmpfile);
	}
	
	$sql = 'SELECT * INTO OUTFILE "' . $tmpfile . '"
FIELDS TERMINATED BY "\t" LINES TERMINATED BY "\n"
FROM `' . $view . '`;';

	$result = $db->Execute($sql);
	if ($result == false) die("failed [" . __LINE__ . "]: " . $sql);


	rename($tmpfile, $outfile);

	

}

?>