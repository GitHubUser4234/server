OC.L10N.register(
    "user_ldap",
    {
    "Failed to clear the mappings." : "Nem sikerült törölni a hozzárendeléseket.",
    "Failed to delete the server configuration" : "Nem sikerült törölni a kiszolgáló konfigurációját",
    "The configuration is valid and the connection could be established!" : "A konfiguráció érvényes, és a kapcsolat létrehozható!",
    "The configuration is valid, but the Bind failed. Please check the server settings and credentials." : "A konfiguráció érvényes, de a kapcsolat nem hozható létre. Kérem ellenőrizze a kiszolgáló beállításait, és az elérési adatokat.",
    "The configuration is invalid. Please have a look at the logs for further details." : "Érvénytelen konfiguráció. További információkért nézze meg a naplófájlokat!",
    "No action specified" : "Nincs megadva parancs",
    "No configuration specified" : "Nincs megadva konfiguráció",
    "No data specified" : "Nincs adat megadva",
    " Could not set configuration %s" : "A(z) %s konfiguráció nem állítható be",
    "Configuration incorrect" : "Konfiguráió hibás",
    "Configuration incomplete" : "Konfiguráció nincs befejezve",
    "Configuration OK" : "Konfiguráció OK",
    "Select groups" : "Csoportok kiválasztása",
    "Select object classes" : "Objektumosztályok kiválasztása",
    "{nthServer}. Server" : "{nthServer}. Kiszolgáló",
    "Do you really want to delete the current Server Configuration?" : "Tényleg törölni szeretné a kiszolgáló beállításait?",
    "Confirm Deletion" : "A törlés megerősítése",
    "Select attributes" : "Attribútumok kiválasztása",
    "_%s group found_::_%s groups found_" : ["%s csoport van","%s csoport van"],
    "_%s user found_::_%s users found_" : ["%s felhasználó van","%s felhasználó van"],
    "Could not find the desired feature" : "A kívánt funkció nem található",
    "Invalid Host" : "Érvénytelen gépnév",
    "Server" : "Kiszolgáló",
    "Users" : "Felhasználók",
    "Groups" : "Csoportok",
    "Test Configuration" : "A beállítások tesztelése",
    "Help" : "Súgó",
    "Groups meeting these criteria are available in %s:" : "A %s szolgáltatás azon csoportok létezését veszi figyelembe, amik a következő feltételeknek felelnek meg:",
    "The filter specifies which LDAP groups shall have access to the %s instance." : "A szűrő meghatározza, hogy mely LDAP csoportok lesznek jogosultak %s elérésére.",
    "Other Attributes:" : "Más attribútumok:",
    "Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action. Example: \"uid=%%uid\"" : "Ez a szűrő érvényes a bejelentkezés megkísérlésekor. Ekkor az %%uid változó helyére a bejelentkezési név kerül. Például: \"uid=%%uid\"",
    "1. Server" : "1. Kiszolgáló",
    "%s. Server:" : "%s. kiszolgáló",
    "Host" : "Kiszolgáló",
    "You can omit the protocol, except you require SSL. Then start with ldaps://" : "A protokoll előtag elhagyható, kivéve, ha SSL-t kíván használni. Ebben az esetben kezdje így:  ldaps://",
    "Port" : "Port",
    "User DN" : "A kapcsolódó felhasználó DN-je",
    "The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." : "Annak a felhasználónak a DN-je, akinek a nevében bejelentkezve kapcsolódunk a kiszolgálóhoz, pl. uid=agent,dc=example,dc=com. Bejelentkezés nélküli eléréshez ne töltse ki a DN és Jelszó mezőket!",
    "Password" : "Jelszó",
    "For anonymous access, leave DN and Password empty." : "Bejelentkezés nélküli eléréshez ne töltse ki a DN és Jelszó mezőket!",
    "One Base DN per line" : "Soronként egy DN-gyökér",
    "You can specify Base DN for users and groups in the Advanced tab" : "A Haladó fülre kattintva külön DN-gyökér állítható be a felhasználók és a csoportok számára",
    "Manually enter LDAP filters (recommended for large directories)" : "LDAP szűrők kézi beállitása (ajánlott a nagy könyvtáraknál)",
    "Limit %s access to users meeting these criteria:" : "Korlátozzuk a %s szolgáltatás elérését azokra a felhasználókra, akik megfelelnek a következő feltételeknek:",
    "The filter specifies which LDAP users shall have access to the %s instance." : "A szűrő meghatározza, hogy mely LDAP felhasználók lesznek jogosultak %s elérésére.",
    "Saving" : "Mentés",
    "Back" : "Vissza",
    "Continue" : "Folytatás",
    "Expert" : "Profi",
    "Advanced" : "Haladó",
    "<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." : "<b>Figyelem:</b> a user_ldap és user_webdavauth alkalmazások nem kompatibilisek. Együttes használatuk váratlan eredményekhez vezethet. Kérje meg a rendszergazdát, hogy a kettő közül kapcsolja ki az egyiket.",
    "<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." : "<b>Figyelmeztetés:</b> Az LDAP PHP modul nincs telepítve, ezért ez az alrendszer nem fog működni. Kérje meg a rendszergazdát, hogy telepítse!",
    "Connection Settings" : "Kapcsolati beállítások",
    "Configuration Active" : "A beállítás aktív",
    "When unchecked, this configuration will be skipped." : "Ha nincs kipipálva, ez a beállítás kihagyódik.",
    "Backup (Replica) Host" : "Másodkiszolgáló (replika)",
    "Give an optional backup host. It must be a replica of the main LDAP/AD server." : "Adjon meg egy opcionális másodkiszolgálót. Ez a fő LDAP/AD kiszolgáló szinkron másolata (replikája) kell legyen.",
    "Backup (Replica) Port" : "A másodkiszolgáló (replika) portszáma",
    "Disable Main Server" : "A fő szerver kihagyása",
    "Only connect to the replica server." : "Csak a másodlagos (másolati) kiszolgálóhoz kapcsolódjunk.",
    "Case insensitive LDAP server (Windows)" : "Az LDAP-kiszolgáló nem tesz különbséget a kis- és nagybetűk között (Windows)",
    "Turn off SSL certificate validation." : "Ne ellenőrizzük az SSL-tanúsítvány érvényességét",
    "Not recommended, use it for testing only! If connection only works with this option, import the LDAP server's SSL certificate in your %s server." : "Használata nem javasolt (kivéve tesztelési céllal). Ha a kapcsolat csak ezzel a beállítással működik, akkor importálja az LDAP-kiszolgáló SSL tanúsítványát a(z) %s kiszolgálóra!",
    "Cache Time-To-Live" : "A gyorsítótár tárolási időtartama",
    "in seconds. A change empties the cache." : "másodpercben. A változtatás törli a cache tartalmát.",
    "Directory Settings" : "Címtár beállítások",
    "User Display Name Field" : "A felhasználónév mezője",
    "The LDAP attribute to use to generate the user's display name." : "Ebből az LDAP attribútumból képződik a felhasználó megjelenítendő neve.",
    "Base User Tree" : "A felhasználói fa gyökere",
    "One User Base DN per line" : "Soronként egy felhasználói fa gyökerét adhatjuk meg",
    "User Search Attributes" : "A felhasználók lekérdezett attribútumai",
    "Optional; one attribute per line" : "Nem kötelező megadni, soronként egy attribútum",
    "Group Display Name Field" : "A csoport nevének mezője",
    "The LDAP attribute to use to generate the groups's display name." : "Ebből az LDAP attribútumból képződik a csoport megjelenítendő neve.",
    "Base Group Tree" : "A csoportfa gyökere",
    "One Group Base DN per line" : "Soronként egy csoportfa gyökerét adhatjuk meg",
    "Group Search Attributes" : "A csoportok lekérdezett attribútumai",
    "Group-Member association" : "A csoporttagság attribútuma",
    "Nested Groups" : "Egymásba ágyazott csoportok",
    "When switched on, groups that contain groups are supported. (Only works if the group member attribute contains DNs.)" : "Amikor be van kapcsolva, akkor azokat a csoportokat is kezelni tudjuk, melyekben a személyek mellett csoportok is vannak. (Csak akkor működik, ha a csoportok \"member\" attribútuma DN-eket tartalmaz.)",
    "Paging chunksize" : "Lapméret paging esetén",
    "Chunksize used for paged LDAP searches that may return bulky results like user or group enumeration. (Setting it 0 disables paged LDAP searches in those situations.)" : "A lapméret megadásával korlátozható az egy fordulóban kapott találatok száma, akkor is, ha az LDAP-keresés nagyon sok találatot ad, ha ezt az LDAP-kiszolgáló támogatja. (Ha 0-ra állítjuk, akkor ezáltal letiltjuk ezt a lapozó funkciót.)",
    "Special Attributes" : "Különleges attribútumok",
    "Quota Field" : "Kvóta mező",
    "Quota Default" : "Alapértelmezett kvóta",
    "in bytes" : "bájtban",
    "Email Field" : "E-mail mező",
    "User Home Folder Naming Rule" : "A home könyvtár elérési útvonala",
    "Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." : "Hagyja üresen, ha a felhasználónevet kívánja használni. Ellenkező esetben adjon meg egy LDAP/AD attribútumot!",
    "Internal Username" : "Belső felhasználónév",
    "By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder. It is also a part of remote URLs, for instance for all *DAV services. With this setting, the default behavior can be overridden. To achieve a similar behavior as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users." : "Alapértelmezetten a belső felhasználónév az UUID attribútumból jön létre. Ez biztosítja a felhasználónév egyediségét, ill. azt, hogy a karaktereket nem kell konvertálni benne. A belső felhasználónévben csak a következő karakterek engdélyezettek: [ a-zA-Z0-9_.@- ]. Minden más karakter vagy az ASCII kódtáblában levő megfelelőjére cserélődik ki, vagy ha ilyen nincs, akkor egyszerűen kihagyódik. Ha az így kapott nevek mégis ütköznének, akkor a végükön kiegészülnek egy növekvő sorszámmal. A  belső felhasználónév a programon belül azonosítja a felhasználót, valamint alapértelmezetten ez lesz a felhasználó személyes home könyvtárának a neve is. A belső felhasználónév adja a távoli elérések webcímének egy részét is, ilyenek pl. a *DAV szolgáltatások URL-jei. Ezzel a beállítással felülbírálhatjuk az alapértelmezett viselkedést. Ha az ownCloud 5-ös változata előtti viselkedést szeretné elérni, akkor a következő mezőben adja meg a felhasználó megjelenítési nevének attribútumát. Az alapértelmezett viselkedéshez hagyja üresen. A változtatás csak az újonnan létrejövő (újonnan megfeleltetett) LDAP felhasználók esetén érvényesül.",
    "Internal Username Attribute:" : "A belső felhasználónév attribútuma:",
    "Override UUID detection" : "Az UUID-felismerés felülbírálása",
    "By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." : "Az UUID attribútum alapértelmezetten felismerésre kerül. Az UUID attribútum segítségével az LDAP felhasználók és csoportok egyértelműen azonosíthatók. A belső felhasználónév is azonos lesz az UUID-vel, ha fentebb nincs másként definiálva. Ezt a beállítást felülbírálhatja és bármely attribútummal helyettesítheti. Ekkor azonban gondoskodnia kell arról, hogy a kiválasztott attribútum minden felhasználó és csoport esetén lekérdezhető és egyedi értékkel bír. Ha a mezőt üresen hagyja, akkor az alapértelmezett attribútum lesz érvényes. Egy esetleges módosítás csak az újonnan hozzárendelt (ill. létrehozott) felhasználókra és csoportokra lesz érvényes.",
    "UUID Attribute for Users:" : "A felhasználók UUID attribútuma:",
    "UUID Attribute for Groups:" : "A csoportok UUID attribútuma:",
    "Username-LDAP User Mapping" : "Felhasználó - LDAP felhasználó hozzárendelés",
    "Clear Username-LDAP User Mapping" : "A felhasználó - LDAP felhasználó hozzárendelés törlése",
    "Clear Groupname-LDAP Group Mapping" : "A csoport - LDAP csoport hozzárendelés törlése"
},
"nplurals=2; plural=(n != 1);");
