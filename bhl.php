<?php

// fetch a BHL page image and highlight search terms 

require_once(dirname(__FILE__) . '/lib.php');

$PageID = $_GET['PageID'];
$term = $_GET['term'];

$xml = get('http://biostor.org/bhl_page_xml.php?PageID=' . $PageID);

$xp = new XsltProcessor();
$xsl = new DomDocument;
$xsl->load(dirname(__FILE__) . '/djvu2html.xsl');
$xp->importStylesheet($xsl);	

// Load XML
$dom= new DOMDocument;
$dom->loadXML($xml);
$xpath = new DOMXPath($dom);

// Export HTML with background image using XSLT
$imageUrl = 'http://biostor.org/bhl_image.php?PageID=' . $PageID;
$xp->setParameter('', 'imageUrl', $imageUrl);
$xp->setParameter('', 'widthpx', 500);
$xp->setParameter('', 'term', $term);

$html = $xp->transformToXML($dom);

$data = new stdclass;
$data->html = $html;

echo json_encode($data);


?>