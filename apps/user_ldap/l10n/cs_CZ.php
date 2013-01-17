<?php $TRANSLATIONS = array(
"<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behaviour. Please ask your system administrator to disable one of them." => "<b>Varování:</b> Aplikace user_ldap a user_webdavauth nejsou kompatibilní. Může nastávat neočekávané chování. Požádejte, prosím, správce systému aby jednu z nich zakázal.",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>Varování:</b> není nainstalován LDAP modul pro PHP, podpůrná vrstva nebude fungovat. Požádejte, prosím, správce systému aby jej nainstaloval.",
"Host" => "Počítač",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "Můžete vynechat protokol, vyjma pokud požadujete SSL. Tehdy začněte s ldaps://",
"Base DN" => "Základní DN",
"One Base DN per line" => "Jedna základní DN na řádku",
"You can specify Base DN for users and groups in the Advanced tab" => "V rozšířeném nastavení můžete určit základní DN pro uživatele a skupiny",
"User DN" => "Uživatelské DN",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "DN klentského uživatele ke kterému tvoříte vazbu, např. uid=agent,dc=example,dc=com. Pro anonymní přístup ponechte údaje DN and Heslo prázdné.",
"Password" => "Heslo",
"For anonymous access, leave DN and Password empty." => "Pro anonymní přístup, ponechte údaje DN and heslo prázdné.",
"User Login Filter" => "Filtr přihlášení uživatelů",
"Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action." => "Určuje použitý filtr, při pokusu o přihlášení. %%uid nahrazuje uživatelské jméno v činnosti přihlášení.",
"use %%uid placeholder, e.g. \"uid=%%uid\"" => "použijte zástupný vzor %%uid, např. \"uid=%%uid\"",
"User List Filter" => "Filtr uživatelských seznamů",
"Defines the filter to apply, when retrieving users." => "Určuje použitý filtr, pro získávaní uživatelů.",
"without any placeholder, e.g. \"objectClass=person\"." => "bez zástupných znaků, např. \"objectClass=person\".",
"Group Filter" => "Filtr skupin",
"Defines the filter to apply, when retrieving groups." => "Určuje použitý filtr, pro získávaní skupin.",
"without any placeholder, e.g. \"objectClass=posixGroup\"." => "bez zástupných znaků, např. \"objectClass=posixGroup\".",
"Port" => "Port",
"Base User Tree" => "Základní uživatelský strom",
"One User Base DN per line" => "Jedna uživatelská základní DN na řádku",
"Base Group Tree" => "Základní skupinový strom",
"One Group Base DN per line" => "Jedna skupinová základní DN na řádku",
"Group-Member association" => "Asociace člena skupiny",
"Use TLS" => "Použít TLS",
"Do not use it for SSL connections, it will fail." => "Nepoužívejte pro připojení pomocí SSL, připojení selže.",
"Case insensitve LDAP server (Windows)" => "LDAP server nerozlišující velikost znaků (Windows)",
"Turn off SSL certificate validation." => "Vypnout ověřování SSL certifikátu.",
"If connection only works with this option, import the LDAP server's SSL certificate in your ownCloud server." => "Pokud připojení pracuje pouze s touto možností, tak importujte SSL certifikát SSL serveru do Vašeho serveru ownCloud",
"Not recommended, use for testing only." => "Není doporučeno, pouze pro testovací účely.",
"User Display Name Field" => "Pole pro zobrazované jméno uživatele",
"The LDAP attribute to use to generate the user`s ownCloud name." => "Atribut LDAP použitý k vytvoření jména uživatele ownCloud",
"Group Display Name Field" => "Pole pro zobrazení jména skupiny",
"The LDAP attribute to use to generate the groups`s ownCloud name." => "Atribut LDAP použitý k vytvoření jména skupiny ownCloud",
"in bytes" => "v bajtech",
"in seconds. A change empties the cache." => "ve vteřinách. Změna vyprázdní vyrovnávací paměť.",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "Ponechte prázdné pro uživatelské jméno (výchozí). Jinak uveďte LDAP/AD parametr.",
"Help" => "Nápověda"
);
