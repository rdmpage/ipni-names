<?php

require_once (dirname(dirname(__FILE__)) . '/lib.php');

$families = array(
'Acanthaceae',
'Acanthochlamydaceae',
'Aceraceae',
'Achariaceae',
'Achatocarpaceae',
'Acmopyleaceae',
'Acoraceae',
'Actinidiaceae',
'Actiniopteridaceae',
'Actinotaceae',
'Adiantaceae',
'Adoxaceae',
'Aextoxicaceae',
'Agapanthaceae',
'Agaricaceae',
'Agathidaceae',
'Agavaceae',
//'Agavaceae/amaryllidaceae',
'Agdestidaceae',
'Aizoaceae',
'Akaniaceae',
'Alangiaceae',
'Alismataceae',
'Alliaceae',
'Aloaceae',
'Alseuosmiaceae',
'Alstroemeriaceae',
'Alzateaceae',
'Amaranthaceae',
'Amaryllidaceae',
'Amborellaceae',
'Amphorogynaceae',
'Anacampserotaceae',
'Anacardiaceae',
'Anarthriaceae',
'Ancistrocladaceae',
'Andropogonaceae',
'Anemarrhenaceae',
'Anisophylleaceae',
'Annonaceae',
'Anopteraceae',
'Anthericaceae',
'Antirrhinaceae',
'Aphanopetalaceae',
'Aphloiaceae',
'Aphyllanthaceae',
'Apiaceae',
'Apocynaceae',
'Apodanthaceae',
'Aponogetonaceae',
'Apostasiaceae',
'Aquifoliaceae',
'Araceae',
'Araliaceae',
'Aralidiaceae',
'Araucariaceae',
'Arceuthidaceae',
'Arecaceae',
'Argophyllaceae',
'Aristolochiaceae',
'Asclepiadaceae',
'Asparagaceae',
'Asphodelaceae',
'Aspleniaceae',
'Asteliaceae',
'Asteraceae',  // do this again
'Asteropeiaceae',
'Athrotaxidaceae',
'Athyriaceae',
'Aucubaceae',
'Aurantiaceae',
'Austrobaileyaceae',
'Austrotaxaceae',
'Avenaceae',
'Avetraceae',
'Avicenniaceae',
'Azollaceae',
'Balanitaceae',
'Balanopaceae',
'Balanophoraceae',
'Balsaminaceae',
'Barbeuiaceae',
'Barbeyaceae',
'Basellaceae',
'Bataceae',
'Baxteriaceae',
'Begoniaceae',
'Behniaceae',
'Bembiciaceae',
'Berberidaceae',
'Berberidopsidaceae',
'Berryaceae',
'Bersamaceae',
'Betulaceae',
'Bignoniaceae',
'Bixaceae',
'Blandfordiaceae',
'Blechnaceae',
'Bolbitidaceae',
'Bombacaceae',
'Boraginaceae',
'Borthwickiaceae',
'Boryaceae',
'Boweniaceae',
'Bracteocarpaceae',
'Brassicaceae',
'Bretschneideraceae',
'Bromeliaceae',
'Brownlowiaceae',
'Brunelliaceae',
'Bruniaceae',
'Brunoniaceae',
'Buddlejaceae',
'Burchardiaceae',
'Burmanniaceae',
'Burseraceae',
'Butomaceae',
'Buxaceae',
'Byblidaceae',
'Byttneriaceae',
'Cabombaceae',
'Cactaceae',
'Caesalpiniaceae',
'Calamaceae',
'Calceolariaceae',
'Calectasiaceae',
'Calligonaceae',
'Callitrichaceae',
'Calycanthaceae',
'Calyceraceae',
'Campanulaceae',
'Canacomyricaceae',
'Canellaceae',
'Cannabaceae',
'Cannaceae',
'Canotiaceae',
'Capparaceae',
'Caprifoliaceae',
'Cardiopteridaceae',
'Caricaceae',
'Carlemanniaceae',
'Caryocaraceae',
'Caryophyllaceae',
'Casuarinaceae',
'Cecropiaceae',
'Celastraceae',
'Celtidaceae',
'Centrolepidaceae',
'Cephalotaceae',
'Cephalotaxaceae',
'Ceratophyllaceae',
'Cercidiphyllaceae',
'Cervantesiaceae',
'Cheilanthaceae',
'Cheilosaceae',
'Cheiropleuriaceae',
'Chenopodiaceae',
'Chionographidaceae',
'Chloranthaceae',
'Chrysobalanaceae',
'Cibotiaceae',
'Cichoriaceae',
'Circaeasteraceae',
'Cistaceae',
'Cleomaceae',
'Clethraceae',
'Clusiaceae',
'Cneoraceae',
'Cobaeaceae',
'Cochlospermaceae',
'Codonaceae',
'Coffeaceae',
'Colchicaceae',
'Columelliaceae',
'Comandraceae',
'Combretaceae',
'Commelinaceae',
'Compositae', // do this again
'Connaraceae',
'Conostylidaceae',
'Convallariaceae',
'Convolvulaceae',
'Coptaceae',
'Coriariaceae',
'Cornaceae',
'Corokiaceae',
'Corsiaceae',
'Corylaceae',
'Corynocarpaceae',
'Costaceae',
'Crassulaceae',
'Crossosomataceae',
'Crypteroniaceae',
'Cryptogrammaceae',
'Ctenolophonaceae',
'Cucurbitaceae',
'Culcitaceae',
'Cunninghamiaceae',
'Cunoniaceae',
'Cupressaceae',
'Curtisiaceae',
'Cuscutaceae',
'Cyanastraceae',
'Cyatheaceae',
'Cycadaceae',
'Cyclanthaceae',
'Cyclocheilaceae',
'Cymodoceaceae',
'Cynarocephalaceae',
'Cynomoriaceae',
'Cyperaceae',
'Cyphocarpaceae',
'Cypripediaceae',
'Cyrillaceae',
'Cystodiaceae',
'Cystopteridaceae',
'Dacrycarpaceae',
'Dacrydiaceae',
'Dactylanthaceae',
'Daphniphyllaceae',
'Dasypogonaceae',
'Datiscaceae',
'Davalliaceae',
'Davidsoniaceae',
'Decaisneaceae',
'Degeneriaceae',
'Dennstaedtiaceae',
'Dialypetalanthaceae',
'Diapensiaceae',
'Dichapetalaceae',
'Dicksoniaceae',
'Dicranopteridaceae',
'Didiereaceae',
'Didymelaceae',
'Diegodendraceae',
'Diervillaceae',
'Dilleniaceae',
'Dioaceae',
'Dioncophyllaceae',
'Dioscoreaceae',
'Dipentodontaceae',
'Diplaziopsidaceae',
'Dipsacaceae',
'Dipteridaceae',
'Dipterocarpaceae',
'Dirachmaceae',
'Diselmaceae',
'Doryanthaceae',
'Dracaenaceae',
'Droseraceae',
'Drosophyllaceae',
'Drynariaceae',
'Dryopteridaceae',
'Duabangaceae',
'Duckeodendraceae',
'Durionaceae',
'Ebenaceae',
'Ecdeiocoleaceae',
'Elaeagnaceae',
'Elaeocarpaceae',
'Elaphoglossaceae',
'Elatinaceae',
'Emblingiaceae',
'Empetraceae',
'Encephalartaceae',
'Engelhardtiaceae',
'Epacridaceae',
'Ephedraceae',
'Equisetaceae',
'Eremolepidaceae',
'Eremosynaceae',
'Ericaceae',
'Eriocaulaceae',
'Eriospermaceae',
'Erythrospermaceae',
'Erythroxylaceae',
'Escalloniaceae',
'Eschscholtziaceae',
'Eucommiaceae',
'Eucryphiaceae',
'Euphorbiaceae',
'Euphroniaceae',
'Eupomatiaceae',
'Eupteleaceae',
'Eustrephaceae',
'Exbucklandiaceae',
'Fabaceae',
'Fagaceae',
'Falcatifoliaceae',
'Fitzroyaceae',
'Flacourtiaceae',
'Flagellariaceae',
'Fouquieriaceae',
'Frankeniaceae',
'Fumariaceae',
'Garryaceae',
'Geissolomataceae',
'Geitonoplesiaceae',
'Gelsemiaceae',
'Geniostomaceae',
'Gentianaceae',
'Georgiaceae',
'Geosiridaceae',
'Geraniaceae',
'Gerrardinaceae',
'Gesneriaceae',
'Ginkgoaceae',
'Gisekiaceae',
'Glaucidiaceae',
'Gleicheniaceae',
'Globulariaceae',
'Gnetaceae',
'Goetzeaceae',
'Gomortegaceae',
'Goodeniaceae',
'Goupiaceae',
'Grammitidaceae',
'Greyiaceae',
'Griseliniaceae',
'Gronoviaceae',
'Grossulariaceae',
'Grubbiaceae',
'Guamatelaceae',
'Gumilleaceae',
'Gunneraceae',
'Gymnogrammitidaceae',
'Gyrostemonaceae',
'Hachetteaceae',
'Haemodoraceae',
'Halocarpaceae',
'Halophytaceae',
'Haloragaceae',
'Hamamelidaceae',
'Hanguanaceae',
'Haptanthaceae',
'Hectorellaceae',
'Heleniaceae',
'Heliamphoraceae',
'Heliconiaceae',
'Heloseaceae',
'Helosidaceae',
'Helwingiaceae',
'Hemerocallidaceae',
'Hemidictyaceae',
'Hemimeridaceae',
'Hemionitidaceae',
'Henriqueziaceae',
'Hernandiaceae',
'Herreriaceae',
'Hesperocallaceae',
'Hesperocallidaceae',
'Himantandraceae',
'Hippocastanaceae',
'Hippuridaceae',
'Hopkinsiaceae',
'Hoplestigmataceae',
'Hortoniaceae',
'Hostaceae',
'Huaceae',
'Huerteaceae',
'Humbertiaceae',
'Humiriaceae',
'Huperziaceae',
'Hyacinthaceae',
'Hydatellaceae',
'Hydnoraceae',
'Hydrangeaceae',
'Hydrastidaceae',
'Hydrocharitaceae',
'Hydrophyllaceae',
'Hydrostachyaceae',
'Hymenocardiaceae',
'Hymenophyllaceae',
'Hymenophyllopsidaceae',
'Hypericaceae',
'Hypodematiaceae',
'Hypolepidaceae',
'Hypoxidaceae',
'Icacinaceae',
'Idiospermaceae',
'Illecebraceae',
'Illiciaceae',
'Incertae_sedis',
'Iridaceae',
'Irvingiaceae',
'Isoetaceae',
'Iteaceae',
'Ixerbaceae',
'Ixioliriaceae',
'Ixonanthaceae',
'Japonoliriaceae',
'Joinvilleaceae',
'Juglandaceae',
'Juncaceae',
'Juncaginaceae',
'Jungermanniaceae',
'Justiciaceae',
'Kaliphoraceae',
'Koeberliniaceae',
'Krameriaceae',
'Labiatae',
'Lacandoniaceae',
'Lacistemataceae',
'Lactoridaceae',
'Lamiaceae',
'Lanariaceae',
'Lardizabalaceae',
'Lauraceae',
'Laxmanniaceae',
'Lecythidaceae',
'Ledocarpaceae',
'Leeaceae',
'Leguminosae', // do again
'Leitneriaceae',
'Lemnaceae',
'Lennoaceae',
'Lentibulariaceae',
'Lepidobotryaceae',
'Lepidothamnaceae',
'Libocedraceae',
'Lilaeaceae',
'Liliaceae',
'Limnanthaceae',
'Limnocharitaceae',
'Limodoraceae',
'Limoniaceae',
'Linaceae',
'Lindenbergiaceae',
'Linderniaceae',
'Lindsaeaceae',
'Linnaeaceae',
'Liriodendraceae',
'Lissocarpaceae',
'Loasaceae',
'Lobeliaceae',
'Loganiaceae',
'Lomandraceae',
'Lomariopsidaceae',
'Lophiocarpaceae',
'Lophopyxidaceae',
'Lophosoriaceae',
'Loranthaceae',
'Lowiaceae',
'Loxogrammaceae',
'Loxsomataceae',
'Lycopodiaceae',
'Lyginiaceae',
'Lythraceae',
'Mackinlayaceae',
'Maesaceae',
'Magnoliaceae',
'Malaceae',
'Malesherbiaceae',
'Malpighiaceae',
'Malvaceae',
'Marantaceae',
'Marattiaceae',
'Marcgraviaceae',
'Marsileaceae',
'Martyniaceae',
'Matoniaceae',
'Mayacaceae',
'Mazaceae',
'Medeolaceae',
'Medusagynaceae',
'Medusandraceae',
'Megalariaceae',
'Melanophyllaceae',
'Melanthiaceae',
//'Melanthiaceae/liliaceae',
'Melastomataceae',
'Meliaceae',
'Melianthaceae',
'Meliosmaceae',
'Menispermaceae',
'Menyanthaceae',
'Mesembryanthemaceae',
'Metaxyaceae',
'Meyeniaceae',
'Microcachryaceae',
'Microcachrydaceae',
'Microstrobaceae',
'Microteaceae',
'Milulaceae',
'Mimosaceae',
'Mimosacease',
'Misodendraceae',
'Mitrastemonaceae',
'Molluginaceae',
'Monimiaceae',
'Monotaceae',
'Montiaceae',
'Montiniaceae',
'Moraceae',
'Morinaceae',
'Moringaceae',
'Muntingiaceae',
'Musaceae',
'Myodocarpaceae',
'Myoporaceae',
'Myricaceae',
'Myristicaceae',
'Myrothamnaceae',
'Myrsinaceae',
'Myrtaceae',
'Mystropetalaceae',
'Nageiaceae',
'Najadaceae',
'Nanodeaceae',
'Narcissaceae',
'Nartheciaceae',
'Nelsoniaceae',
'Nelumbonaceae',
'Neocallitropsidaceae',
'Neottiaceae',
'Nepenthaceae',
'Nephrolepidaceae',
'Nesogenaceae',
'Neuradaceae',
'Neuwiediaceae',
'Nupharaceae',
'Nyctaginaceae',
'Nymphaeaceae',
'Nyssaceae',
'Ochnaceae',
'Oftiaceae',
'Olacaceae',
'Oleaceae',
'Oleandraceae',
'Oliniaceae',
'Onagraceae',
'Oncothecaceae',
'Onocleaceae',
'Ophioglossaceae',
'Opiliaceae',
'Orchidaceae',
'Orobanchaceae',
'Osmundaceae',
'Oxalidaceae',
'Paeoniaceae',
'Paivaeusaceae',
'Pandaceae',
'Pandanaceae',
'Papaveraceae',
'Paracryphiaceae',
'Parasitaxaceae',
'Parkeriaceae',
'Parnassiaceae',
'Passifloraceae',
'Pedaliaceae',
'Pedicularidaceae',
'Peganaceae',
'Pellicieraceae',
'Penaeaceae',
'Pentaphragmataceae',
'Pentaphylacaceae',
'Pentastemonaceae',
'Penthoraceae',
'Peperomiaceae',
'Peridiscaceae',
'Periplocaceae',
'Petenaeaceae',
'Petermanniaceae',
'Petrosaviaceae',
'Phellinaceae',
'Philesiaceae',
'Philydraceae',
'Phormiaceae',
'Phrymaceae',
'Phyllocladaceae',
'Physenaceae',
'Phytolaccaceae',
'Picramniaceae',
'Picrodendraceae',
'Pilgerodendraceae',
'Pinaceae',
'Piperaceae',
'Pittosporaceae',
'Plagiogyriaceae',
'Plagiopteraceae',
'Plantaginaceae',
'Platanaceae',
'Platycaryaceae',
'Platycladaceae',
'Platyspermatiaceae',
'Platystemonaceae',
'Platyzomataceae',
'Pleurosoriopsidaceae',
'Plocospermataceae',
'Plumbaginaceae',
'Poaceae',
'Podoaceae',
'Podocarpaceae',
'Podostemaceae',
'Polemoniaceae',
'Poliothyrsidaceae',
'Polygalaceae',
'Polygonaceae',
'Polypodiaceae',
'Polypremaceae',
'Pontederiaceae',
'Portulacaceae',
'Portulacariaceae',
'Posidoniaceae',
'Potamogetonaceae',
'Pottingeriaceae',
'Primulaceae',
'Prioniaceae',
'Proteaceae',
'Prumnopityaceae',
'Psilotaceae',
'Psiloxylaceae',
'Ptaeroxylaceae',
'Pteleocarpaceae',
'Pteridaceae',
'Pteridiaceae',
'Pteridophyllaceae',
'Pteridophyta',
'Pterostemonaceae',
'Punicaceae',
'Pycnanthaceae',
'Quiinaceae',
'Quintiniaceae',
'Rafflesiaceae',
'Ranunculaceae',
'Ranzaniaceae',
'Rapateaceae',
'Rehmanniaceae',
'Resedaceae',
'Restionaceae',
'Retziaceae',
'Rhabdodendraceae',
'Rhachidosoraceae',
'Rhamnaceae',
'Rhipogonaceae',
'Rhizophoraceae',
'Rhododendraceae',
'Rhoipteleaceae',
'Rhopalocarpaceae',
'Rhynchocalycaceae',
'Ripogonaceae',
'Roridulaceae',
'Rosaceae',
'Rubiaceae',
'Ruppiaceae',
'Ruscaceae',
'Rutaceae',
'Sabiaceae',
'Saccifoliaceae',
'Saccolomataceae',
'Salazariaceae',
'Salicaceae',
'Salvadoraceae',
'Salviniaceae',
'Saniculaceae',
'Santalaceae',
'Sapindaceae',
'Sapotaceae',
'Sarcobataceae',
'Sarcolaenaceae',
'Sarcophytaceae',
'Sarcospermaceae',
'Sargentodoxaceae',
'Sarraceniaceae',
'Saururaceae',
'Saxegothaeaceae',
'Saxifragaceae',
'Scepaceae',
'Schaereriaceae',
'Scheuchzeriaceae',
'Schisandraceae',
'Schizaeaceae',
'Schlegeliaceae',
'Sciadopityaceae',
'Scoliopaceae',
'Scrophulariaceae',
'Scyphostegiaceae',
'Scytopetalaceae',
'Selaginellaceae',
'Sempervivaceae',
'Sequoiaceae',
'Setchellanthaceae',
'Simaroubaceae',
'Simmondsiaceae',
'Sinofranchetiaceae',
'Smilacaceae',
'Solanaceae',
'Sonneratiaceae',
'Sparganiaceae',
'Spergulaceae',
'Sphaerosepalaceae',
'Sphenocleaceae',
'Sphenostemonaceae',
'Spiraeanthemaceae',
'Stachyuraceae',
'Stackhousiaceae',
'Stangeriaceae',
'Staphyleaceae',
'Stegnospermataceae',
'Stemonaceae',
'Stemonuraceae',
'Stenochlaenaceae',
'Sterculiaceae',
'Stilbaceae',
'Stipaceae',
'Stixaceae',
'Strasburgeriaceae',
'Strelitziaceae',
'Strephonemataceae',
'Stromatopteridaceae',
'Stylidiaceae',
'Stylobasiaceae',
'Stylocerataceae',
'Styracaceae',
'Surianaceae',
'Symphoremataceae',
'Symplocaceae',
'Taccaceae',
'Taenitidaceae',
'Taiwaniaceae',
'Takhtajaniaceae',
'Talinaceae',
'Tamaricaceae',
'Tapisciaceae',
'Taxaceae',
'Taxodiaceae',
'Tecophilaeaceae',
'Tectariaceae',
'Tepuianthaceae',
'Ternstroemiaceae',
'Tetracentraceae',
'Tetrachondraceae',
'Tetradiclidaceae',
'Tetrameristaceae',
'Thalictraceae',
'Theaceae',
'Thelypteridaceae',
'Themidaceae',
'Theophrastaceae',
'Thomandersiaceae',
'Thurniaceae',
'Thymelaeaceae',
'Ticodendraceae',
'Tiliaceae',
'Tofieldiaceae',
'Toricelliaceae',
'Torricelliaceae',
'Tovariaceae',
'Trapaceae',
'Tremandraceae',
'Tribulaceae',
'Trichomanaeaceae',
'Trichopodaceae',
'Tricyrtidaceae',
'Trigoniaceae',
'Trilliaceae',
'Trimeniaceae',
'Triplostegiaceae',
'Tristichaceae',
'Triuridaceae',
'Trochodendraceae',
'Tropaeolaceae',
'Turneraceae',
'Typhaceae',
'Ulmaceae',
'Umbelliferae',
'Unknown',
'Urostachyaceae',
'Urticaceae',
'Vacciniaceae',
'Vahliaceae',
'Valerianaceae',
'Vallisneriaceae',
'Vanillaceae',
'Velloziaceae',
'Verbenaceae',
'Veronicaceae',
'Violaceae',
'Viscaceae',
'Vitaceae',
'Vittariaceae',
'Vochysiaceae',
'Walleriaceae',
'Welwitschiaceae',
'Widdringtoniaceae',
'Winteraceae',
'Wolffiaceae',
'Woodsiaceae',
'Xanthoceraceae',
'Xanthophyllaceae',
'Xanthopyreniaceae',
'Xanthorrhoeaceae',
'Xeronemataceae',
'Xerophyllaceae',
'Xyridaceae',
'Zamiaceae',
'Zannichelliaceae',
'Zingiberaceae',
'Zosteraceae',
'Zygophyllaceae'
);

