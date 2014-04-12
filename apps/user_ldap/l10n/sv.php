<?php
$TRANSLATIONS = array(
"Failed to clear the mappings." => "Fel vid rensning av mappningar",
"Failed to delete the server configuration" => "Misslyckades med att radera serverinställningen",
"The configuration is valid and the connection could be established!" => "Inställningen är giltig och anslutningen kunde upprättas!",
"The configuration is valid, but the Bind failed. Please check the server settings and credentials." => "Konfigurationen är riktig, men Bind felade. Var vänlig och kontrollera serverinställningar och logininformation.",
"The configuration is invalid. Please have a look at the logs for further details." => "Inställningen är ogiltig. Vänligen se ownCloud-loggen för fler detaljer.",
"No action specified" => "Ingen åtgärd har angetts",
"No configuration specified" => "Ingen konfiguration har angetts",
"No data specified" => "Ingen data har angetts",
" Could not set configuration %s" => "Kunde inte sätta inställning %s",
"Deletion failed" => "Raderingen misslyckades",
"Take over settings from recent server configuration?" => "Ta över inställningar från tidigare serverkonfiguration?",
"Keep settings?" => "Behåll inställningarna?",
"Cannot add server configuration" => "Kunde inte lägga till serverinställning",
"mappings cleared" => "mappningar rensade",
"Success" => "Lyckat",
"Error" => "Fel",
"Configuration OK" => "Konfigurationen är OK",
"Configuration incorrect" => "Felaktig konfiguration",
"Configuration incomplete" => "Konfigurationen är ej komplett",
"Select groups" => "Välj grupper",
"Select object classes" => "Välj Objekt-klasser",
"Select attributes" => "Välj attribut",
"Connection test succeeded" => "Anslutningstestet lyckades",
"Connection test failed" => "Anslutningstestet misslyckades",
"Do you really want to delete the current Server Configuration?" => "Vill du verkligen radera den nuvarande serverinställningen?",
"Confirm Deletion" => "Bekräfta radering",
"_%s group found_::_%s groups found_" => array("%s grupp hittad","%s grupper hittade"),
"_%s user found_::_%s users found_" => array("%s användare hittad","%s användare hittade"),
"Invalid Host" => "Felaktig Host",
"Could not find the desired feature" => "Det gick inte hitta den önskade funktionen",
"Save" => "Spara",
"Test Configuration" => "Testa konfigurationen",
"Help" => "Hjälp",
"Groups meeting these criteria are available in %s:" => "Grupper som uppfyller dessa kriterier finns i %s:",
"only those object classes:" => "Endast de objekt-klasserna:",
"only from those groups:" => "endast ifrån de här grupperna:",
"Edit raw filter instead" => "Redigera rått filter istället",
"Raw LDAP filter" => "Rått LDAP-filter",
"The filter specifies which LDAP groups shall have access to the %s instance." => "Filtret specifierar vilka LDAD-grupper som ska ha åtkomst till %s instans",
"groups found" => "grupper hittade",
"Users login with this attribute:" => "Användare loggar in med detta attribut:",
"LDAP Username:" => "LDAP användarnamn:",
"LDAP Email Address:" => "LDAP e-postadress:",
"Other Attributes:" => "Övriga attribut:",
"Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action. Example: \"uid=%%uid\"" => "Definierar filter som tillämpas vid inloggning. %%uid ersätter användarnamn vid inloggningen. Exempel: \"uid=%%uid\"",
"Add Server Configuration" => "Lägg till serverinställning",
"Host" => "Server",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "Du behöver inte ange protokoll förutom om du använder SSL. Starta då med ldaps://",
"Port" => "Port",
"User DN" => "Användare DN",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "DN för användaren som skall användas, t.ex. uid=agent, dc=example, dc=com. För anonym åtkomst, lämna DN och lösenord tomt.",
"Password" => "Lösenord",
"For anonymous access, leave DN and Password empty." => "För anonym åtkomst, lämna DN och lösenord tomt.",
"One Base DN per line" => "Ett Start DN per rad",
"You can specify Base DN for users and groups in the Advanced tab" => "Du kan ange start DN för användare och grupper under fliken Avancerat",
"Limit %s access to users meeting these criteria:" => "Begränsa %s tillgång till användare som uppfyller dessa kriterier:",
"The filter specifies which LDAP users shall have access to the %s instance." => "Filtret specifierar vilka LDAP-användare som skall ha åtkomst till %s instans",
"users found" => "användare funna",
"Back" => "Tillbaka",
"Continue" => "Fortsätt",
"<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." => "<b>Varning:</b> Apps user_ldap och user_webdavauth är inkompatibla. Oväntade problem kan uppstå. Be din systemadministratör att inaktivera en av dom.",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>Varning:</b> PHP LDAP - modulen är inte installerad, serversidan kommer inte att fungera. Kontakta din systemadministratör för installation.",
"Connection Settings" => "Uppkopplingsinställningar",
"Configuration Active" => "Konfiguration aktiv",
"When unchecked, this configuration will be skipped." => "Ifall denna är avbockad så kommer konfigurationen att skippas.",
"Backup (Replica) Host" => "Säkerhetskopierings-värd (Replika)",
"Give an optional backup host. It must be a replica of the main LDAP/AD server." => "Ange en valfri värd för säkerhetskopiering. Den måste vara en replika av den huvudsakliga LDAP/AD-servern",
"Backup (Replica) Port" => "Säkerhetskopierins-port (Replika)",
"Disable Main Server" => "Inaktivera huvudserver",
"Only connect to the replica server." => "Anslut endast till replikaservern.",
"Turn off SSL certificate validation." => "Stäng av verifiering av SSL-certifikat.",
"Not recommended, use it for testing only! If connection only works with this option, import the LDAP server's SSL certificate in your %s server." => "Rekommenderas inte, använd endast för test! Om anslutningen bara fungerar med denna inställning behöver du importera LDAP-serverns SSL-certifikat till din %s server.",
"Cache Time-To-Live" => "Cache Time-To-Live",
"in seconds. A change empties the cache." => "i sekunder. En förändring tömmer cache.",
"Directory Settings" => "Mappinställningar",
"User Display Name Field" => "Attribut för användarnamn",
"The LDAP attribute to use to generate the user's display name." => "LDAP-attributet som ska användas för att generera användarens visningsnamn.",
"Base User Tree" => "Bas för användare i katalogtjänst",
"One User Base DN per line" => "En Användare start DN per rad",
"User Search Attributes" => "Användarsökningsattribut",
"Optional; one attribute per line" => "Valfritt; ett attribut per rad",
"Group Display Name Field" => "Attribut för gruppnamn",
"The LDAP attribute to use to generate the groups's display name." => "LDAP-attributet som ska användas för att generera gruppens visningsnamn.",
"Base Group Tree" => "Bas för grupper i katalogtjänst",
"One Group Base DN per line" => "En Grupp start DN per rad",
"Group Search Attributes" => "Gruppsökningsattribut",
"Group-Member association" => "Attribut för gruppmedlemmar",
"Nested Groups" => "Undergrupper",
"When switched on, groups that contain groups are supported. (Only works if the group member attribute contains DNs.)" => "När den är påslagen, stöds grupper som innehåller grupper. (Fungerar endast om gruppmedlemmens attribut innehåller DNs.)",
"Paging chunksize" => "Paging klusterstorlek",
"Chunksize used for paged LDAP searches that may return bulky results like user or group enumeration. (Setting it 0 disables paged LDAP searches in those situations.)" => "Klusterstorlek som används för paged LDAP sökningar som kan komma att returnera skrymmande resultat som uppräknande av användare eller grupper. (Inställning av denna till 0 inaktiverar paged LDAP sökningar i de situationerna)",
"Special Attributes" => "Specialattribut",
"Quota Field" => "Kvotfält",
"Quota Default" => "Datakvot standard",
"in bytes" => "i bytes",
"Email Field" => "E-postfält",
"User Home Folder Naming Rule" => "Namnregel för hemkatalog",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "Lämnas tomt för användarnamn (standard). Ange annars ett LDAP/AD-attribut.",
"Internal Username" => "Internt Användarnamn",
"By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder. It is also a part of remote URLs, for instance for all *DAV services. With this setting, the default behavior can be overridden. To achieve a similar behavior as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users." => "Som standard skapas det interna användarnamnet från UUID-attributet. Det säkerställer att användarnamnet är unikt och tecken inte behöver konverteras. Det interna användarnamnet har restriktionerna att endast följande tecken är tillåtna:  [ a-zA-Z0-9_.@- ]. Andra tecken blir ersatta av deras motsvarighet i ASCII eller utelämnas helt. En siffra kommer att läggas till eller ökas på vid en kollision. Det interna användarnamnet används för att identifiera användaren internt. Det är även förvalt som användarens användarnamn i ownCloud. Det är även en port för fjärråtkomst, t.ex. för alla *DAV-tjänster. Med denna inställning kan det förvalda beteendet åsidosättas. För att uppnå ett liknande beteende som innan ownCloud 5, ange attributet för användarens visningsnamn i detta fält. Lämna det tomt för förvalt beteende. Ändringarna kommer endast att påverka nyligen mappade (tillagda) LDAP-användare",
"Internal Username Attribute:" => "Internt Användarnamn Attribut:",
"Override UUID detection" => "Åsidosätt UUID detektion",
"By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." => "Som standard upptäcker ownCloud automatiskt UUID-attributet. Det UUID-attributet används för att utan tvivel identifiera LDAP-användare och grupper. Dessutom kommer interna användarnamn skapas baserat på detta UUID, om inte annat anges ovan. Du kan åsidosätta inställningen och passera ett attribut som du själv väljer. Du måste se till att attributet som du väljer kan hämtas för både användare och grupper och att det är unikt. Lämna det tomt för standard beteende. Förändringar kommer endast att påverka nyligen mappade (tillagda) LDAP-användare och grupper.",
"UUID Attribute for Users:" => "UUID Attribut för Användare:",
"UUID Attribute for Groups:" => "UUID Attribut för Grupper:",
"Username-LDAP User Mapping" => "Användarnamn-LDAP User Mapping",
"Usernames are used to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have a internal username. This requires a mapping from username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found. The internal username is used all over. Clearing the mappings will have leftovers everywhere. Clearing the mappings is not configuration sensitive, it affects all LDAP configurations! Never clear the mappings in a production environment, only in a testing or experimental stage." => "ownCloud använder sig av användarnamn för att lagra och tilldela (meta) data. För att exakt kunna identifiera och känna igen användare, kommer varje LDAP-användare ha ett internt användarnamn. Detta kräver en mappning från ownCloud-användarnamn till LDAP-användare. Det skapade användarnamnet mappas till UUID för LDAP-användaren. Dessutom cachas DN  samt minska LDAP-interaktionen, men den används inte för identifiering. Om DN förändras, kommer förändringarna hittas av ownCloud. Det interna ownCloud-namnet används överallt i ownCloud. Om du rensar/raderar mappningarna kommer att lämna referenser överallt i systemet. Men den är inte konfigurationskänslig, den påverkar alla LDAP-konfigurationer! Rensa/radera aldrig mappningarna i en produktionsmiljö. Utan gör detta endast på i testmiljö!",
"Clear Username-LDAP User Mapping" => "Rensa Användarnamn-LDAP User Mapping",
"Clear Groupname-LDAP Group Mapping" => "Rensa Gruppnamn-LDAP Group Mapping"
);
$PLURAL_FORMS = "nplurals=2; plural=(n != 1);";
