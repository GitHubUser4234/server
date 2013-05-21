<?php $TRANSLATIONS = array(
"Failed to delete the server configuration" => "Nem sikerült törölni a kiszolgáló konfigurációját",
"The configuration is valid and the connection could be established!" => "A konfiguráció érvényes, és a kapcsolat létrehozható!",
"The configuration is valid, but the Bind failed. Please check the server settings and credentials." => "A konfiguráció érvényes, de a kapcsolat nem hozható létre. Kérem ellenőrizze a kiszolgáló beállításait, és az elérési adatokat.",
"The configuration is invalid. Please look in the ownCloud log for further details." => "Érvénytelen konfiguráció. További információkért nézze meg az ownCloud naplófájlját.",
"Deletion failed" => "A törlés nem sikerült",
"Take over settings from recent server configuration?" => "Vegyük át a beállításokat az előző konfigurációból?",
"Keep settings?" => "Tartsuk meg a beállításokat?",
"Cannot add server configuration" => "Az új  kiszolgáló konfigurációja nem hozható létre",
"Error" => "Hiba",
"Connection test succeeded" => "A kapcsolatellenőrzés eredménye: sikerült",
"Connection test failed" => "A kapcsolatellenőrzés eredménye: nem sikerült",
"Do you really want to delete the current Server Configuration?" => "Tényleg törölni szeretné a kiszolgáló beállításait?",
"Confirm Deletion" => "A törlés megerősítése",
"<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behaviour. Please ask your system administrator to disable one of them." => "<b>Figyelem:</b> a user_ldap és user_webdavauth alkalmazások nem kompatibilisek. Együttes használatuk váratlan eredményekhez vezethet. Kérje meg a rendszergazdát, hogy a kettő közül kapcsolja ki az egyiket.",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>Figyelmeztetés:</b> Az LDAP PHP modul nincs telepítve, ezért ez az alrendszer nem fog működni. Kérje meg a rendszergazdát, hogy telepítse!",
"Server configuration" => "A kiszolgálók beállításai",
"Add Server Configuration" => "Új kiszolgáló beállításának hozzáadása",
"Host" => "Kiszolgáló",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "A protokoll előtag elhagyható, kivéve, ha SSL-t kíván használni. Ebben az esetben kezdje így:  ldaps://",
"Base DN" => "DN-gyökér",
"One Base DN per line" => "Soronként egy DN-gyökér",
"You can specify Base DN for users and groups in the Advanced tab" => "A Haladó fülre kattintva külön DN-gyökér állítható be a felhasználók és a csoportok számára",
"User DN" => "A kapcsolódó felhasználó DN-je",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "Annak a felhasználónak a DN-je, akinek a nevében bejelentkezve kapcsolódunk a kiszolgálóhoz, pl. uid=agent,dc=example,dc=com. Bejelentkezés nélküli eléréshez ne töltse ki a DN és Jelszó mezőket!",
"Password" => "Jelszó",
"For anonymous access, leave DN and Password empty." => "Bejelentkezés nélküli eléréshez ne töltse ki a DN és Jelszó mezőket!",
"User Login Filter" => "Szűrő a bejelentkezéshez",
"Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action." => "Ez a szűrő érvényes a bejelentkezés megkísérlésekor. Ekkor az %%uid változó helyére a bejelentkezési név kerül.",
"use %%uid placeholder, e.g. \"uid=%%uid\"" => "használja az %%uid változót, pl. \"uid=%%uid\"",
"User List Filter" => "A felhasználók szűrője",
"Defines the filter to apply, when retrieving users." => "Ez a szűrő érvényes a felhasználók listázásakor.",
"without any placeholder, e.g. \"objectClass=person\"." => "itt ne használjon változót, pl. \"objectClass=person\".",
"Group Filter" => "A csoportok szűrője",
"Defines the filter to apply, when retrieving groups." => "Ez a szűrő érvényes a csoportok listázásakor.",
"without any placeholder, e.g. \"objectClass=posixGroup\"." => "itt ne használjunk változót, pl. \"objectClass=posixGroup\".",
"Connection Settings" => "Kapcsolati beállítások",
"Configuration Active" => "A beállítás aktív",
"When unchecked, this configuration will be skipped." => "Ha nincs kipipálva, ez a beállítás kihagyódik.",
"Port" => "Port",
"Backup (Replica) Host" => "Másodkiszolgáló (replika)",
"Give an optional backup host. It must be a replica of the main LDAP/AD server." => "Adjon meg egy opcionális másodkiszolgálót. Ez a fő LDAP/AD kiszolgáló szinkron másolata (replikája) kell legyen.",
"Backup (Replica) Port" => "A másodkiszolgáló (replika) portszáma",
"Disable Main Server" => "A fő szerver kihagyása",
"When switched on, ownCloud will only connect to the replica server." => "Ha ezt bekapcsoljuk, akkor az ownCloud csak a másodszerverekhez kapcsolódik.",
"Use TLS" => "Használjunk TLS-t",
"Do not use it additionally for LDAPS connections, it will fail." => "LDAPS kapcsolatok esetén ne kapcsoljuk be, mert nem fog működni.",
"Case insensitve LDAP server (Windows)" => "Az LDAP-kiszolgáló nem tesz különbséget a kis- és nagybetűk között (Windows)",
"Turn off SSL certificate validation." => "Ne ellenőrizzük az SSL-tanúsítvány érvényességét",
"If connection only works with this option, import the LDAP server's SSL certificate in your ownCloud server." => "Ha a kapcsolat csak ezzel a beállítással működik, akkor importálja az LDAP-kiszolgáló SSL tanúsítványát az ownCloud kiszolgálóra!",
"Not recommended, use for testing only." => "Nem javasolt, csak tesztelésre érdemes használni.",
"Cache Time-To-Live" => "A gyorsítótár tárolási időtartama",
"in seconds. A change empties the cache." => "másodpercben. A változtatás törli a cache tartalmát.",
"Directory Settings" => "Címtár beállítások",
"User Display Name Field" => "A felhasználónév mezője",
"The LDAP attribute to use to generate the user`s ownCloud name." => "Ebből az LDAP attribútumból képződik a felhasználó elnevezése, ami megjelenik az ownCloudban.",
"Base User Tree" => "A felhasználói fa gyökere",
"One User Base DN per line" => "Soronként egy felhasználói fa gyökerét adhatjuk meg",
"User Search Attributes" => "A felhasználók lekérdezett attribútumai",
"Optional; one attribute per line" => "Nem kötelező megadni, soronként egy attribútum",
"Group Display Name Field" => "A csoport nevének mezője",
"The LDAP attribute to use to generate the groups`s ownCloud name." => "Ebből az LDAP attribútumból képződik a csoport elnevezése, ami megjelenik az ownCloudban.",
"Base Group Tree" => "A csoportfa gyökere",
"One Group Base DN per line" => "Soronként egy csoportfa gyökerét adhatjuk meg",
"Group Search Attributes" => "A csoportok lekérdezett attribútumai",
"Group-Member association" => "A csoporttagság attribútuma",
"Special Attributes" => "Különleges attribútumok",
"Quota Field" => "Kvóta mező",
"Quota Default" => "Alapértelmezett kvóta",
"in bytes" => "bájtban",
"Email Field" => "Email mező",
"User Home Folder Naming Rule" => "A home könyvtár elérési útvonala",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "Hagyja üresen, ha a felhasználónevet kívánja használni. Ellenkező esetben adjon meg egy LDAP/AD attribútumot!",
"Test Configuration" => "A beállítások tesztelése",
"Help" => "Súgó"
);