/*
$families=array(
'Asteraceae',
'Compositae',
'Leguminosae',
);
*/

//$families=array('Verbenaceae');

/*
$families = array(
'Acanthaceae'
);
*/

$count = 0;

foreach ($families as $family)
{
	$sql = '';
	
	$url = 'http://www.ipni.org/ipni/advPlantNameSearch.do?find_family='
	 . $family 
	 . '&find_genus=&find_species=&find_infrafamily=&find_infragenus=&find_infraspecies=&find_authorAbbrev=&find_includePublicationAuthors=on&find_includePublicationAuthors=off&find_includeBasionymAuthors=on&find_includeBasionymAuthors=off&find_publicationTitle=&show_extras=on&find_geoUnit='
	 . '&find_addedSince='
//	 . $d = date("Y-m-d", strtotime("now - 2 months")) 
//	 . '2013-01-01'
//	 . '2015-12-20'
//	 . '2016-04-05'	 
//	 . '2016-08-08'	
//	 . '2016-12-01'		 	 
//     . '2017-04-16'
     . '2017-08-29' // run 2018-04-08

	 . '&find_modifiedSince=&find_isAPNIRecord=on&find_isAPNIRecord=false&find_isGCIRecord=on&find_isGCIRecord=false&find_isIKRecord=on&find_isIKRecord=false&find_rankToReturn=all&output_format=delimited&find_sortByFamily=on&find_sortByFamily=off&query_type=by_query&back_page=plantsearch';

	/*
	//  Henckelia sivagiriensis
	$url = 'http://www.ipni.org/ipni/advPlantNameSearch.do?find_family='
	 . '&find_genus=Henckelia&find_species=sivagiriensis&find_infrafamily=&find_infragenus=&find_infraspecies=&find_authorAbbrev=&find_includePublicationAuthors=on&find_includePublicationAuthors=off&find_includeBasionymAuthors=on&find_includeBasionymAuthors=off&find_publicationTitle=&show_extras=on&find_geoUnit='
	 . '&find_addedSince='
//	 . $d = date("Y-m-d", strtotime("now - 2 months")) 
//	 . '2013-01-01'
//	 . '2015-12-20'
	 . '&find_modifiedSince=&find_isAPNIRecord=on&find_isAPNIRecord=false&find_isGCIRecord=on&find_isGCIRecord=false&find_isIKRecord=on&find_isIKRecord=false&find_rankToReturn=all&output_format=delimited-minimal&find_sortByFamily=on&find_sortByFamily=off&query_type=by_query&back_page=plantsearch';
    */

	//echo $url . "\n";
	
	
	$text = get($url);
	$text = trim($text);
	
	echo $text;
	
	//exit();

	// Get array of individual lines
	$lines = explode ("\n", $text);
	
	print_r($lines);
	
			
	// Extract headings from first line
	$parts = explode ("%", $lines[0]);
	$size=count($parts);
	$heading = array();
	for ($i=0; $i < $size; $i++)
	{
		$heading[$parts[$i]] = $i;
	}
	
	print_r($heading);
	//exit();
	
	// Read each remaining line				
	$size=count($lines);
	for ($i=1; $i < $size; $i++)
	{
		$parts = explode ("%", $lines[$i]);
			
		//print_r($parts);
		//echo "\n";
		
		
		$obj = new stdclass;
	
		$obj->Id = $parts[$heading["Id"]];
		$obj->Version = $parts[$heading["Version"]];
		$obj->Family = $parts[$heading["Family"]];
		$obj->Full_name_without_family_and_authors = $parts[$heading["Full name without family and authors"]];
		$obj->Authors = $parts[$heading["Authors"]];

		$obj->Publication = $parts[$heading["Publication"]];
		
		if (preg_match('/^(?<publication>.*)\s+(?<collation>\d.*)/Uu', $obj->Publication, $m))
		{
			print_r($m);
			$obj->Publication = $m['publication'];
		}
		
		
		
		$obj->Collation = $parts[$heading["Collation"]];
		
		$obj->Genus = $parts[$heading["Genus"]];
		$obj->Species = $parts[$heading["Species"]];
		$obj->Infra_genus = $parts[$heading["Infra genus"]];
		$obj->Infra_species = $parts[$heading["Infra species"]];
		$obj->Rank = $parts[$heading["Rank"]];
		$obj->Remarks = $parts[$heading["Remarks"]];

		$obj->Hybrid_genus = $parts[$heading["Hybrid_genus"]];
		$obj->Hybrid = $parts[$heading["Hybrid"]];
		
		if (preg_match('/\s+(?<year>[0-9]{4})/', $parts[$heading["Reference"]], $m))
		{
			$obj->Publication_year_full = $m['year'];
		}
		
		
		// DOI
		if (preg_match('/doi:(?<doi>10\.\d+\/[a-zA-Z0-9\-\[\(\)\];\.]+)/i', $parts[$heading["Remarks"]], $m))
		{
			//print_r($m);exit();
			$obj->doi = $m['doi'];
		}
		
		
		
		// Fetch more details
		//$url = 'http://www.ipni.org/ipni/plantNameByVersion.do?id=' . $parts[$heading["Id"]] . '&version=' . $parts[$heading["Version"]]
		//	. '&output_format=lsid-metadata';
		
		//echo $url;
		$id = $parts['0'];
		$lsid = 'urn:lsid:ipni.org:names:' . $id;
		$url = 'http://ipni.org/' . $lsid;
			
		echo "-- $url\n";
	
		$rdf = get($url, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/600.5.17 (KHTML, like Gecko) Version/8.0.5 Safari/600.5.17');
		
		if ($rdf != '')
		{
		
			// Store RDF
			{
				$rdf_id = $id;
				$rdf_id = preg_replace('/-\d+$/', '', $rdf_id);
		
				$dir = floor($rdf_id / 1000);
		
				$dir = dirname(__FILE__) . "/rdf/" . $dir;
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
			
				if (($count++ % 5) == 0)
				{
					$rand = rand(1000000, 3000000);
					echo '...sleeping for ' . round(($rand / 1000000),2) . ' seconds' . "\n";
					usleep($rand);
				}
			
			}	
		
		
			//$rdf = get($url);
		
			//echo $rdf;
			
			
		
		
			// Fix IPNI bug
			$rdf = preg_replace('/ & /', ' &amp; ', $rdf);
		
			// extract extra details...
			$dom= new DOMDocument;
			$dom->loadXML($rdf);
			$xpath = new DOMXPath($dom);
		
			$nodeCollection = $xpath->query ("//tn:year");
			foreach($nodeCollection as $node)
			{
				$obj->Publication_year_full = $node->firstChild->nodeValue;
			}

			$nodeCollection = $xpath->query ("//tn:nameComplete");
			foreach($nodeCollection as $node)
			{
				$obj->Full_name_without_family_and_authors = $node->firstChild->nodeValue;
			}
		
			$nodeCollection = $xpath->query ("//tn:genusPart");
			foreach($nodeCollection as $node)
			{
				$obj->Genus = $node->firstChild->nodeValue;
			}

			$nodeCollection = $xpath->query ("//tn:infragenericEpithet");
			foreach($nodeCollection as $node)
			{
				$obj->Infra_genus = $node->firstChild->nodeValue;
			}

			$nodeCollection = $xpath->query ("//tn:specificEpithet");
			foreach($nodeCollection as $node)
			{
				$obj->Species = $node->firstChild->nodeValue;
			}
		
			$nodeCollection = $xpath->query ("//tn:infraspecificEpithet");
			foreach($nodeCollection as $node)
			{
				$obj->Infra_species = $node->firstChild->nodeValue;
			}
		
			$nodeCollection = $xpath->query ("//tn:rankString");
			foreach($nodeCollection as $node)
			{
				$obj->Rank = $node->firstChild->nodeValue;
			}
		
			if ($obj->Rank == 'gen.')
			{
				// tn:uninomial Diphyllocalyx
				$nodeCollection = $xpath->query ("//tn:uninomial");
				foreach($nodeCollection as $node)
				{
					$obj->Genus = $node->firstChild->nodeValue;
				}		
			}

			$nodeCollection = $xpath->query ("//tcom:publishedIn");
			foreach($nodeCollection as $node)
			{
				$publishedIn = $node->firstChild->nodeValue;
			
				//$obj->Publication = $publishedIn;
			
				// debug
				$obj->publishedIn = $publishedIn;
			
				if (!$matched)
				{
					if (preg_match('/(?<publication>.*)\s+(?<collation>\d.*)\.\s+\(?(?<year>[0-9]{4})\)?/Uu', $publishedIn, $m))
					{
						$obj->Publication = $m['publication'];
						$obj->Collation = $m['collation'];
						$matched = true;
					}
				}
		
		
				if (!$matched)
				{
					if (preg_match('/(?<publication>.*)\s+(?<collation>\d.*)\.?\s+\(?(?<year>[0-9]{4})\)?/Uu', $publishedIn, $m))
					{
						$obj->Publication = $m['publication'];
						$obj->Collation = $m['collation'];
						$matched = true;
					}
				}
			}
		
			// Basionym
			// tn:basionymAuthorship
			$nodeCollection = $xpath->query ("//tn:basionymAuthorship");
			foreach($nodeCollection as $node)
			{
				$obj->Basionym_author = $node->firstChild->nodeValue;
			}
			// tn:hasBasionym
			$nodeCollection = $xpath->query ("//tn:hasBasionym/@rdf:resource");
			foreach($nodeCollection as $node)
			{
				$obj->Basionym_Id = str_replace('urn:lsid:ipni.org:names:', '', $node->firstChild->nodeValue);
			}
			
		}
		
		print_r($obj);
		echo "\n";	
		
		$keys = array();
		$values = array();
		
		foreach ($obj as $k => $v)
		{
			switch ($k)
			{
				case 'publishedIn':
					break;
					
				default:
					$keys[] = $k;
					$values[] = '"' . addcslashes($v, '"') . '"';
					break;
			}
		}
		
		$sql .= 'INSERT IGNORE INTO names(' . join(',', $keys) . ') VALUES (' . join(',', $values) . ');' . "\n";
		
		
		
	}
	
	file_put_contents($family . '.sql', $sql);
}

//echo $sql;

?>