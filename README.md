# ipni-names

Mapping between names in the International Plant Names Index [IPNI](http://www.ipni.org) names and bibliographic identifiers.

Names and publications are mapped to a series of bibliographic identifiers, including DOIs, article identifiers from [BioStor](http://biostor.org), [JSTOR](http://jstor.org), and [CiNii](http://ci.nii.ac.jp), Handles, URLs, and PDFs. Individual pages may also be mapped to BHL PageIDs.

This repository stores the current mapping for a subset of the  journals in IPNI, these are in the journals folder as tsv (tab separated value) files. For example, the mapping for the Edinburgh Journal of Botany [ISSN 0960-4286](http://www.worldcat.org/issn/0960-4286) is in the file edinburgh j. bot..tsv. This journal has had every name mapped to a DOI, for example

[77104049-1](http://www.ipni.org/ipni/idPlantNameSearch.do?id=77104049-1) _Begonia rubiteae_ was published in article DOI:10.1017/S0960428609990266

```
Hughes, M., Coyle, C., & Rubite, R. R. (2010, March). A REVISION OF BEGONIA SECTION DIPLOCLINIUM (BEGONIACEAE) ON THE PHILIPPINE ISLAND OF PALAWAN, INCLUDING FIVE NEW SPECIES. Edinburgh Journal of Botany. Cambridge University Press (CUP). doi:10.1017/s0960428609990266
```

## Browser

There is a simple PHP script index.php for a genus-level browser of the IPNI data (the full dataset isn't included in this repository).



