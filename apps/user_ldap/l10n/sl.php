<?php
$TRANSLATIONS = array(
"Failed to clear the mappings." => "Čiščenje preslikav je spodletelo.",
"Failed to delete the server configuration" => "Brisanje nastavitev strežnika je spodletelo.",
"The configuration is valid and the connection could be established!" => "Nastavitev je veljavna, zato je povezavo mogoče vzpostaviti!",
"The configuration is valid, but the Bind failed. Please check the server settings and credentials." => "Nastavitev je veljavna, vendar pa je vez spodletela. Preveriti je treba nastavitve strežnika in ustreznost poveril.",
"The configuration is invalid. Please have a look at the logs for further details." => "Nastavitev ni veljavna. Več podrobnosti o napaki je zabeleženih v dnevniku.",
"No action specified" => "Ni določenega dejanja",
"No configuration specified" => "Ni določenih nastavitev",
"No data specified" => "Ni navedenih podatkov",
" Could not set configuration %s" => "Ni mogoče uveljaviti nastavitev %s",
"Deletion failed" => "Brisanje je spodletelo.",
"Take over settings from recent server configuration?" => "Ali naj bodo prevzete nedavne nastavitve strežnika?",
"Keep settings?" => "Ali naj se nastavitve ohranijo?",
"Cannot add server configuration" => "Ni mogoče dodati nastavitev strežnika",
"mappings cleared" => "preslikave so izbrisane",
"Success" => "Uspešno končano.",
"Error" => "Napaka",
"Configuration OK" => "Nastavitev je ustrezna",
"Configuration incorrect" => "Nastavitev ni ustrezna",
"Configuration incomplete" => "Nastavitev je nepopolna",
"Select groups" => "Izberi skupine",
"Select object classes" => "Izbor razredov predmeta",
"Select attributes" => "Izbor atributov",
"Connection test succeeded" => "Preizkus povezave je uspešno končan.",
"Connection test failed" => "Preizkus povezave je spodletel.",
"Do you really want to delete the current Server Configuration?" => "Ali res želite izbrisati trenutne nastavitve strežnika?",
"Confirm Deletion" => "Potrdi brisanje",
"_%s group found_::_%s groups found_" => array("%s najdena skupina","%s najdeni skupini","%s najdene skupine","%s najdenih skupin"),
"_%s user found_::_%s users found_" => array("%s najden uporabnik","%s najdena uporabnika","%s najdeni uporabniki","%s najdenih uporabnikov"),
"Invalid Host" => "Neveljaven gostitelj",
"Could not find the desired feature" => "Želene zmožnosti ni mogoče najti",
"Group Filter" => "Filter skupin",
"Save" => "Shrani",
"Test Configuration" => "Preizkusne nastavitve",
"Help" => "Pomoč",
"only those object classes:" => "le razredi predmeta:",
"only from those groups:" => "le iz skupin:",
"Edit raw filter instead" => "Uredi surov filter",
"Raw LDAP filter" => "Surovi filter LDAP",
"The filter specifies which LDAP groups shall have access to the %s instance." => "Filter določa, katere skupine LDAP bodo imele dostop do %s.",
"groups found" => "najdenih skupin",
"LDAP Username:" => "Uporabniško ime LDAP:",
"LDAP Email Address:" => "Elektronski naslov LDAP:",
"Other Attributes:" => "Drugi atributi:",
"Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action. Example: \"uid=%%uid\"" => "Določi filter, ki bo uveljavljen ob poskusu prijave. %%uid zamenja uporabniško ime pri prijavi, na primer: \"uid=%%uid\"",
"Add Server Configuration" => "Dodaj nastavitve strežnika",
"Host" => "Gostitelj",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "Protokol je lahko izpuščen, če ni posebej zahtevan SSL. V tem primeru se mora naslov začeti z ldaps://",
"Port" => "Vrata",
"User DN" => "Uporabnikovo enolično ime",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "Enolično ime uporabnikovega odjemalca, s katerim naj se opravi vezava, npr. uid=agent,dc=example,dc=com. Za brezimni dostop sta polji prikaznega imena in gesla prazni.",
"Password" => "Geslo",
"For anonymous access, leave DN and Password empty." => "Za brezimni dostop naj bosta polji imena in gesla prazni.",
"One Base DN per line" => "Eno osnovno enolično ime na vrstico",
"You can specify Base DN for users and groups in the Advanced tab" => "Osnovno enolično ime za uporabnike in skupine lahko določite v zavihku naprednih možnosti.",
"The filter specifies which LDAP users shall have access to the %s instance." => "Filter določa, kateri uporabniki LDAP bodo imeli dostop do %s.",
"users found" => "najdenih uporabnikov",
"Back" => "Nazaj",
"Continue" => "Nadaljuj",
"Advanced" => "Napredne možnosti",
"<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." => "<b>Opozorilo:</b> določili user_ldap in user_webdavauth sta  neskladni, kar lahko vpliva na delovanje sistema. O napaki pošljite poročilo skrbniku sistema in opozorite, da je treba eno izmed možnosti onemogočiti.",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>Opozorilo:</b> modul PHP LDAP mora biti nameščen, sicer vmesnik ne bo deloval. Paket je treba namestiti.",
"Connection Settings" => "Nastavitve povezave",
"Configuration Active" => "Dejavna nastavitev",
"When unchecked, this configuration will be skipped." => "Neizbrana možnost preskoči nastavitev.",
"Backup (Replica) Host" => "Varnostna kopija (replika) podatkov gostitelja",
"Give an optional backup host. It must be a replica of the main LDAP/AD server." => "Podati je treba izbirno varnostno kopijo gostitelja. Ta mora biti natančna replika strežnika LDAP/AD.",
"Backup (Replica) Port" => "Vrata varnostne kopije (replike)",
"Disable Main Server" => "Onemogoči glavni strežnik",
"Only connect to the replica server." => "Poveži le s podvojenim strežnikom.",
"Turn off SSL certificate validation." => "Onemogoči določanje veljavnosti potrdila SSL.",
"Not recommended, use it for testing only! If connection only works with this option, import the LDAP server's SSL certificate in your %s server." => "Možnosti ni priporočljivo uporabiti; namenjena je zgolj preizkušanju! Če deluje povezava le s to možnostjo, je treba uvoziti potrdilo SSL strežnika LDAP na strežnik %s.",
"Cache Time-To-Live" => "Predpomni podatke TTL",
"in seconds. A change empties the cache." => "v sekundah. Sprememba izprazni predpomnilnik.",
"Directory Settings" => "Nastavitve mape",
"User Display Name Field" => "Polje za uporabnikovo prikazano ime",
"The LDAP attribute to use to generate the user's display name." => "Atribut LDAP za uporabo pri ustvarjanju prikaznega imena uporabnika.",
"Base User Tree" => "Osnovno uporabniško drevo",
"One User Base DN per line" => "Eno osnovno uporabniško ime na vrstico",
"User Search Attributes" => "Uporabnikovi atributi iskanja",
"Optional; one attribute per line" => "Izbirno; en atribut na vrstico",
"Group Display Name Field" => "Polje za prikazano ime skupine",
"The LDAP attribute to use to generate the groups's display name." => "Atribut LDAP za uporabo pri ustvarjanju prikaznega imena skupine.",
"Base Group Tree" => "Osnovno drevo skupine",
"One Group Base DN per line" => "Eno osnovno ime skupine na vrstico",
"Group Search Attributes" => "Skupinski atributi iskanja",
"Group-Member association" => "Povezava član-skupina",
"Nested Groups" => "Gnezdene skupine",
"Special Attributes" => "Posebni atributi",
"Quota Field" => "Polje količinske omejitve",
"Quota Default" => "Privzeta količinska omejitev",
"in bytes" => "v bajtih",
"Email Field" => "Polje elektronske pošte",
"User Home Folder Naming Rule" => "Pravila poimenovanja uporabniške osebne mape",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "Pustite prazno za uporabniško ime (privzeto), sicer navedite atribut LDAP/AD.",
"Internal Username" => "Programsko uporabniško ime",
"By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder. It is also a part of remote URLs, for instance for all *DAV services. With this setting, the default behavior can be overridden. To achieve a similar behavior as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users." => "Privzeto je notranje uporabniško ime ustvarjeno na osnovi atributa UUID. To omogoča določitev uporabniškega imena kot enoličnega, zato znakov ni treba pretvarjati. Notranje ime je omejeno na standardne znake: [ a-zA-Z0-9_.@- ]. Morebitni drugi znaki so zamenjani z ustreznim ASCII znakom, ali pa so enostavno izpuščeni. V primeru sporov je prišteta ali odšteta številčna vrednost. Notranje uporabniško ime je uporabljeno za določanje uporabnika in je privzeto ime uporabnikove domače mape. Hkrati je tudi del oddaljenega naslova URL, na primer za storitve *DAV. S to nastavitvijo je prepisan privzet način delovanja. Pri različicah ownCloud, nižjih od 5.0, je podoben učinek mogoče doseči z vpisom prikaznega imena oziroma z neizpolnjenim (praznim) poljem te vrednosti. Spremembe bodo uveljavljene le za nove preslikane (dodane) uporabnike LDAP.",
"Internal Username Attribute:" => "Programski atribut uporabniškega imena:",
"Override UUID detection" => "Prezri zaznavo UUID",
"By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." => "Privzeto je atribut UUID samodejno zaznan. Uporabljen je za določevanje uporabnikov LDAP in skupin. Notranje uporabniško ime je določeno prav na atributu UUID, če ni določeno drugače. To nastavitev je mogoče prepisati in poslati poljuben atribut. Zagotoviti je treba le, da je ta pridobljen kot enolični podatek za uporabnika ali skupino. Prazno polje določa privzeti način. Spremembe bodo vplivale na novo preslikane (dodane) uporabnike LDAP in skupine.",
"UUID Attribute for Users:" => "Atribut UUID za uporabnike:",
"UUID Attribute for Groups:" => "Atribut UUID za skupine:",
"Username-LDAP User Mapping" => "Uporabniška preslikava uporabniškega imena na LDAP",
"Usernames are used to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have a internal username. This requires a mapping from username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found. The internal username is used all over. Clearing the mappings will have leftovers everywhere. Clearing the mappings is not configuration sensitive, it affects all LDAP configurations! Never clear the mappings in a production environment, only in a testing or experimental stage." => "Uporabniška imena so uporabljena za shranjevanje in dodeljevanje (meta) podatkov. Za natančno določanje in prepoznavanje uporabnikov je uporabljen sistem notranjega uporabniškega imena vsakega uporabnika LDAP. Ta možnost zahteva preslikavo uporabniškega imena v uporabnika LDAP in preslikano na njegov UUID. Sistem predpomni enolična imena za zmanjšanje odvisnosti LDAP, vendar pa ta podatek ni uporabljen za določevanje uporabnika. Če se enolično ime spremeni, se spremeni notranje uporabniško ime. Čiščenje preslikav pušča ostanke podatkov in vpliva na vse nastavitve LDAP! V delovnem okolju zato spreminjanje preslikav ni priporočljivo, možnost pa je na voljo za preizkušanje.",
"Clear Username-LDAP User Mapping" => "Izbriši preslikavo uporabniškega imena na LDAP",
"Clear Groupname-LDAP Group Mapping" => "Izbriši preslikavo skupine na LDAP"
);
$PLURAL_FORMS = "nplurals=4; plural=(n%100==1 ? 0 : n%100==2 ? 1 : n%100==3 || n%100==4 ? 2 : 3);";
