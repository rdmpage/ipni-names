<?php
	
$rdf = '<?xml-stylesheet type="text/xsl" href="lsid.rdf.xsl"?>
<rdf:RDF xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xmlns:dc="http://purl.org/dc/elements/1.1/" 
xmlns:dcterms="http://purl.org/dc/terms/"
xmlns:tn="http://rs.tdwg.org/ontology/voc/TaxonName#"
xmlns:tm="http://rs.tdwg.org/ontology/voc/Team#"    
xmlns:tcom="http://rs.tdwg.org/ontology/voc/Common#"    
xmlns:p="http://rs.tdwg.org/ontology/voc/Person#"    
xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
xmlns:owl="http://www.w3.org/2002/07/owl#">
<tn:TaxonName rdf:about="urn:lsid:ipni.org:names:382698-1">	
<tcom:versionedAs rdf:resource="urn:lsid:ipni.org:names:382698-1:1.5"/>
<tn:nomenclaturalCode rdf:resource="http://rs.tdwg.org/ontology/voc/TaxonName#botanical"/>
<owl:versionInfo>1.5</owl:versionInfo>
<dc:title>Saintpaulia pusilla Engl.</dc:title>                        
<dcterms:created>2003-07-02 00:00:00.0</dcterms:created>
<dcterms:modified>2014-01-20 15:13:05.0</dcterms:modified>
<tn:rankString>spec.</tn:rankString>
<tn:nameComplete>Saintpaulia pusilla</tn:nameComplete>
<tn:genusPart>Saintpaulia</tn:genusPart>        
<tn:specificEpithet>pusilla</tn:specificEpithet>                
<tn:authorship>Engl.</tn:authorship>
<tn:authorteam>
<tm:Team>
<tm:name>Engl.</tm:name>
<tm:hasMember rdf:resource="urn:lsid:ipni.org:authors:18509-1"
tm:index="1"
tm:role="Publishing Author"/>
</tm:Team>
</tn:authorteam>
<tcom:publishedIn>Bot. Jahrb. Syst. 28(4): 481. 1900 [13 Jul 1900] </tcom:publishedIn>    
<tn:year>1900</tn:year>        
</tn:TaxonName>  
</rdf:RDF>';

$rdf = '<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="lsid.rdf.xsl"?>
<rdf:RDF xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xmlns:dc="http://purl.org/dc/elements/1.1/" 
xmlns:dcterms="http://purl.org/dc/terms/"
xmlns:tn="http://rs.tdwg.org/ontology/voc/TaxonName#"
xmlns:tm="http://rs.tdwg.org/ontology/voc/Team#"    
xmlns:tcom="http://rs.tdwg.org/ontology/voc/Common#"    
xmlns:p="http://rs.tdwg.org/ontology/voc/Person#"    
xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
xmlns:owl="http://www.w3.org/2002/07/owl#">
<tn:TaxonName rdf:about="urn:lsid:ipni.org:names:77117371-1">	
<tcom:versionedAs rdf:resource="urn:lsid:ipni.org:names:77117371-1:1.2"/>
<tn:nomenclaturalCode rdf:resource="http://rs.tdwg.org/ontology/voc/TaxonName#botanical"/>
<owl:versionInfo>1.2</owl:versionInfo>
<dc:title>Streptocarpus afroviola Christenh.</dc:title>                        
<dcterms:created>2012-02-16 11:14:48.0</dcterms:created>
<dcterms:modified>2012-07-16 12:59:23.0</dcterms:modified>
<tn:rankString>spec.</tn:rankString>
<tn:nameComplete>Streptocarpus afroviola</tn:nameComplete>
<tn:genusPart>Streptocarpus</tn:genusPart>        
<tn:specificEpithet>afroviola</tn:specificEpithet>                
<tn:authorship>Christenh.</tn:authorship>
<tn:authorteam>
<tm:Team>
<tm:name>Christenh.</tm:name>
<tm:hasMember rdf:resource="urn:lsid:ipni.org:authors:40171-1"
tm:index="1"
tm:role="Publishing Author"/>
</tm:Team>
</tn:authorteam>
<tcom:publishedIn>Phytotaxa 46: 5. 2012 [16 Feb 2012] [epublished]</tcom:publishedIn>    
<tn:year>2012</tn:year>        
<tn:hasAnnotation>
<tn:NomenclaturalNote>
<tn:noteType rdf:resource="http://rs.tdwg.org/ontology/voc/TaxonName#replacementNameFor"/>
<tn:objectTaxonName rdf:resource="urn:lsid:ipni.org:names:382698-1"/>
</tn:NomenclaturalNote>
</tn:hasAnnotation>                            
</tn:TaxonName>  
</rdf:RDF>';

