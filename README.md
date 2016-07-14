# ipni-names

Mapping between names in the International Plant Names Index [IPNI](http://www.ipni.org) names and bibliographic identifiers.

Names and publications are mapped to a series of bibliographic identifiers, including DOIs, article identifiers from [BioStor](http://biostor.org), [JSTOR](http://jstor.org), and [CiNii](http://ci.nii.ac.jp), Handles, URLs, and PDFs. Individual pages may also be mapped to BHL PageIDs.

This repository stores the current mapping for a subset of the  journals in IPNI, these are in the journals folder as csv (comma separated value) files. For example, the mapping for the Edinburgh Journal of Botany [ISSN 0960-4286](http://www.worldcat.org/issn/0960-4286) is in the file [edinburgh j. bot..csv](https://github.com/rdmpage/ipni-names/blob/master/journals/edinburgh_j._bot..csv). This journal has had every name mapped to a DOI, for example

[77104049-1](http://www.ipni.org/ipni/idPlantNameSearch.do?id=77104049-1) _Begonia rubiteae_ was published in article DOI:10.1017/S0960428609990266

```
Hughes, M., Coyle, C., & Rubite, R. R. (2010, March). A REVISION OF BEGONIA SECTION DIPLOCLINIUM (BEGONIACEAE) ON THE PHILIPPINE ISLAND OF PALAWAN, INCLUDING FIVE NEW SPECIES. Edinburgh Journal of Botany. Cambridge University Press (CUP). doi:10.1017/s0960428609990266
```

## Progress

Progress to date (numbers of IPNI Ids mapped to a bibliographic identifier). There are 1,625,067 names in the working copy of IPNI.

Date: 2014-06-19

```
Identifier   Number of names
DOI               123,006
BioStor            29,066
BHL PageID         19,190
Any               158,387
```

Date: 2015-12-04

```
Identifier   Number of names
DOI                166,618
JSTOR               51,576
BioStor             30,681
BHL PageID          29,969
Any                249,529
```

Date: 2016-07-14
```
Identifier   Number of names
DOI                187,068
JSTOR              105,695
BioStor             43,627
BHL PageID          73,609
Any								 360,917
```

## Browser

There is a simple PHP script index.php for a genus-level browser of the IPNI data (the full dataset isn't included in this repository).

## Dump

Dump IPNI (without bibliographic data)

## Examples

### One DOI encloses others

The DOI http://dx.doi.org/10.15553/c2012v671a12 **Notes on the Flora of Madagascar, 22–25** has the page span 137–151, but each note within the span has its own DOI (e.g., **Notes on the Genus Ochna L. (Ochnaceae) in Madagascar No Access** http://dx.doi.org/10.15553/c2012v671a14 ). This violates assumption that article spans are disjoint (or may intersect on the start and end pages).


## Linking to ORCID

In progress

## Taxonomic examples

*Dinebra decipiens* (DOI 10.1093/aob/mcs077, linked to one ORCID), GBIF has as *Leptochloa decipiens* http://www.gbif.org/species/2703867/, link made by OTT https://tree.opentreeoflife.org/opentree/argus/ottol@724661/Dinebra

## IPNI errors

### Mullaghera
*Mullaghera communis* 509328-1 (and other species in this genus) are linked to Oesterr. Bot. Z. 49:509, etc., but the pages don’t exist. *Mullaghera communis* was published by P. Bubani here: http://biodiversitylibrary.org/page/10609741, see also Index Kewensis http://biodiversitylibrary.org/page/42364805




