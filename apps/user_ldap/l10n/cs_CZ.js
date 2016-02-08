OC.L10N.register(
    "user_ldap",
    {
    "Failed to clear the mappings." : "Selhalo zrušení mapování.",
    "Failed to delete the server configuration" : "Selhalo smazání nastavení serveru",
    "The configuration is invalid: anonymous bind is not allowed." : "Tato konfigurace není platná: anonymní bind není povolen.",
    "The configuration is valid and the connection could be established!" : "Nastavení je v pořádku a spojení bylo navázáno.",
    "The configuration is valid, but the Bind failed. Please check the server settings and credentials." : "Konfigurace je v pořádku, ale spojení selhalo. Zkontrolujte, prosím, nastavení serveru a přihlašovací údaje.",
    "The configuration is invalid. Please have a look at the logs for further details." : "Konfigurace je neplatná. Pro bližší informace se podívejte do logu.",
    "No action specified" : "Neurčena žádná akce",
    "No configuration specified" : "Neurčena žádná konfigurace",
    "No data specified" : "Neurčena žádná data",
    " Could not set configuration %s" : "Nelze nastavit konfiguraci %s",
    "Action does not exist" : "Tato akce neexistuje",
    "The Base DN appears to be wrong" : "Base DN nevypadá být v pořádku",
    "Configuration incorrect" : "Nesprávná konfigurace",
    "Configuration incomplete" : "Nekompletní konfigurace",
    "Configuration OK" : "Konfigurace v pořádku",
    "Select groups" : "Vyberte skupiny",
    "Select object classes" : "Vyberte objektové třídy",
    "Please check the credentials, they seem to be wrong." : "Ověřte své přihlašovací údaje, zdají se být neplatné.",
    "Please specify the port, it could not be auto-detected." : "Uveďte prosím port, nelze ho automaticky detekovat.",
    "Base DN could not be auto-detected, please revise credentials, host and port." : "Base DN nelze automaticky detekovat, ověřte prosím přihlašovací údaje, host a port.",
    "Could not detect Base DN, please enter it manually." : "Nelze automaticky detekovat Base DN, zadejte prosím ručně.",
    "{nthServer}. Server" : "{nthServer}. Server",
    "No object found in the given Base DN. Please revise." : "V zadané Base DN nebyl objekt nalezen. Ověřte.",
    "More than 1,000 directory entries available." : "Je dostupných více než 1000 adresářů.",
    " entries available within the provided Base DN" : "záznamů dostupných v zadané Base DN",
    "An error occurred. Please check the Base DN, as well as connection settings and credentials." : "Došlo k chybě. Ověře prosím Base DN společně s nastavením připojení a přihlašovacími údaji.",
    "Do you really want to delete the current Server Configuration?" : "Opravdu si přejete smazat současné nastavení serveru?",
    "Confirm Deletion" : "Potvrdit smazání",
    "Mappings cleared successfully!" : "Mapování úspěšně vyčištěno!",
    "Error while clearing the mappings." : "Chyba při čištění mapování.",
    "Anonymous bind is not allowed. Please provide a User DN and Password." : "Anonymní bind není povolen. Zadejte prosím User DN a Heslo.",
    "LDAP Operations error. Anonymous bind might not be allowed." : "Chyba LDAP operace. Anonymní bind nejspíše není povolen.",
    "Saving failed. Please make sure the database is in Operation. Reload before continuing." : "Ukládání selhalo. Ujistěte se, že databáze funguje. Načtěte znovu, než budete pokračovat.",
    "Switching the mode will enable automatic LDAP queries. Depending on your LDAP size they may take a while. Do you still want to switch the mode?" : "Přepnutí módu povolí automatické LDAP dotazy. V závislosti na velikosti vašeho LDAP může vyhledávání chvíli trvat. Opravdu si přejete přepnout mód?",
    "Mode switch" : "Přepnutí módu",
    "Select attributes" : "Vyberte atributy",
    "User not found. Please check your login attributes and username. Effective filter (to copy-and-paste for command line validation): <br/>" : "Uživatel nenalezen. Zkontrolujte prosím své přihlašovací údaje a jméno. Použitý filtr (pro zkopírování a ověření v příkazovém řádku): <br/>",
    "User found and settings verified." : "Uživatel nalezen a nastavení ověřeno.",
    "Settings verified, but one user found. Only the first will be able to login. Consider a more narrow filter." : "Nastavení ověřena, nalezen jeden uživatel. Pouze první se bude moci přihlásit. Zvažte nasazení užšího filtru.",
    "An unspecified error occurred. Please check the settings and the log." : "Došlo k nespecifikované chybě. Zkontrolujte prosím nastavení a soubor logu.",
    "The search filter is invalid, probably due to syntax issues like uneven number of opened and closed brackets. Please revise." : "Filtr vyhledávání je neplatný, pravděpodobně z důvodu chybné syntax jako třeba neuzavřené závorky. Ověřte to.",
    "A connection error to LDAP / AD occurred, please check host, port and credentials." : "Došlo k chybě připojení k LDAP / AD, zkontrolujte prosím host, port a přihlašovací údaje.",
    "The %uid placeholder is missing. It will be replaced with the login name when querying LDAP / AD." : "Chybí zástupný znak %uid. Bude nahrazen přihlašovacím jménem při dotazování LDAP / AD.",
    "Please provide a login name to test against" : "Zadejte prosím přihlašovací jméno pro otestování",
    "The group box was disabled, because the LDAP / AD server does not support memberOf." : "Skupinové pole bylo vypnuto, protože LDAP / AD server nepodporuje memberOf.",
    "_%s group found_::_%s groups found_" : ["nalezena %s skupina","nalezeny %s skupiny","nalezeno %s skupin"],
    "_%s user found_::_%s users found_" : ["nalezen %s uživatel","nalezeni %s uživatelé","nalezeno %s uživatelů"],
    "Could not detect user display name attribute. Please specify it yourself in advanced ldap settings." : "Nelze detekovat atribut pro zobrazení jména uživatele. Upřesněte ho prosím sami v rozšířeném nastavení LDAP.",
    "Could not find the desired feature" : "Nelze nalézt požadovanou vlastnost",
    "Invalid Host" : "Neplatný hostitel",
    "Server" : "Server",
    "Users" : "Uživatelé",
    "Login Attributes" : "Přihlašovací atributy",
    "Groups" : "Skupiny",
    "Test Configuration" : "Vyzkoušet nastavení",
    "Help" : "Nápověda",
    "Groups meeting these criteria are available in %s:" : "Skupiny splňující tyto podmínky jsou k dispozici v %s:",
    "Only these object classes:" : "Pouze tyto třídy objektů:",
    "Only from these groups:" : "Pouze z těchto skupin:",
    "Search groups" : "Prohledat skupiny",
    "Available groups" : "Dostupné skupiny",
    "Selected groups" : "Vybrané skupiny",
    "Edit LDAP Query" : "Upravit LDAP požadavek",
    "LDAP Filter:" : "LDAP filtr:",
    "The filter specifies which LDAP groups shall have access to the %s instance." : "Filtr určuje, kteří uživatelé LDAP mají mít přístup k instanci %s.",
    "Verify settings and count groups" : "Ověřit nastavení a spočítat skupiny",
    "When logging in, %s will find the user based on the following attributes:" : "Při přihlašování, %s bude hledat uživatele na základě následujících atributů:",
    "LDAP / AD Username:" : "LDAP / AD uživatelské jméno:",
    "Allows login against the LDAP / AD username, which is either uid or samaccountname and will be detected." : "Umožňuje přihlášení s LDAP / AD uživatelským jménem, které má rozpoznatelnou hodnotu pro uid nebo samaccountname.",
    "LDAP / AD Email Address:" : "LDAP / AD emailová adresa:",
    "Allows login against an email attribute. Mail and mailPrimaryAddress will be allowed." : "Umožňuje přihlášení s atributem emailu. Jsou povoleny Mail a mailPrimaryAddress.",
    "Other Attributes:" : "Další atributy:",
    "Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action. Example: \"uid=%%uid\"" : "Určuje použitý filtr při pokusu o přihlášení. %%uid nahrazuje uživatelské jméno v činnosti přihlášení. Příklad: \"uid=%%uid\"",
    "Test Loginname" : "Testovací přihlašovací jméno",
    "Verify settings" : "Ověřit nastavení",
    "1. Server" : "1. Server",
    "%s. Server:" : "%s. Server:",
    "Add a new and blank configuration" : "Přidat novou a prázdnou konfiguraci",
    "Copy current configuration into new directory binding" : "Zkopírovat současnou konfiguraci do nového adresářového propojení",
    "Delete the current configuration" : "Smazat současnou konfiguraci",
    "Host" : "Počítač",
    "You can omit the protocol, except you require SSL. Then start with ldaps://" : "Můžete vynechat protokol, vyjma pokud požadujete SSL. Tehdy začněte s ldaps://",
    "Port" : "Port",
    "Detect Port" : "Detekovat port",
    "User DN" : "Uživatelské DN",
    "The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." : "DN klientského uživatele, ke kterému tvoříte vazbu, např. uid=agent,dc=example,dc=com. Pro anonymní přístup ponechte DN a heslo prázdné.",
    "Password" : "Heslo",
    "For anonymous access, leave DN and Password empty." : "Pro anonymní přístup ponechte údaje DN and heslo prázdné.",
    "One Base DN per line" : "Jedna základní DN na řádku",
    "You can specify Base DN for users and groups in the Advanced tab" : "V rozšířeném nastavení můžete určit základní DN pro uživatele a skupiny",
    "Detect Base DN" : "Detekovat Base DN",
    "Test Base DN" : "Otestovat Base DN",
    "Avoids automatic LDAP requests. Better for bigger setups, but requires some LDAP knowledge." : "Zabraňuje automatickým LDAP požadavkům. Výhodné pro objemná nastavení, ale vyžaduje znalosti o LDAP.",
    "Manually enter LDAP filters (recommended for large directories)" : "Ručně vložit LDAP filtry (doporučeno pro obsáhlé adresáře)",
    "Limit %s access to users meeting these criteria:" : "Omezit přístup %s uživatelům splňujícím tyto podmínky:",
    "The most common object classes for users are organizationalPerson, person, user, and inetOrgPerson. If you are not sure which object class to select, please consult your directory admin." : "Nejčastější třídy objektů pro uživatele jsou organizationalPerson, person, user a inetOrgPerson. Pokud si nejste jisti které třídy objektů zvolit, obraťte se na svého adresářového správce.",
    "The filter specifies which LDAP users shall have access to the %s instance." : "Filtr určuje, kteří uživatelé LDAP mají mít přístup k instanci %s.",
    "Verify settings and count users" : "Ověřit nastavení a spočítat uživatele",
    "Saving" : "Ukládá se",
    "Back" : "Zpět",
    "Continue" : "Pokračovat",
    "LDAP" : "LDAP",
    "Expert" : "Expertní",
    "Advanced" : "Pokročilé",
    "<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." : "<b>Varování:</b> Aplikace user_ldap a user_webdavauth jsou vzájemně nekompatibilní. Můžete zaznamenat neočekávané chování. Požádejte prosím svého správce systému o zakázání jedné z nich.",
    "<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." : "<b>Varování:</b> není nainstalován LDAP modul pro PHP, podpůrná vrstva nebude fungovat. Požádejte, prosím, správce systému, aby jej nainstaloval.",
    "Connection Settings" : "Nastavení spojení",
    "Configuration Active" : "Nastavení aktivní",
    "When unchecked, this configuration will be skipped." : "Pokud není zaškrtnuto, bude toto nastavení přeskočeno.",
    "Backup (Replica) Host" : "Záložní (kopie) hostitel",
    "Give an optional backup host. It must be a replica of the main LDAP/AD server." : "Zadejte volitelného záložního hostitele. Musí to být kopie hlavního serveru LDAP/AD.",
    "Backup (Replica) Port" : "Záložní (kopie) port",
    "Disable Main Server" : "Zakázat hlavní server",
    "Only connect to the replica server." : "Připojit jen k záložnímu serveru.",
    "Turn off SSL certificate validation." : "Vypnout ověřování SSL certifikátu.",
    "Not recommended, use it for testing only! If connection only works with this option, import the LDAP server's SSL certificate in your %s server." : "Nedoporučuje se, určeno pouze k testovacímu použití. Pokud spojení funguje jen s touto volbou, importujte SSL certifikát vašeho LDAP serveru na server %s.",
    "Cache Time-To-Live" : "TTL vyrovnávací paměti",
    "in seconds. A change empties the cache." : "v sekundách. Změna vyprázdní vyrovnávací paměť.",
    "Directory Settings" : "Nastavení adresáře",
    "User Display Name Field" : "Pole zobrazovaného jména uživatele",
    "The LDAP attribute to use to generate the user's display name." : "LDAP atribut použitý k vytvoření zobrazovaného jména uživatele.",
    "2nd User Display Name Field" : "Druhé pole zobrazovaného jména uživatele",
    "Base User Tree" : "Základní uživatelský strom",
    "One User Base DN per line" : "Jedna uživatelská základní DN na řádku",
    "User Search Attributes" : "Atributy vyhledávání uživatelů",
    "Optional; one attribute per line" : "Volitelné, jeden atribut na řádku",
    "Group Display Name Field" : "Pole zobrazovaného jména skupiny",
    "The LDAP attribute to use to generate the groups's display name." : "LDAP atribut použitý k vytvoření zobrazovaného jména skupiny.",
    "Base Group Tree" : "Základní skupinový strom",
    "One Group Base DN per line" : "Jedna skupinová základní DN na řádku",
    "Group Search Attributes" : "Atributy vyhledávání skupin",
    "Group-Member association" : "Asociace člena skupiny",
    "Nested Groups" : "Vnořené skupiny",
    "When switched on, groups that contain groups are supported. (Only works if the group member attribute contains DNs.)" : "Pokud zapnuto, je možno používat skupiny, které obsahují jiné skupiny. (Funguje pouze pokud atribut člena skupiny obsahuje DN.)",
    "Paging chunksize" : "Velikost bloku stránkování",
    "Chunksize used for paged LDAP searches that may return bulky results like user or group enumeration. (Setting it 0 disables paged LDAP searches in those situations.)" : "Velikost bloku použitá pro stránkování vyhledávání v LDAP, které může vracet objemné výsledky jako třeba výčet uživatelů či skupin. (Nastavení na 0 zakáže stránkovaná vyhledávání pro tyto situace.)",
    "Special Attributes" : "Speciální atributy",
    "Quota Field" : "Pole pro kvótu",
    "Quota Default" : "Výchozí kvóta",
    "in bytes" : "v bajtech",
    "Email Field" : "Pole emailu",
    "User Home Folder Naming Rule" : "Pravidlo pojmenování domovské složky uživatele",
    "Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." : "Ponechte prázdné pro uživatelské jméno (výchozí). Jinak uveďte LDAP/AD parametr.",
    "Internal Username" : "Interní uživatelské jméno",
    "By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder. It is also a part of remote URLs, for instance for all *DAV services. With this setting, the default behavior can be overridden. To achieve a similar behavior as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users." : "Ve výchozím nastavení bude uživatelské jméno vytvořeno z UUID atributu. To zajistí unikátnost uživatelského jména a není potřeba provádět konverzi znaků. Interní uživatelské jméno je omezeno na znaky: [ a-zA-Z0-9_.@- ]. Ostatní znaky jsou nahrazeny jejich ASCII ekvivalentem nebo jednoduše vynechány. V případě kolize uživatelských jmen bude přidáno/navýšeno číslo. Interní uživatelské jméno je používáno k interní identifikaci uživatele. Je také výchozím názvem uživatelského domovského adresáře. Je také součástí URL pro vzdálený přístup, například všech *DAV služeb. S tímto nastavením může být výchozí chování změněno. Pro dosažení podobného chování jako před ownCloudem 5 uveďte atribut zobrazovaného jména do pole níže. Ponechte prázdné pro výchozí chování. Změna bude mít vliv jen na nově namapované (přidané) uživatele z LDAP.",
    "Internal Username Attribute:" : "Atribut interního uživatelského jména:",
    "Override UUID detection" : "Nastavit ručně UUID atribut",
    "By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." : "Ve výchozím nastavení je UUID atribut nalezen automaticky. UUID atribut je používán pro nezpochybnitelnou identifikaci uživatelů a skupin z LDAP. Navíc je na základě UUID tvořeno také interní uživatelské jméno, pokud není nastaveno jinak. Můžete výchozí nastavení přepsat a použít atribut, který sami zvolíte. Musíte se ale ujistit, že atribut, který vyberete, bude uveden jak u uživatelů, tak i u skupin a je unikátní. Ponechte prázdné pro výchozí chování. Změna bude mít vliv jen na nově namapované (přidané) uživatele a skupiny z LDAP.",
    "UUID Attribute for Users:" : "UUID atribut pro uživatele:",
    "UUID Attribute for Groups:" : "UUID atribut pro skupiny:",
    "Username-LDAP User Mapping" : "Mapování uživatelských jmen z LDAPu",
    "Usernames are used to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have an internal username. This requires a mapping from username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found. The internal username is used all over. Clearing the mappings will have leftovers everywhere. Clearing the mappings is not configuration sensitive, it affects all LDAP configurations! Never clear the mappings in a production environment, only in a testing or experimental stage." : "Uživatelská jména jsou používána pro uchovávání a přiřazování (meta)dat. Pro správnou identifikaci a rozpoznání uživatelů bude mít každý LDAP uživatel interní uživatelské jméno. To vyžaduje mapování uživatelských jmen na uživatele LDAP. Vytvořené uživatelské jméno je mapováno na UUID uživatele v LDAP. DN informace je navíc udržována v paměti pro snížení interakce s LDAP, ale není používána pro identifikaci. Pokud se DN změní, bude to správně rozpoznáno. Interní uživatelské jméno se používá celé. Vyčištění mapování zanechá zbytky všude. Vyčištění navíc není specifické pro každou konfiguraci, bude mít vliv na všechny LDAP konfigurace! Nikdy nečistěte mapování v produkčním prostředí, ale pouze v testovací nebo experimentální fázi.",
    "Clear Username-LDAP User Mapping" : "Zrušit mapování uživatelských jmen LDAPu",
    "Clear Groupname-LDAP Group Mapping" : "Zrušit mapování názvů skupin LDAPu"
},
"nplurals=3; plural=(n==1) ? 0 : (n>=2 && n<=4) ? 1 : 2;");