/*
$rdf = '<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="lsid.rdf.xsl"?>
<rdf:RDF xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xmlns:dc="http://purl.org/dc/elements/1.1/" 
xmlns:dcterms="http://purl.org/dc/terms/"
xmlns:tn="http://rs.tdwg.org/ontology/voc/TaxonName#"
xmlns:tm="http://rs.tdwg.org/ontology/voc/Team#"    
xmlns:tcom="http://rs.tdwg.org/ontology/voc/Common#"    
xmlns:p="http://rs.tdwg.org/ontology/voc/Person#"    
xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
xmlns:owl="http://www.w3.org/2002/07/owl#">
<tn:TaxonName rdf:about="urn:lsid:ipni.org:names:20012728-1:1.1">
<tcom:versionedAs rdf:resource="urn:lsid:ipni.org:names:20012728-1:1.1"/>
<tn:nomenclaturalCode rdf:resource="http://rs.tdwg.org/ontology/voc/TaxonName#botanical"/>
<owl:versionInfo>1.1</owl:versionInfo>
<dc:title>Poissonia heterantha (Griseb.) Lavin</dc:title>                        
<dcterms:created>2003-07-02 00:00:00.0</dcterms:created>
<dcterms:modified>2003-07-02 00:00:00.0</dcterms:modified>
<tn:rankString>spec.</tn:rankString>
<tn:nameComplete>Poissonia heterantha</tn:nameComplete>
<tn:genusPart>Poissonia</tn:genusPart>        
<tn:specificEpithet>heterantha</tn:specificEpithet>                
<tn:authorship>(Griseb.) Lavin</tn:authorship>
<tn:basionymAuthorship>Griseb.</tn:basionymAuthorship>
<tn:combinationAuthorship>Lavin</tn:combinationAuthorship>
<tn:authorteam>
<tm:Team>
<tm:name>(Griseb.) Lavin</tm:name>
<tm:hasMember rdf:resource="urn:lsid:ipni.org:authors:22110-1"
tm:index="1"
tm:role="Combination Author"/>
<tm:hasMember rdf:resource="urn:lsid:ipni.org:authors:3397-1" 
tm:index="1"
tm:role="Basionym Author"/>
</tm:Team>
</tn:authorteam>
<tcom:publishedIn>Syst. Bot. 28(2): 401 (2003). </tcom:publishedIn>    
<tn:year>2003</tn:year>        
<tn:hasBasionym rdf:resource="urn:lsid:ipni.org:names:520610-1"/>
</tn:TaxonName>  
</rdf:RDF>';
*/

