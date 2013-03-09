<?php $TRANSLATIONS = array(
"Failed to delete the server configuration" => "Brisanje nastavitev strežnika je spodletelo.",
"Deletion failed" => "Brisanje je spodletelo.",
"Keep settings?" => "Ali nas se nastavitve ohranijo?",
"Do you really want to delete the current Server Configuration?" => "Ali res želite izbrisati trenutne nastavitve strežnika?",
"Confirm Deletion" => "Potrdi brisanje",
"<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behaviour. Please ask your system administrator to disable one of them." => "<b>Opozorilo:</b> možnosti user_ldap in user_webdavauth nista združljivi. Pri uporabi je mogoče nepričakovano obnašanje sistema. Eno izmed možnosti je priporočeno onemgočiti.",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>Opozorilo:</b> modul PHP LDAP mora biti nameščen, sicer vmesnik ne bo deloval. Paket je treba namestiti.",
"Add Server Configuration" => "Dodaj nastavitve strežnika",
"Host" => "Gostitelj",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "Protokol je lahko izpuščen, če ni posebej zahtevan SSL. V tem primeru se mora naslov začeti z ldaps://",
"Base DN" => "Osnovni DN",
"You can specify Base DN for users and groups in the Advanced tab" => "Osnovni DN za uporabnike in skupine lahko določite v zavihku naprednih možnosti.",
"User DN" => "Uporabnik DN",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "DN uporabnikovega odjemalca, s katerim naj se opravi vezava, npr. uid=agent,dc=example,dc=com. Za brezimni dostop sta polji DN in geslo prazni.",
"Password" => "Geslo",
"For anonymous access, leave DN and Password empty." => "Za brezimni dostop sta polji DN in geslo prazni.",
"User Login Filter" => "Filter prijav uporabnikov",
"Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action." => "Določi filter, uporabljen pri prijavi. %%uid nadomesti uporabniško ime v postopku prijave.",
"use %%uid placeholder, e.g. \"uid=%%uid\"" => "Uporabite vsebnik %%uid, npr. \"uid=%%uid\".",
"User List Filter" => "Filter seznama uporabnikov",
"Defines the filter to apply, when retrieving users." => "Določi filter za uporabo med pridobivanjem uporabnikov.",
"without any placeholder, e.g. \"objectClass=person\"." => "Brez kateregakoli vsebnika, npr. \"objectClass=person\".",
"Group Filter" => "Filter skupin",
"Defines the filter to apply, when retrieving groups." => "Določi filter za uporabo med pridobivanjem skupin.",
"without any placeholder, e.g. \"objectClass=posixGroup\"." => "Brez katerekoli vsebnika, npr. \"objectClass=posixGroup\".",
"Connection Settings" => "Nastavitve povezave",
"Port" => "Vrata",
"Disable Main Server" => "Onemogoči glavni strežnik",
"Use TLS" => "Uporabi TLS",
"Case insensitve LDAP server (Windows)" => "Strežnik LDAP ne upošteva velikosti črk (Windows)",
"Turn off SSL certificate validation." => "Onemogoči določanje veljavnosti potrdila SSL.",
"If connection only works with this option, import the LDAP server's SSL certificate in your ownCloud server." => "Kadar deluje povezava le s to možnostjo, uvozite potrdilo SSL iz strežnika LDAP na vaš strežnik ownCloud.",
"Not recommended, use for testing only." => "Dejanje ni priporočeno; uporabljeno naj bo le za preizkušanje delovanja.",
"in seconds. A change empties the cache." => "v sekundah. Sprememba izprazni predpomnilnik.",
"Directory Settings" => "Nastavitve mape",
"User Display Name Field" => "Polje za uporabnikovo prikazano ime",
"The LDAP attribute to use to generate the user`s ownCloud name." => "Atribut LDAP, uporabljen pri ustvarjanju uporabniških imen ownCloud.",
"Base User Tree" => "Osnovno uporabniško drevo",
"One User Base DN per line" => "Eno osnovno uporabniško ime DN na vrstico",
"Group Display Name Field" => "Polje za prikazano ime skupine",
"The LDAP attribute to use to generate the groups`s ownCloud name." => "Atribut LDAP, uporabljen pri ustvarjanju imen skupin ownCloud.",
"Base Group Tree" => "Osnovno drevo skupine",
"One Group Base DN per line" => "Eno osnovno ime skupine DN na vrstico",
"Group Search Attributes" => "Atributi iskanja skupine",
"Group-Member association" => "Povezava član-skupina",
"Special Attributes" => "Posebni atributi",
"Quota Field" => "Polje količinske omejitve",
"Quota Default" => "Privzeta količinska omejitev",
"in bytes" => "v bajtih",
"Email Field" => "Polje elektronske pošte",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "Pustite prazno za uporabniško ime (privzeto), sicer navedite atribut LDAP/AD.",
"Test Configuration" => "Preizkusne nastavitve",
"Help" => "Pomoč"
);
