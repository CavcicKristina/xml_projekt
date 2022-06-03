# xml_projekt
XML Projekt - Dog API, JSON, PHP

###### Kako je projekt osmišljen, arhitektura?
Projekt ima tri glavne datoteke: index.php, results.json, style.css. U folderu "video" nalazi se video gdje se demonstrira kako se koristi stranica. U folderu "images" se nalazi slika koja se nalazi na stranici.

###### index.php i results.json
U index.php se nalaze dvije forme. 
- Forma na lijevo 
  - Traži od korisnika broj, uzima tu vrijednost i šalje Dog API-u i nazad se dobije JSON podaci činjenica o psima, u količini što je korisnik naveo.
  - Zatim sprema sve te podatke u results.json datoteku *(Podaci koji dolaze u .json se uvijek nadodaju na kraj datoteke, stalno se nadopunjava)*
  - Na kraju se pomoću petlje ispisuju činjenice koje se vide ispod forme
- Forma na desno 
  - Ako korisnik stisne tipku "Yes", PHP odlazi u datoteku resluts.json gdje povlači sve podatke koji se nalaze u njoj *(od prijašnjih zahtjeva sa prvom formom)* 
  - Na isti način kao i forma na lijevo, petljom se ispisuju sve činjenice koje se nalaze u results.json