/*
$rdf = '<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="lsid.rdf.xsl"?>
<rdf:RDF xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xmlns:dc="http://purl.org/dc/elements/1.1/" 
xmlns:dcterms="http://purl.org/dc/terms/"
xmlns:tn="http://rs.tdwg.org/ontology/voc/TaxonName#"
xmlns:tm="http://rs.tdwg.org/ontology/voc/Team#"    
xmlns:tcom="http://rs.tdwg.org/ontology/voc/Common#"    
xmlns:p="http://rs.tdwg.org/ontology/voc/Person#"    
xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
xmlns:owl="http://www.w3.org/2002/07/owl#">
<tn:TaxonName rdf:about="urn:lsid:ipni.org:names:23315-1:1.3">
<tcom:versionedAs rdf:resource="urn:lsid:ipni.org:names:23315-1:1.3"/>
<tn:nomenclaturalCode rdf:resource="http://rs.tdwg.org/ontology/voc/TaxonName#botanical"/>
<owl:versionInfo>1.3</owl:versionInfo>
<dc:title>Poissonia Baill.</dc:title>                
<dcterms:created>2003-07-02 00:00:00.0</dcterms:created>
<dcterms:modified>2008-07-18 12:25:07.0</dcterms:modified>
<tn:rankString>gen.</tn:rankString>
<tn:nameComplete>Poissonia</tn:nameComplete>
<tn:uninomial>Poissonia</tn:uninomial>
<tn:authorship>Baill.</tn:authorship>
<tn:authorteam>
<tm:Team>
<tm:name>Baill.</tm:name>
<tm:hasMember rdf:resource="urn:lsid:ipni.org:authors:31201-1"
tm:index="1"
tm:role="Publishing Author"/>
</tm:Team>
</tn:authorteam>
<tcom:publishedIn>Adansonia 9: 295. 1870 </tcom:publishedIn>    
<tn:year>1870</tn:year>        
</tn:TaxonName>  
</rdf:RDF>';
*/


$rdf = '<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="lsid.rdf.xsl"?>
<rdf:RDF xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xmlns:dc="http://purl.org/dc/elements/1.1/" 
xmlns:dcterms="http://purl.org/dc/terms/"
xmlns:tn="http://rs.tdwg.org/ontology/voc/TaxonName#"
xmlns:tm="http://rs.tdwg.org/ontology/voc/Team#"    
xmlns:tcom="http://rs.tdwg.org/ontology/voc/Common#"    
xmlns:p="http://rs.tdwg.org/ontology/voc/Person#"    
xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
xmlns:owl="http://www.w3.org/2002/07/owl#">
<tn:TaxonName rdf:about="urn:lsid:ipni.org:names:77148630-1:1.3">
<tcom:versionedAs rdf:resource="urn:lsid:ipni.org:names:77148630-1:1.3"/>
<tn:nomenclaturalCode rdf:resource="http://rs.tdwg.org/ontology/voc/TaxonName#botanical"/>
<owl:versionInfo>1.3</owl:versionInfo>
<dc:title>Arquita Gagnon, G.P.Lewis &amp; C.E.Hughes</dc:title>                
<dcterms:created>2015-07-21 14:25:41.0</dcterms:created>
<dcterms:modified>2015-07-21 14:47:56.0</dcterms:modified>
<tn:rankString>gen.</tn:rankString>
<tn:nameComplete>Arquita</tn:nameComplete>
<tn:uninomial>Arquita</tn:uninomial>
<tn:authorship>Gagnon, G.P.Lewis &amp; C.E.Hughes</tn:authorship>
<tn:authorteam>
<tm:Team>
<tm:name>Gagnon, G.P.Lewis &amp; C.E.Hughes</tm:name>
<tm:hasMember rdf:resource="urn:lsid:ipni.org:authors:20028451-1"
tm:index="1"
tm:role="Publishing Author"/>
<tm:hasMember rdf:resource="urn:lsid:ipni.org:authors:12197-1"
tm:index="2"
tm:role="Publishing Author"/>
<tm:hasMember rdf:resource="urn:lsid:ipni.org:authors:35383-1"
tm:index="3"
tm:role="Publishing Author"/>
</tm:Team>
</tn:authorteam>
<tcom:publishedIn>Taxon 64(3): 479. 2015 [25 Jun 2015] </tcom:publishedIn>    
<tn:year>2015</tn:year>        
<tn:typifiedBy>
<tn:NomenclaturalType>
<dc:title>Arquita mimosifolia (Griseb.) Gagnon, G.P.Lewis &amp; C.E.Hughes</dc:title>
<tn:typeName rdf:resource="urn:lsid:ipni.org:names:77148634-1"/>
</tn:NomenclaturalType>
</tn:typifiedBy>        
<tn:typifiedBy>
<tn:NomenclaturalType>
<dc:title>Arquita mimosifolia (Griseb.) Gagnon, G.P.Lewis &amp; C.E.Hughes</dc:title>
</tn:NomenclaturalType>
</tn:typifiedBy>
</tn:TaxonName>  
</rdf:RDF>';

