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

// http://stackoverflow.com/a/16840245
// SHOW FULL TABLES IN ipni WHERE TABLE_TYPE LIKE 'VIEW';
$views = array(
'acta amazonica',
'acta bot. brasil.',
'acta bot. croat.',
'acta bot. hung.',
'acta bot. mex.',
'acta bot. neerl.',
'acta bot. venez.',
'acta bot. yunnan.',
'acta phytotax. geobot.',
'acta phytotax. sin.',
'aliso',
'amer fern j.',
'amer. j. bot.',
'amer. midl. naturalist',
'ann. bot. (rome)',
'ann. bot. fenn.',
'ann. mag. nat. hist.',
'ann. missouri bot. gard.',
'ann. naturhist. mus. wien',
'ann. transvaal mus.',
'ann. tsukuba bot. gard.',
'annuaire conserv. jard. bot. geneve',
'arcula',
'ark. bot.',
'arnaldoa',
'asklepios',
'austral. j. bot.',
'austral. j. bot., suppl. ser.',
'austral. syst. bot.',
'austrobaileya',
'balduinia',
'beitr. biol. pflanzen',
'belg. j. bot.',
'ber. deutsch. bot. ges.',
'ber. schweiz. bot. ges.',
'biodivers. res. conservation',
'biol. diversity conservation',
'blumea',
'blumea, suppl.',
'bot. bull. acad. sin. (taipei)',
'bot. gaz.',
'bot. jahrb. syst.',
'bot. mag. (tokyo)',
'bot. mus. leafl.',
'bot. zhurn. (moscow & leningrad)',
'bothalia',
'brit. fern gaz.',
'brittonia',
'brunonia',
'bull. brit. mus. (nat. hist.), bot.',
'bull. herb. boissier',
'bull. jard. bot. buitenzorg',
'bull. jard. bot. etat bruxelles',
'bull. jard. bot. natl. belg.',
'bull. mens. soc. linn. lyon',
'bull. mens. soc. linn. paris',
'bull. misc. inform. kew',
'bull. mus. natl. hist. nat., b, adansonia',
'bull. nat. hist. mus. london, bot.',
'bull. natl. mus. nat. sci., tokyo, b.',
'bull. new york bot. gard.',
'bull. soc. bot. france',
'bull. soc. bot. france, lett. bot.',
'bull. soc. neuchateloise sci. nat.',
'bull. torrey bot. club',
'canad. j. bot.',
'candollea',
'collect. bot. barcelona',
'contr. gray herb.',
'contr. u.s. natl. herb.',
'contr. univ. michigan herb.',
'contributions from the herbarium australiense',
'contributions_from_the_queensland_herbarium',
'darwiniana',
'edinburgh j. bot.',
'eur. j. taxon.',
'feddes repert.',
'fern gaz. (u.k.)',
'fieldiana, bot.',
'fl. aegypt.-arab.',
'fl. madagasc.',
'fl. males.',
'fl. yunnan.',
'gard. bull. singapore',
'gayana, bot.',
'guihaia',
'harvard pap. bot.',
'int. j. pl. sci.',
'j. adelaide bot. gard.',
'j. arnold arbor.',
'j. bamboo res.',
'j. bombay nat. hist. soc.',
'j. bot. res. inst. texas',
'j. e. africa nat. hist. soc. natl. mus.',
'j. fed. malay states mus.',
'j. int. conifer preserv. soc.',
'j. jap. bot.',
'j. linn. soc., bot.',
'j. straits branch roy. asiat. soc.',
'j. syst. evol.',
'j. threat. taxa',
'j. trop. subtrop. bot.',
'j. wash. acad. sci.',
'j. wuhan bot. res.',
'journ. jap. bot.',
'kew bull.',
'kirkia',
'korean j. pl. taxon.',
'lankesteriana',
'leafl. philipp. bot.',
'madrono',
'malayan nat.',
'meded. bot. mus. herb. rijks univ. utrecht',
'mem. junta invest. ultramar, 2 ser.',
'mem. new york bot. gard.',
'mem. torrey bot. club',
'molec. phylogen. evol.',
'moscosoa',
'muelleria',
'n. amer. fl.',
'neodiversity',
'nordic j. bot.',
'notizbl. bot. gart. berlin-dahlem',
'novon',
'nuytsia',
'oesterr. bot. wochenbl.',
'oesterr. bot. z.',
'opera bot.',
'orquideologia',
'pacific sci.',
'phil. trans. roy. soc. lond., ser. b',
'philipp. scientist',
'phytokeys',
'phytologia',
'phytotaxa',
'pl. divers. evol.',
'pl. sci. j.',
'pl. syst. evol.',
'polish bot. j.',
'proc. acad. nat. sci. philadelphia',
'proc. biol. soc. washington',
'proc. calif. acad. sci.',
'publ. field columb. mus., bot. ser.',
'reinwardtia',
'repert. spec. nov. regni veg.',
'repert. spec. nov. regni veg. beih.',
'rev. int. bot. appl. agric. trop.',
'revista peru. biol.',
'rheedea',
'rhodora',
'rodriguesia',
's. african j. bot.',
'selbyana',
'sendtnera',
'sida',
'smithsonian contr. bot.',
'smithsonian misc. collect.',
'syst. bot.',
'syst. bot. monogr.',
'syst. geogr. pl.',
'taiwania',
'taprobanica',
'taxon',
'telopea',
'thai forest bull., bot.',
'the victorian naturalist',
'trans. linn. soc. london',
'trans. linn. soc. london, bot.',
'trans. roy. soc. south africa',
'trans. san diego soc. nat. hist.',
'trans.bot.soc.edinburgh',
'turkish j. bot.',
'webbia',
'wentia',
'willdenowia',
'wrightia'
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