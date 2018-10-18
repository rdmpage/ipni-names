<?php

require_once(dirname(__FILE__) . '/config.inc.php');
require_once(dirname(__FILE__) . '/adodb5/adodb.inc.php');


//--------------------------------------------------------------------------------------------------
$db = NewADOConnection('mysql');
$db->Connect("localhost", 
	$config['db_user'] , $config['db_passwd'] , $config['db_name']);

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

$db->EXECUTE("set names 'utf8'"); 

$path = 'journals';

// http://stackoverflow.com/a/16840245
// SHOW FULL TABLES IN ipni WHERE TABLE_TYPE LIKE 'VIEW';
$views = array("acta amazonica",
"acta bot. boreal.-occid. sin.",
"acta bot. brasil.",
"acta bot. croat.",
"acta bot. hung.",
"acta bot. malac.",
"acta bot. mex.",
"acta bot. neerl.",
"acta bot. venez.",
"acta bot. yunnan.",
"acta horti berg.",
"acta phytotax. geobot.",
"acta phytotax. sin.",
"aliso",
"allertonia",
"amer fern j.",
"amer. j. bot.",
"amer. midl. naturalist",
"anales jard. bot. madrid",
"ann. bot. (rome)",
"ann. bot. fenn.",
"ann. mag. nat. hist.",
"ann. missouri bot. gard.",
"ann. naturhist. mus. wien",
"ann. transvaal mus.",
"ann. tsukuba bot. gard.",
"annuaire conserv. jard. bot. geneve",
"arcula",
"ark. bot.",
"arnaldoa",
"asklepios",
"austral. j. bot.",
"austral. j. bot., suppl. ser.",
"austral. syst. bot.",
"austrobaileya",
"balduinia",
"beitr. biol. pflanzen",
"belg. j. bot.",
"ber. deutsch. bot. ges.",
"ber. schweiz. bot. ges.",
"biodivers. res. conservation",
"biol. diversity conservation",
"blumea",
"blumea, suppl.",
"bol. inst. bot. univ. guadalajara",
"bol. mus. goeldi hist. nat. ethnogr.",
"bol. mus. paraense \"emilio goeldi,\" n.s., bot.",
"boston j. nat. hist.",
"bot. bull. acad. sin. (taipei)",
"bot. gaz.",
"bot. jahrb. syst.",
"bot. mag. (tokyo)",
"bot. mus. leafl.",
"bot. tidsskr.",
"bot. zeitung (berlin)",
"bot. zhurn. (moscow & leningrad)",
"bothalia",
"bouteloua",
"bradleya",
"brit. fern gaz.",
"brittonia",
"brunonia",
"bull. bot. surv. india",
"bull. brit. mus. (nat. hist.), bot.",
"bull. herb. boissier",
"bull. jard. bot. buitenzorg",
"bull. jard. bot. etat bruxelles",
"bull. jard. bot. natl. belg.",
"bull. mens. soc. linn. lyon",
"bull. mens. soc. linn. paris",
"bull. misc. inform. kew",
"bull. mus. natl. hist. nat.",
"bull. mus. natl. hist. nat., b, adansonia",
"bull. nat. hist. mus. london, bot.",
"bull. natl. mus. nat. sci., tokyo, b.",
"bull. new york bot. gard.",
"bull. soc. bot. france",
"bull. soc. bot. france, lett. bot.",
"bull. soc. neuchateloise sci. nat.",
"bull. torrey bot. club",
"cact. succ. j. (los angeles)",
"canad. j. bot.",
"candollea",
"carniv. pl. newslett.",
"castanea",
"collect. bot. barcelona",
"contr. gray herb.",
"contr. u.s. natl. herb.",
"contr. univ. michigan herb.",
"contributions from the herbarium australiense",
"contributions_from_the_queensland_herbarium",
"curtis's bot. mag.",
"darwiniana",
"edinburgh j. bot.",
"eur. j. taxon.",
"feddes repert.",
"fern gaz. (u.k.)",
"fieldiana, bot.",
"fl. aegypt.-arab.",
"fl. madagasc.",
"fl. males.",
"fl. yunnan.",
"gard. bull. singapore",
"gayana, bot.",
"great basin naturalist",
"guihaia",
"harvard pap. bot.",
"int. j. pl. sci.",
"isbn",
"j. adelaide bot. gard.",
"j. arnold arbor.",
"j. bamboo res.",
"j. bombay nat. hist. soc.",
"j. bot. res. inst. texas",
"j. e. africa nat. hist. soc. natl. mus.",
"j. fed. malay states mus.",
"j. int. conifer preserv. soc.",
"j. jap. bot.",
"j. linn. soc., bot.",
"j. straits branch roy. asiat. soc.",
"j. syst. evol.",
"j. threat. taxa",
"j. trop. subtrop. bot.",
"j. wash. acad. sci.",
"j. wuhan bot. res.",
"journ. agric. trop. & bot. appliq.",
"journ. jap. bot.",
"kew bull.",
"kirkia",
"korean j. pl. taxon.",
"lankesteriana",
"leafl. philipp. bot.",
"lundellia",
"madrono",
"malayan nat.",
"meded. bot. mus. herb. rijks univ. utrecht",
"mem. junta invest. ultramar, 2 ser.",
"mem. new york bot. gard.",
"mem. torrey bot. club",
"met. ecol. sist.",
"mitt. bot. staatssamml. munchen",
"molec. phylogen. evol.",
"moscosoa",
"muelleria",
"n. amer. fl.",
"nelumbo",
"neodiversity",
"new j. bot.",
"nordic j. bot.",
"notizbl. bot. gart. berlin-dahlem",
"novon",
"novosti sist. vyssh. rast.",
"nuytsia",
"oesterr. bot. wochenbl.",
"oesterr. bot. z.",
"opera bot.",
"orcidrchidaceae (ames)",
"organisms diversity evol.",
"orquideologia",
"pacific sci.",
"phil. trans. roy. soc. lond., ser. b",
"philipp. scientist",
"phytokeys",
"phytologia",
"phytotaxa",
"pl. divers. evol.",
"pl. sci. j.",
"pl. syst. evol.",
"polish bot. j.",
"proc. acad. nat. sci. philadelphia",
"proc. biol. soc. washington",
"proc. calif. acad. sci.",
"publ. field columb. mus., bot. ser.",
"reinwardtia",
"repert. spec. nov. regni veg.",
"repert. spec. nov. regni veg. beih.",
"rev. int. bot. appl. agric. trop.",
"revista mus. la plata",
"revista mus. la plata, secc. bot.",
"revista peru. biol.",
"rheedea",
"rhodora",
"rodriguesia",
"s. african j. bot.",
"schütziana",
"selbyana",
"sendtnera",
"sida",
"sida, bot. misc.",
"smithsonian contr. bot.",
"smithsonian misc. collect.",
"southw. naturalist",
"syst. bot.",
"syst. bot. monogr.",
"syst. geogr. pl.",
"taiwania",
"taprobanica",
"taxon",
"telopea",
"thai forest bull., bot.",
"the victorian naturalist",
"trans. linn. soc. london",
"trans. linn. soc. london, bot.",
"trans. roy. soc. south africa",
"trans. san diego soc. nat. hist.",
"trans.bot.soc.edinburgh",
"turczaninowia",
"turkish j. bot.",
"ukrayins'k. bot. zhurn.",
"utafiti",
"verh. zool.-bot. ges. wien",
"webbia",
"wentia",
"willdenowia",
"wrightia");

/*
$views = array(
'acta amazonica'
);
*/

foreach ($views as $view)
{
	$keys = array("Id","Full_name_without_family_and_authors","Authors","Publication","Collation",
	"Publication_year_full","issn","doi","biostor","bhl","jstor","cinii","url","pdf","handle");

	$filename = str_replace(' ', '_', $view) . '.csv';
	
	//$tmpfile = '/tmp/' . $filename;
	$outfile = $path . '/' . $filename;
	
	file_put_contents($outfile, '');
	
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
FROM `' . $view . '`;';

	$result = $db->Execute($sql);
	if ($result == false) die("failed [" . __LINE__ . "]: " . $sql . "\n" . $db->ErrorMsg());

	while (!$result->EOF) 
	{
		$values = array();
		
		foreach ($keys as $key)
		{
			$values[] = $result->fields[$key];
		}
		
		file_put_contents($outfile, join("\t", $values) . "\n", FILE_APPEND);

	
		$result->MoveNext();
	}
	

}

?>