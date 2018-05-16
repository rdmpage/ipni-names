# Annotation idea

Treat BHL PageIDs as annotations following [W3C annotation model](https://www.w3.org/TR/annotation-vocab/).

Use BHL PageID as target because we are annotating the whole page (BHL doesn’t know the location of the name on the page).

We have two bodies, the first is a simple text string with the name, so it is comparable to machine or human “tagging” of the page, and so these annotations will be found as part of a simple search on that string. The other body is the URI of the name in IPNI, and again we can do a simple query (what is annotated by this name?

```
{
  "@id": "_:b701640175",
  "@type": "oa:Annotation",
  
  // body is name
  "oa:hasBody": [
     {
     // tagging a name, just like we would in the rest of BHL, or by hand
    "@type": "oa:TextualBody",
    "rdf:value": "Begonia pensilis",
    "oa:hasPurpose": {
        "@id": "oa:tagging"
     },

     // we know that this is the location referred to by an IPNI name
    {
        "@id": "urn:lsid:ipni.org:names:907631-1"
    },
    
   },
   // target is page in BHL
   "oa:hasTarget": { 
    "@id": "https://biodiversitylibrary.org/page/12978469" 
  }
}
```