$rdf = '<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="lsid.rdf.xsl"?>
<rdf:RDF xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xmlns:dc="http://purl.org/dc/elements/1.1/" 
xmlns:dcterms="http://purl.org/dc/terms/"
xmlns:tn="http://rs.tdwg.org/ontology/voc/TaxonName#"
xmlns:tm="http://rs.tdwg.org/ontology/voc/Team#"    
xmlns:tcom="http://rs.tdwg.org/ontology/voc/Common#"    
xmlns:p="http://rs.tdwg.org/ontology/voc/Person#"    
xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
xmlns:owl="http://www.w3.org/2002/07/owl#">
<tn:TaxonName rdf:about="urn:lsid:ipni.org:names:77148748-1:1.2">
<tcom:versionedAs rdf:resource="urn:lsid:ipni.org:names:77148748-1:1.2"/>
<tn:nomenclaturalCode rdf:resource="http://rs.tdwg.org/ontology/voc/TaxonName#botanical"/>
<owl:versionInfo>1.2</owl:versionInfo>
<dc:title>Skiatophytum flaccidifolium Klak</dc:title>                        
<dcterms:created>2015-07-22 14:18:06.0</dcterms:created>
<dcterms:modified>2015-09-28 15:21:24.0</dcterms:modified>
<tn:rankString>spec.</tn:rankString>
<tn:nameComplete>Skiatophytum flaccidifolium</tn:nameComplete>
<tn:genusPart>Skiatophytum</tn:genusPart>        
<tn:specificEpithet>flaccidifolium</tn:specificEpithet>                
<tn:authorship>Klak</tn:authorship>
<tn:authorteam>
<tm:Team>
<tm:name>Klak</tm:name>
<tm:hasMember rdf:resource="urn:lsid:ipni.org:authors:38340-1"
tm:index="1"
tm:role="Publishing Author"/>
</tm:Team>
</tn:authorteam>
<tcom:publishedIn>Taxon 64(3): 519. 2015 [25 Jun 2015] </tcom:publishedIn>    
<tn:year>2015</tn:year>        
<tn:typifiedBy>
<tn:NomenclaturalType>
<dc:title>T.M.Salter 5119, BOL (holo)</dc:title>
<tn:typeSpecimen>T.M.Salter 5119, BOL</tn:typeSpecimen>
<tn:typeOfType rdf:resource="http://rs.tdwg.org/ontology/voc/TaxonName#holo"/>
</tn:NomenclaturalType>
</tn:typifiedBy>
</tn:TaxonName>  
</rdf:RDF>';

