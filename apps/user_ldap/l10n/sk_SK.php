<?php
$TRANSLATIONS = array(
"Failed to clear the mappings." => "Nepodarilo sa vymazať mapovania.",
"Failed to delete the server configuration" => "Zlyhalo zmazanie nastavenia servera.",
"The configuration is valid and the connection could be established!" => "Nastavenie je v poriadku a pripojenie je stabilné.",
"The configuration is valid, but the Bind failed. Please check the server settings and credentials." => "Nastavenie je v poriadku, ale pripojenie zlyhalo. Skontrolujte nastavenia servera a prihlasovacie údaje.",
"The configuration is invalid. Please have a look at the logs for further details." => "Konfigurácia je chybná. Prosím, pozrite sa do logov pre ďalšie podrobnosti.",
"No action specified" => "Nie je vybraná akcia",
"No configuration specified" => "Nie je určená konfigurácia",
"No data specified" => "Nie sú vybraté dáta",
" Could not set configuration %s" => "Nemôžem nastaviť konfiguráciu %s",
"Deletion failed" => "Odstránenie zlyhalo",
"Take over settings from recent server configuration?" => "Prebrať nastavenia z nedávneho nastavenia servera?",
"Keep settings?" => "Ponechať nastavenia?",
"{nthServer}. Server" => "{nthServer}. Server",
"Cannot add server configuration" => "Nemožno pridať nastavenie servera",
"mappings cleared" => "mapovanie vymazané",
"Success" => "Úspešné",
"Error" => "Chyba",
"Please specify a Base DN" => "Prosím, zadajte základnú DN",
"Could not determine Base DN" => "Nemožno určiť základnú DN",
"Please specify the port" => "Prosím, zadajte port",
"Configuration OK" => "Konfigurácia je v poriadku",
"Configuration incorrect" => "Nesprávna konfigurácia",
"Configuration incomplete" => "Nekompletná konfigurácia",
"Select groups" => "Vybrať skupinu",
"Select object classes" => "Vyberte triedy objektov",
"Select attributes" => "Vyberte atribúty",
"Connection test succeeded" => "Test pripojenia bol úspešný",
"Connection test failed" => "Test pripojenia zlyhal",
"Do you really want to delete the current Server Configuration?" => "Naozaj chcete zmazať súčasné nastavenie servera?",
"Confirm Deletion" => "Potvrdiť vymazanie",
"_%s group found_::_%s groups found_" => array("%s nájdená skupina","%s nájdené skupiny","%s nájdených skupín"),
"_%s user found_::_%s users found_" => array("%s nájdený používateľ","%s nájdení používatelia","%s nájdených používateľov"),
"Invalid Host" => "Neplatný hostiteľ",
"Could not find the desired feature" => "Nemožno nájsť požadovanú funkciu",
"Server" => "Server",
"User Filter" => "Filter používateľov",
"Login Filter" => "Filter prihlasovania",
"Group Filter" => "Filter skupiny",
"Save" => "Uložiť",
"Test Configuration" => "Test nastavenia",
"Help" => "Pomoc",
"Groups meeting these criteria are available in %s:" => "Skupiny spĺňajúce tieto kritériá sú k dispozícii v %s:",
"only those object classes:" => "len tieto triedy objektov:",
"only from those groups:" => "len z týchto skupín:",
"Edit raw filter instead" => "Miesto pre úpravu raw filtra",
"Raw LDAP filter" => "Raw LDAP filter",
"The filter specifies which LDAP groups shall have access to the %s instance." => "Tento filter LDAP určuje, ktoré skupiny budú mať prístup k %s inštancii.",
"groups found" => "nájdené skupiny",
"Users login with this attribute:" => "Používatelia sa budú prihlasovať pomocou tohto atribútu:",
"LDAP Username:" => "LDAP používateľské meno:",
"LDAP Email Address:" => "LDAP emailová adresa:",
"Other Attributes:" => "Iné atribúty:",
"Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action. Example: \"uid=%%uid\"" => "Určuje použitý filter, pri pokuse o prihlásenie. %%uid nahrádza používateľské meno v činnosti prihlásenia. Napríklad: \"uid=%%uid\"",
"1. Server" => "1. Server",
"%s. Server:" => "%s. Server:",
"Add Server Configuration" => "Pridať nastavenia servera.",
"Delete Configuration" => "Zmazať nastavenia",
"Host" => "Hostiteľ",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "Môžete vynechať protokol, okrem prípadu, kedy sa vyžaduje SSL. Vtedy začnite s ldaps://",
"Port" => "Port",
"User DN" => "Používateľské DN",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "DN klientského používateľa, ku ktorému tvoríte väzbu, napr. uid=agent,dc=example,dc=com. Pre anonymný prístup ponechajte údaje DN a Heslo prázdne.",
"Password" => "Heslo",
"For anonymous access, leave DN and Password empty." => "Pre anonymný prístup ponechajte údaje DN a Heslo prázdne.",
"One Base DN per line" => "Jedno základné DN na riadok",
"You can specify Base DN for users and groups in the Advanced tab" => "V rozšírenom nastavení môžete zadať základné DN pre používateľov a skupiny",
"Limit %s access to users meeting these criteria:" => "Obmedziť %s prístup na používateľov spĺňajúcich tieto kritériá:",
"The filter specifies which LDAP users shall have access to the %s instance." => "Tento filter LDAP určuje, ktorí používatelia majú prístup k %s inštancii.",
"users found" => "nájdení používatelia",
"Back" => "Späť",
"Continue" => "Pokračovať",
"Expert" => "Expert",
"Advanced" => "Rozšírené",
"<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." => "<b>Upozornenie:</b> Aplikácie user_ldap a user_webdavauth sú navzájom nekompatibilné. Môžete zaznamenať neočakávané správanie. Požiadajte prosím vášho systémového administrátora pre zakázanie jedného z nich.",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>Upozornenie:</b> nie je nainštalovaný LDAP modul pre PHP, backend vrstva nebude fungovať. Požiadajte administrátora systému, aby ho nainštaloval.",
"Connection Settings" => "Nastavenie pripojenia",
"Configuration Active" => "Nastavenia sú aktívne ",
"When unchecked, this configuration will be skipped." => "Ak nie je zaškrtnuté, nastavenie bude preskočené.",
"Backup (Replica) Host" => "Záložný server (kópia) hostiteľa",
"Give an optional backup host. It must be a replica of the main LDAP/AD server." => "Zadajte záložný LDAP/AD. Musí to byť kópia hlavného LDAP/AD servera.",
"Backup (Replica) Port" => "Záložný server (kópia) port",
"Disable Main Server" => "Zakázať hlavný server",
"Only connect to the replica server." => "Pripojiť sa len k záložnému serveru.",
"Case insensitive LDAP server (Windows)" => "LDAP server je citlivý na veľkosť písmen (Windows)",
"Turn off SSL certificate validation." => "Vypnúť overovanie SSL certifikátu.",
"Not recommended, use it for testing only! If connection only works with this option, import the LDAP server's SSL certificate in your %s server." => "Neodporúčané, použite iba pri testovaní! Pokiaľ spojenie funguje iba z daným nastavením, importujte SSL certifikát LDAP servera do vášho %s servera.",
"Cache Time-To-Live" => "Životnosť objektov vo vyrovnávacej pamäti",
"in seconds. A change empties the cache." => "v sekundách. Zmena vyprázdni vyrovnávaciu pamäť.",
"Directory Settings" => "Nastavenia priečinka",
"User Display Name Field" => "Pole pre zobrazované meno používateľa",
"The LDAP attribute to use to generate the user's display name." => "Atribút LDAP použitý na vygenerovanie zobrazovaného mena používateľa. ",
"Base User Tree" => "Základný používateľský strom",
"One User Base DN per line" => "Jedna používateľská základná DN na riadok",
"User Search Attributes" => "Atribúty vyhľadávania používateľov",
"Optional; one attribute per line" => "Voliteľné, jeden atribút na jeden riadok",
"Group Display Name Field" => "Pole pre zobrazenie mena skupiny",
"The LDAP attribute to use to generate the groups's display name." => "Atribút LDAP použitý na vygenerovanie zobrazovaného mena skupiny.",
"Base Group Tree" => "Základný skupinový strom",
"One Group Base DN per line" => "Jedna skupinová základná DN na riadok",
"Group Search Attributes" => "Atribúty vyhľadávania skupín",
"Group-Member association" => "Priradenie člena skupiny",
"Nested Groups" => "Vnorené skupiny",
"When switched on, groups that contain groups are supported. (Only works if the group member attribute contains DNs.)" => "Ak je zapnuté, tak je možné používať skupiny, ktoré obsahujú iné skupiny. (Funguje, len ak atribút člena skupiny obsahuje DN.)",
"Special Attributes" => "Špeciálne atribúty",
"Quota Field" => "Pole kvóty",
"Quota Default" => "Predvolená kvóta",
"in bytes" => "v bajtoch",
"Email Field" => "Pole emailu",
"User Home Folder Naming Rule" => "Pravidlo pre nastavenie názvu používateľského priečinka dát",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "Nechajte prázdne pre používateľské meno (predvolené). Inak uveďte atribút z LDAP/AD.",
"Internal Username" => "Interné používateľské meno",
"By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder. It is also a part of remote URLs, for instance for all *DAV services. With this setting, the default behavior can be overridden. To achieve a similar behavior as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users." => "V predvolenom nastavení bude interné používateľské meno vytvorené z UUID atribútu. Zabezpečí sa to, že používateľské meno bude jedinečné a znaky nemusia byť prevedené. Interné meno má obmedzenie, iba tieto znaky sú povolené: [a-zA-Z0-9_ @ -.]. Ostatné znaky sú nahradené ich ASCII alebo jednoducho vynechané. Pri kolíziách používateľských mien bude číslo pridané / odobrané. Interné používateľské meno sa používa na internú identifikáciu používateľa. Je tiež predvoleným názvom používateľského domovského priečinka v ownCloud. Je tiež súčasťou URL pre vzdialený prístup, napríklad pre všetky služby *DAV. S týmto nastavením sa dá prepísať predvolené správanie. Pre dosiahnutie podobného správania sa ako pred verziou ownCloud 5 zadajte atribút zobrazenia používateľského mena v tomto poli. Ponechajte prázdne pre predvolené správanie. Zmeny budú mať vplyv iba na novo namapovaných (pridaných) LDAP používateľov.",
"Internal Username Attribute:" => "Atribút interného používateľského mena:",
"Override UUID detection" => "Prepísať UUID detekciu",
"By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." => "V predvolenom nastavení je UUID atribút detekovaný automaticky. UUID atribút je použitý na jedinečnú identifikáciu používateľov a skupín z LDAP. Naviac je na základe UUID vytvorené tiež interné používateľské meno, ak nie je nastavené inak. Môžete predvolené nastavenie prepísať a použiť atribút ktorý si sami zvolíte. Musíte sa ale ubezpečiť, že atribút ktorý vyberiete bude uvedený pri používateľoch, aj pri skupinách a je jedinečný. Ponechajte prázdne pre predvolené správanie. Zmena bude mať vplyv len na novo namapovaných (pridaných) používateľov a skupiny z LDAP.",
"UUID Attribute for Users:" => "UUID atribút pre používateľov:",
"UUID Attribute for Groups:" => "UUID atribút pre skupiny:",
"Username-LDAP User Mapping" => "Mapovanie názvov LDAP používateľských mien",
"Usernames are used to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have a internal username. This requires a mapping from username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found. The internal username is used all over. Clearing the mappings will have leftovers everywhere. Clearing the mappings is not configuration sensitive, it affects all LDAP configurations! Never clear the mappings in a production environment, only in a testing or experimental stage." => "Používateľské mená sa používajú pre uchovávanie a priraďovanie (meta) dát. Pre správnu identifikáciu a rozpoznanie používateľov bude mať každý používateľ z LDAP interné používateľské meno. To je nevyhnutné pre namapovanie používateľských mien na používateľov v LDAP. Vytvorené používateľské meno je namapované na UUID používateľa v LDAP. Naviac je cachovaná DN pre obmedzenie interakcie s LDAP, ale nie je používaná pre identifikáciu. Ak sa DN zmení, bude to správne rozpoznané. Interné používateľské meno sa používa všade. Vyčistenie namapovaní vymaže zvyšky všade. Vyčistenie naviac nie je špecifické, bude mať vplyv na všetky LDAP konfigurácie! Nikdy nečistite namapovanie v produkčnom prostredí, len v testovacej alebo experimentálnej fáze.",
"Clear Username-LDAP User Mapping" => "Zrušiť mapovanie LDAP používateľských mien",
"Clear Groupname-LDAP Group Mapping" => "Zrušiť mapovanie názvov LDAP skupín"
);
$PLURAL_FORMS = "nplurals=3; plural=(n==1) ? 0 : (n>=2 && n<=4) ? 1 : 2;";
