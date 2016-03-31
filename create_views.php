<?php

require_once(dirname(__FILE__) . '/config.inc.php');
require_once(dirname(__FILE__) . '/adodb5/adodb.inc.php');


//--------------------------------------------------------------------------------------------------
$db = NewADOConnection('mysql');
$db->Connect("localhost", 
	$config['db_user'] , $config['db_passwd'] , $config['db_name']);

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;


$journals = array(
//'Beitr. Biol. Pflanzen|0005-8041',
//'Bot. Bull. Acad. Sin. (Taipei)|0006-8063',
//'Ann. Naturhist. Mus. Wien|0083-6133',
//'Smithsonian Misc. Collect.|0096-8749',
//'Proc. Acad. Nat. Sci. Philadelphia|0097-3157',
//'Ann. Naturhist. Mus. Wien|0255-0105',
//'J. Trop. Subtrop. Bot.|1005-3395',
//'Malayan Nat.|J. 0025-1291',
//'Reinwardtia|0034-365X',
//'Orquideologia|0120-1433',
//'Mem. Junta Invest. Ultramar, 2 Ser.|0870-0915',
//'J. Bamboo Res.|1000-6567',
//'Oesterr. Bot. Wochenbl.|1029-0729',
//'Contributions from the Herbarium Australiense|1030-1887',
//'Turkish J. Bot.|1300-008X',
'Biol. Diversity Conservation|1308-8084',
'Ber. Deutsch. Bot. Ges.|0011-9970',
'Acta Amazonica|0044-5967',
'Acta Bot. Neerl.|0044-5983',
'Philipp. Scientist|0079-1466',
'Asklepios|0260-9533',
'Wentia|0511-4780',
'Rheedea|0971-2313'
);


foreach ($journals as $journal)
{
	$parts = explode("|", $journal);
	
	$sql = "CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `" . $parts[0] . "`
AS SELECT
   `names`.`Id` AS `Id`,
   `names`.`Version` AS `Version`,
   `names`.`Family` AS `Family`,
   `names`.`Infra_family` AS `Infra_family`,
   `names`.`Hybrid_genus` AS `Hybrid_genus`,
   `names`.`Genus` AS `Genus`,
   `names`.`Infra_genus` AS `Infra_genus`,
   `names`.`Hybrid` AS `Hybrid`,
   `names`.`Species` AS `Species`,
   `names`.`Infra_species` AS `Infra_species`,
   `names`.`Rank` AS `Rank`,
   `names`.`Authors` AS `Authors`,
   `names`.`Basionym_author` AS `Basionym_author`,
   `names`.`Publishing_author` AS `Publishing_author`,
   `names`.`Full_name_without_family_and_authors` AS `Full_name_without_family_and_authors`,
   `names`.`Publication` AS `Publication`,
   `names`.`Collation` AS `Collation`,
   `names`.`Publication_year_full` AS `Publication_year_full`,
   `names`.`Name_status` AS `Name_status`,
   `names`.`Remarks` AS `Remarks`,
   `names`.`Basionym` AS `Basionym`,
   `names`.`Replaced_synonym` AS `Replaced_synonym`,
   `names`.`Nomenclatural_synonym` AS `Nomenclatural_synonym`,
   `names`.`Distribution` AS `Distribution`,
   `names`.`Citation_type` AS `Citation_type`,
   `names`.`issn` AS `issn`,
   `names`.`doi` AS `doi`,
   `names`.`biostor` AS `biostor`,
   `names`.`jstor` AS `jstor`,
   `names`.`bhl` AS `bhl`,
   `names`.`url` AS `url`,
   `names`.`pdf` AS `pdf`,
   `names`.`cinii` AS `cinii`,
   `names`.`handle` AS `handle`
FROM `names` where (`names`.`issn` = '" . $parts[1] . "');";



	$result = $db->Execute($sql);
	if ($result == false) die("failed [" . __LINE__ . "]: " . $db->ErrorMsg() . ' '  . $sql);

}

?>