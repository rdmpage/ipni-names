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
'acta bot. yunnan.',
'acta phytotax. geobot.',
'amer. j. bot.',
'amer. midl. naturalist',
'ann. bot. fenn.',
'ann. mag. nat. hist.',
'ann. missouri bot. gard.',
'ark. bot.',
'arnaldoa',
'austral. syst. bot.',
'blumea',
'bot. gaz.',
'bot. jahrb. syst.',
'bot. mag. (tokyo)',
'bothalia',
'brit. fern gaz.',
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
'fern gaz. (u.k.)',
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
'muelleria',
'nordic j. bot.',
'novon',
'pacific sci.',
'phytokeys',
'phytologia',
'phytotaxa',
'pl. syst. evol.',
'proc. biol. soc. washington',
'publ. field columb. mus., bot. ser.',
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
'the victorian naturalist',
'trans. linn. soc. london',
'turkish j. bot.'
);


$views = array(
'fern gaz. (u.k.)',
'acta bot. yunnan.',
'brit. fern gaz.',
'the victorian naturalist',
'muelleria',
'publ. field columb. mus., bot. ser.',
'ann. mag. nat. hist.',
'rhodora'
);

$views=array(
'contr. univ. michigan herb.',
'trans. linn. soc. london, bot.',
'pl. divers. evol.',
'bull. nat. hist. mus. london, bot.',
'bull. mus. natl. hist. nat., b, adansonia',
'ber. schweiz. bot. ges.',
'j. fed. malay states mus.'
);


foreach ($views as $view)
{
	$filename = str_replace(' ', '_', $view) . '.csv';
	
	$tmpfile = '/tmp/' . $filename;
	$outfile = $path . '/' . $filename;

	if (file_exists($tmpfile))
	{
		unlink($tmpfile);
	}
	
	$sql = '
	SELECT "Id","Full_name_without_family_and_authors","Authors","Publication","Collation",
	"Publication_year_full","issn","doi","biostor","bhl","jstor","cinii","url","pdf","handle"
	UNION ALL 
	SELECT 
	 Id,
	 Full_name_without_family_and_authors,
	 Authors,
	 Publication,
	 Collation,
	 Publication_year_full,
	 IFNULL(issn,""),
	 IFNULL(doi,""),
	 IFNULL(biostor,""),
	 IFNULL(bhl,""),
	 IFNULL(jstor,""),
	 IFNULL(cinii,""),
	 IFNULL(url,""),
	 IFNULL(pdf,""),
	 IFNULL(handle,"")
	INTO OUTFILE "' . $tmpfile . '"
FIELDS ESCAPED BY \'"\'
TERMINATED BY \',\' OPTIONALLY ENCLOSED BY \'"\'
LINES TERMINATED BY "\n" 
FROM `' . $view . '`;';

	$result = $db->Execute($sql);
	if ($result == false) die("failed [" . __LINE__ . "]: " . $sql);


	rename($tmpfile, $outfile);

	

}

?>