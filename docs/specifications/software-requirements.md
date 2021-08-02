# Currency Converter


A feladat egy két modulból álló projekt implementációja. A programunk egy egyszerű valutaváltó program, aminek a beérkező adatok alapján képesnek kell lennie egy adott valutáról egy másik valutára váltani egy-egy nominális értéket.

Az elkészült kódot egy Github repository-n keresztül szeretnénk megkapni, a hozzátartozó összes konfigurációval és leírással együtt.
### Backend module
A backend funkciókat PHP nyelven kell implementálni. Fontos, hogy a szolgáltatásunkat production-ready módon készítsük el, így biztosítva a minél magasabb rendelkezésre állást. Ennek érdekében fontos, hogy az elkészült alkalmazásunk komponensei könnyen cserélhetőek legyenek, kiterjeszthetőek legyenek, ezért amire tudunk, vezessünk be absztraktokat, interfészeket.

Az alkalmazásnak a konverzióhoz több külső API integrációja lesz, innen fogjuk az éppen aktuális valuta árfolyamokat megtudni. Ezek a szolgáltatások általában alacsony rendelkezésre állást garantálnak, így szükséges egy primary, és egy secondary integráció is, így ha az elsődleges szolgáltatás nem elérhető, akkor a másodlagos nagy valószínűséggel ki tud minket szolgálni.

A backend modul önmagában egy JSON API lesz, autentikáció nem szükséges. A JSON végpontok leírását egy OpenAPI definícióba küldjük el, ez alapján kellene működnie az API-nak.

A váltható valuták (a from és a to is) egy előre definiált listában lesznek meghatározva, ezeket később csak kódból lehet bővíteni.

* Az elsődleges szolgáltatás, ahonnan a valuták váltásához az információt meg tudjuk kapni: https://free.currencyconverterapi.com/
* A másodlagos szolgáltatás pedig ez: https://exchangeratesapi.io/

### Frontend module

A frontend modulnak a feladata az, hogy elkérje a felhasználótól a from és a to valutákat, illetve azt, hogy mekkora összeget szeretne váltani. Ezekkel az információkkal megszólítja az első modulban implementált REST API-t, és valamilyen módon jelzi a felhasználónak az új, átváltott értéket.

Autentikáció nem szükséges, publikusan elérhető frontend modul legyen.
A design nem elvárás, a funkcionalitáson van a hangsúly.
Követelmények
A feladat implementálása során a következő követelményeknek kell teljesülnie:

* A feladat PHP-ban került implementálásra.
* A backend modul API-ja a megadott végpontokat kiszolgálja.
* A primary és secondary külső szolgáltatás is integrálva lett.
* A program indításához szükséges konfigurációk, leírások rendelkezésre állnak.
* Composer leíró fájl a repository-ban a külső függőségek telepítéséhez.

#### Nice-to-haves
A feladat implementálása során nem követelmény, de plusz pontot érő szempontok a következők:

* Dockerizált applikáció, docker-compose leíróval
* Egy harmadik megoldás arra az esetre, ha a primary és a secondary szolgáltatás se elérhető (fontos, hogy itt nem szeretnénk egy adatbázist vezetni, illetve nem szeretnénk harmadik külső szolgáltatást bevonni) (nem szükséges implementáció, elég csak az ötlet)
* Szofisztikáltabb RetryTemplate mechanizmus implementálása API hiba esetére

### Swagger
Itt található az OPEN API leíró:
[OpenAPI Speciifcation](./api-specification.yml)

Segítség a felhasználásához:  https://editor.swagger.io/