$rdf = '<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="lsid.rdf.xsl"?>
<rdf:RDF xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xmlns:dc="http://purl.org/dc/elements/1.1/" 
xmlns:dcterms="http://purl.org/dc/terms/"
xmlns:tn="http://rs.tdwg.org/ontology/voc/TaxonName#"
xmlns:tm="http://rs.tdwg.org/ontology/voc/Team#"    
xmlns:tcom="http://rs.tdwg.org/ontology/voc/Common#"    
xmlns:p="http://rs.tdwg.org/ontology/voc/Person#"    
xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
xmlns:owl="http://www.w3.org/2002/07/owl#">
<tn:TaxonName rdf:about="urn:lsid:ipni.org:names:77073643-1:1.1">
<tcom:versionedAs rdf:resource="urn:lsid:ipni.org:names:77073643-1:1.1"/>
<tn:nomenclaturalCode rdf:resource="http://rs.tdwg.org/ontology/voc/TaxonName#botanical"/>
<owl:versionInfo>1.1</owl:versionInfo>
<dc:title>Peperomia columnaris Hutchison ex Pino &amp; Klopf.</dc:title>                        
<dcterms:created>2006-10-26 04:42:28.0</dcterms:created>
<dcterms:modified>2006-10-26 04:42:28.0</dcterms:modified>
<tn:rankString>spec.</tn:rankString>
<tn:nameComplete>Peperomia columnaris</tn:nameComplete>
<tn:genusPart>Peperomia</tn:genusPart>        
<tn:specificEpithet>columnaris</tn:specificEpithet>                
<tn:authorship>Hutchison ex Pino &amp; Klopf.</tn:authorship>
<tn:authorteam>
<tm:Team>
<tm:name>Hutchison ex Pino &amp; Klopf.</tm:name>
<tm:hasMember rdf:resource="urn:lsid:ipni.org:authors:4251-1"
tm:index="1"
tm:role="Publishing Author"/>
<tm:hasMember rdf:resource="urn:lsid:ipni.org:authors:40473-1"
tm:index="1"
tm:role="Publishing Ex Author"/>
<tm:hasMember rdf:resource="urn:lsid:ipni.org:authors:40471-1"
tm:index="2"
tm:role="Publishing Ex Author"/>
</tm:Team>
</tn:authorteam>
<tcom:publishedIn>Haseltonia 11: 103 (-106; figs. 1-6). 2005 [15 Dec 2005] </tcom:publishedIn>    
<tn:year>2005</tn:year>        
<tn:typifiedBy>
<tn:NomenclaturalType>
<dc:title>P.Hutchison &amp; J.K.Wright 4980, UC (holo)</dc:title>
<tn:typeSpecimen>P.Hutchison &amp; J.K.Wright 4980, UC</tn:typeSpecimen>
<tn:typeOfType rdf:resource="http://rs.tdwg.org/ontology/voc/TaxonName#holo"/>
</tn:NomenclaturalType>
</tn:typifiedBy>
<tn:typifiedBy>
<tn:NomenclaturalType>
<dc:title>P.Hutchison &amp; J.K.Wright 4980, USM (iso)</dc:title>
<tn:typeSpecimen>P.Hutchison &amp; J.K.Wright 4980, USM</tn:typeSpecimen>
<tn:typeOfType rdf:resource="http://rs.tdwg.org/ontology/voc/TaxonName#iso"/>
</tn:NomenclaturalType>
</tn:typifiedBy>
<tn:typifiedBy>
<tn:NomenclaturalType>
<dc:title>P.Hutchison &amp; J.K.Wright 4980, G (iso)</dc:title>
<tn:typeSpecimen>P.Hutchison &amp; J.K.Wright 4980, G</tn:typeSpecimen>
<tn:typeOfType rdf:resource="http://rs.tdwg.org/ontology/voc/TaxonName#iso"/>
</tn:NomenclaturalType>
</tn:typifiedBy>
<tn:typifiedBy>
<tn:NomenclaturalType>
<dc:title>P.Hutchison &amp; J.K.Wright 4980, K (iso)</dc:title>
<tn:typeSpecimen>P.Hutchison &amp; J.K.Wright 4980, K</tn:typeSpecimen>
<tn:typeOfType rdf:resource="http://rs.tdwg.org/ontology/voc/TaxonName#iso"/>
</tn:NomenclaturalType>
</tn:typifiedBy>
<tn:typifiedBy>
<tn:NomenclaturalType>
<dc:title>P.Hutchison &amp; J.K.Wright 4980, P (iso)</dc:title>
<tn:typeSpecimen>P.Hutchison &amp; J.K.Wright 4980, P</tn:typeSpecimen>
<tn:typeOfType rdf:resource="http://rs.tdwg.org/ontology/voc/TaxonName#iso"/>
</tn:NomenclaturalType>
</tn:typifiedBy>
</tn:TaxonName>  
</rdf:RDF>';

	{
	
		// Fix IPNI bug
		$rdf = preg_replace('/ & /', ' &amp; ', $rdf);

		$obj = new stdclass;
		
		// extract extra details...
		$dom= new DOMDocument;
		$dom->loadXML($rdf);
		$xpath = new DOMXPath($dom);
		
		$xpath->registerNamespace("rdf", 		"http://www.w3.org/1999/02/22-rdf-syntax-ns#");
		$xpath->registerNamespace("dc", 		"http://purl.org/dc/elements/1.1/" );
		$xpath->registerNamespace("dcterms", 	"http://purl.org/dc/terms/");
		$xpath->registerNamespace("tn", 		"http://rs.tdwg.org/ontology/voc/TaxonName#");
		$xpath->registerNamespace("tm", 		"http://rs.tdwg.org/ontology/voc/Team#" );
		$xpath->registerNamespace("tcom", 		"http://rs.tdwg.org/ontology/voc/Common#" );
		$xpath->registerNamespace("p", 			"http://rs.tdwg.org/ontology/voc/Person#" );
		$xpath->registerNamespace("owl", 		"http://www.w3.org/2002/07/owl#" );
		
		
		$nodeCollection = $xpath->query ("//tn:TaxonName/@rdf:about");
		foreach($nodeCollection as $node)
		{
			$obj->Id = $node->firstChild->nodeValue;
			$obj->Id = str_replace('urn:lsid:ipni.org:names:', '', $obj->Id);
		}
		
		$nodeCollection = $xpath->query ("//owl:versionInfo");
		foreach($nodeCollection as $node)
		{
			$obj->versionInfo = $node->firstChild->nodeValue;
			$obj->Id = str_replace(':' . $obj->versionInfo, '', $obj->Id);
		}
		
		$nodeCollection = $xpath->query ("//tn:year");
		foreach($nodeCollection as $node)
		{
			$obj->year = $node->firstChild->nodeValue;
		}

		$nodeCollection = $xpath->query ("//tn:nameComplete");
		foreach($nodeCollection as $node)
		{
			$obj->nameComplete = $node->firstChild->nodeValue;
		}
	
		$nodeCollection = $xpath->query ("//tn:genusPart");
		foreach($nodeCollection as $node)
		{
			$obj->genusPart = $node->firstChild->nodeValue;
		}

		$nodeCollection = $xpath->query ("//tn:infragenericEpithet");
		foreach($nodeCollection as $node)
		{
			$obj->infragenericEpithet = $node->firstChild->nodeValue;
		}

		$nodeCollection = $xpath->query ("//tn:specificEpithet");
		foreach($nodeCollection as $node)
		{
			$obj->specificEpithet = $node->firstChild->nodeValue;
		}
	
		$nodeCollection = $xpath->query ("//tn:infraspecificEpithet");
		foreach($nodeCollection as $node)
		{
			$obj->infraspecificEpithet = $node->firstChild->nodeValue;
		}
	
		$nodeCollection = $xpath->query ("//tn:rankString");
		foreach($nodeCollection as $node)
		{
			$obj->rankString = $node->firstChild->nodeValue;
		}
	
		if ($obj->rankString == 'gen.')
		{
			// tn:uninomial Diphyllocalyx
			$nodeCollection = $xpath->query ("//tn:uninomial");
			foreach($nodeCollection as $node)
			{
				$obj->uninomial = $node->firstChild->nodeValue;
			}		
		}

		//------------------------ authors -----------------------------------------------
		$nodeCollection = $xpath->query ("//tn:authorship");
		foreach($nodeCollection as $node)
		{
			$obj->authorship = $node->firstChild->nodeValue;
		}		
		
		
		/*
		<tm:Team>
		<tm:name>Gagnon, G.P.Lewis &amp; C.E.Hughes</tm:name>
		<tm:hasMember rdf:resource="urn:lsid:ipni.org:authors:20028451-1"
		*/
		
		$nodeCollection = $xpath->query ("//tm:Team/tm:hasMember/@rdf:resource");
		foreach($nodeCollection as $node)
		{
			$obj->team[] = str_replace('urn:lsid:ipni.org:authors:', '', $node->firstChild->nodeValue);
		}
		

		//------------------------ publication--------------------------------------------
		$nodeCollection = $xpath->query ("//tcom:publishedIn");
		foreach($nodeCollection as $node)
		{
			$publishedIn = $node->firstChild->nodeValue;
		
			$obj->Publication = $publishedIn;
		
			// debug
			$obj->publishedIn = $publishedIn;
		
			$matched = false;
		
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
	
		//----------------------- synonyms -----------------------------------------------
		// Basionym
		// tn:basionymAuthorship
		$nodeCollection = $xpath->query ("//tn:basionymAuthorship");
		foreach($nodeCollection as $node)
		{
			$obj->basionymAuthorship = $node->firstChild->nodeValue;
		}
		// tn:hasBasionym
		$nodeCollection = $xpath->query ("//tn:hasBasionym/@rdf:resource");
		foreach($nodeCollection as $node)
		{
			$obj->hasBasionym = str_replace('urn:lsid:ipni.org:names:', '', $node->firstChild->nodeValue);
		}

		// NomenclaturalNote (e.g., replacement name)
		$nodeCollection = $xpath->query ("//tn:NomenclaturalNote");
		foreach($nodeCollection as $node)
		{
			$noteType = '';
			$nc = $xpath->query ("tn:noteType/@rdf:resource", $node);
			foreach($nc as $n)
			{
				$noteType = str_replace('http://rs.tdwg.org/ontology/voc/TaxonName#', '', $n->firstChild->nodeValue);
			}
			
			if ($noteType != '' )
			{
				$nc = $xpath->query ("tn:objectTaxonName/@rdf:resource", $node);
				foreach($nc as $n)
				{
					$obj->{$noteType} = str_replace('urn:lsid:ipni.org:names:', '', $n->firstChild->nodeValue);
				}
			}
		}
		
		// types
		/*
		<tn:typifiedBy>
<tn:NomenclaturalType>
<dc:title>Arquita mimosifolia (Griseb.) Gagnon, G.P.Lewis &amp; C.E.Hughes</dc:title>
<tn:typeName rdf:resource="urn:lsid:ipni.org:names:77148634-1"/>
</tn:NomenclaturalType>
</tn:typifiedBy>       */

/* <tn:typifiedBy>
<tn:NomenclaturalType>
<dc:title>T.M.Salter 5119, BOL (holo)</dc:title>
<tn:typeSpecimen>T.M.Salter 5119, BOL</tn:typeSpecimen>
<tn:typeOfType rdf:resource="http://rs.tdwg.org/ontology/voc/TaxonName#holo"/>
</tn:NomenclaturalType>
</tn:typifiedBy>
*/
		$nodeCollection = $xpath->query ("//tn:typifiedBy/tn:NomenclaturalType");
		foreach($nodeCollection as $node)
		{
			$nc = $xpath->query ("tn:typeName/@rdf:resource", $node);
			foreach($nc as $n)
			{
				$obj->typeName = str_replace('urn:lsid:ipni.org:names:', '', $n->firstChild->nodeValue);
			}
			$nc = $xpath->query ("tn:typeSpecimen", $node);
			foreach($nc as $n)
			{
				$typeSpecimen = $n->firstChild->nodeValue;
				
				$nnc = $xpath->query ("tn:typeOfType/@rdf:resource", $node);
				foreach($nnc as $nn)
				{
					$type = $nn->firstChild->nodeValue;
					$type = str_replace('http://rs.tdwg.org/ontology/voc/TaxonName#', '', $type);
					$typeSpecimen .= ' (' . $type . ')';
				}
				$obj->typeSpecimen[] = $typeSpecimen;

			}
			
		}

		
		
		// unset stuff if needed
		unset($obj->Publication);
		unset($obj->Collation);
	
		print_r($obj);
		echo "\n";	
		/*
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
	
	
		$sql = 'INSERT IGNORE INTO names(' . join(',', $keys) . ') VALUES (' . join(',', $values) . ');' . "\n";
	
		echo $sql;
		*/
	
	}	
	


?>