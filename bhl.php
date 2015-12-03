<?php

// fetch a BHL page image and highlight search terms 

require_once(dirname(__FILE__) . '/lib.php');

$PageID = $_GET['PageID'];
$term = $_GET['term'];

//$imageUrl = 'http://direct.biostor.org/bhl_image.php?PageID=' . $PageID;
$imageUrl = 'http://www.biodiversitylibrary.org/pagethumb/' . $PageID . ',500,500';

$xml = get('http://direct.biostor.org/bhl_page_xml.php?PageID=' . $PageID);

if ($xml != '<?xml version="1.0" ?>')
{
	
	$xp = new XsltProcessor();
	$xsl = new DomDocument;
	$xsl->load(dirname(__FILE__) . '/djvu2html.xsl');
	$xp->importStylesheet($xsl);	
	
	// Load XML
	$dom= new DOMDocument;
	$dom->loadXML($xml);
	$xpath = new DOMXPath($dom);
	
	// Export HTML with background image using XSLT
	
	$xp->setParameter('', 'imageUrl', $imageUrl);
	$xp->setParameter('', 'widthpx', 500);
	$xp->setParameter('', 'term', $term);
	
	$html = $xp->transformToXML($dom);
}
else
{
	$html = '<span style="background-color:orange;color-white;">Warning: no XML!</span><img style="border:1px solid rgb(228,228,228);" src="' . $imageUrl . '" width="500" />';
}
$data = new stdclass;
$data->html = $html;

echo json_encode($data);


?>