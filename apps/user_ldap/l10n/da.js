OC.L10N.register(
    "user_ldap",
    {
    "Failed to clear the mappings." : "Mislykkedes med at rydde delingerne.",
    "Failed to delete the server configuration" : "Kunne ikke slette server konfigurationen",
    "The configuration is valid and the connection could be established!" : "Konfigurationen er korrekt og forbindelsen kunne etableres!",
    "The configuration is valid, but the Bind failed. Please check the server settings and credentials." : "Konfigurationen er gyldig, men forbindelsen mislykkedes. Tjek venligst serverindstillingerne og akkreditiverne.",
    "The configuration is invalid. Please have a look at the logs for further details." : "Konfigurationen er ugyldig. Se venligst i loggen for yderligere detaljer.",
    "No action specified" : "Der er ikke angivet en handling",
    "No configuration specified" : "Der er ikke angivet en konfiguration",
    "No data specified" : "Der er ikke angivet data",
    " Could not set configuration %s" : "Kunne ikke indstille konfigurationen %s",
    "Action does not exist" : "Handlingen findes ikke",
    "Configuration incorrect" : "Konfigurationen er ikke korrekt",
    "Configuration incomplete" : "Konfigurationen er ikke komplet",
    "Configuration OK" : "Konfigurationen er OK",
    "Select groups" : "Vælg grupper",
    "Select object classes" : "Vælg objektklasser",
    "Please check the credentials, they seem to be wrong." : "Tjek venligst brugeroplysningerne - de ser ud til at være forkerte.",
    "Please specify the port, it could not be auto-detected." : "Angiv venligst porten - den kunne ikke registreres automatisk.",
    "Base DN could not be auto-detected, please revise credentials, host and port." : "Base DN kunne ikke registreres automatisk - gennemse venligst brugeroplysningerne, vært og port.",
    "Could not detect Base DN, please enter it manually." : "Kunne ikke registrere Base DN - angiv den venligst manuelt.",
    "{nthServer}. Server" : "{nthServer}. server",
    "No object found in the given Base DN. Please revise." : "Intet objekt fundet i den givne Base DN. Gennemse venligst.",
    " entries available within the provided Base DN" : "poster tilgængelige inden for det angivne Base DN.",
    "An error occurred. Please check the Base DN, as well as connection settings and credentials." : "Der opstod en fejl. Tjek venligst Base DN, såvel som forbindelsesindstillingerne og brugeroplysningerne.",
    "Do you really want to delete the current Server Configuration?" : "Ønsker du virkelig at slette den nuværende Server Konfiguration?",
    "Confirm Deletion" : "Bekræft sletning",
    "Mappings cleared successfully!" : "Kortlægningerne blev ryddet af vejen!",
    "Error while clearing the mappings." : "Fejl under rydning af kortlægninger.",
    "Saving failed. Please make sure the database is in Operation. Reload before continuing." : "Lagringen mislykkedes. Sørg venligst for at databasen er i drift. Genindlæs for der fortsættes.",
    "Switching the mode will enable automatic LDAP queries. Depending on your LDAP size they may take a while. Do you still want to switch the mode?" : "Skift af tilstanden vil betyde aktivering af automatiske LDAP-forespørgsler. Afhængig af størrelsen på din LDAP, vil det kunne tage noget tid. Ønsker du stadig at ændre tilstanden?",
    "Mode switch" : "Skift af tilstand",
    "Select attributes" : "Vælg attributter",
    "User not found. Please check your login attributes and username. Effective filter (to copy-and-paste for command line validation): <br/>" : "Bruger blev ikke fundet. Tjek venligst dine login-attributter og brugernavnet. Gældende filter (til kopiér-og-indsæt for validering via kommandolinje): <br/>",
    "User found and settings verified." : "Bruger blev fundetog indstillingerne bekræftet.",
    "Settings verified, but one user found. Only the first will be able to login. Consider a more narrow filter." : "Indstillingerne blev verificieret, men én bruger blev fundet. Det er blot den første, der vil kunne logge ind. Overvej et mere begrænset filter.",
    "An unspecified error occurred. Please check the settings and the log." : "Der opstod en uspecificeret fejl. Tjek venligst indstillingerne og loggen.",
    "The search filter is invalid, probably due to syntax issues like uneven number of opened and closed brackets. Please revise." : "Søgefilteret er ugyldigt - sandsynligvis på grund af problemer med syntaksen, såsom et ulige antal åbne og lukkede parenteser. Gennemse venligst. ",
    "A connection error to LDAP / AD occurred, please check host, port and credentials." : "Der opstod en forbindelsesfejl til LDAP/AD - tjek venligst vært, port og brugeroplysninger.",
    "The %uid placeholder is missing. It will be replaced with the login name when querying LDAP / AD." : "Pladsholderen for %uid mangler. Den vil blive erstattes med loginnavnet, når LDAP/AD forespørges.",
    "Please provide a login name to test against" : "Angiv venligst et loginnavn for at teste mod",
    "The group box was disabled, because the LDAP / AD server does not support memberOf." : "Gruppeboksen var slået fra, fordi LDAP/AD-serveren ikke understøtter memberOf.",
    "_%s group found_::_%s groups found_" : ["Der blev fundet %s gruppe","Der blev fundet %s grupper"],
    "_%s user found_::_%s users found_" : ["Der blev fundet %s bruger","Der blev fundet %s brugere"],
    "Could not detect user display name attribute. Please specify it yourself in advanced ldap settings." : "Kunne ikke registrere navneattributten for visning af bruger. Angiv den venligst selv i de avancerede ldap-indstillinger.",
    "Could not find the desired feature" : "Fandt ikke den ønskede funktion",
    "Invalid Host" : "Ugyldig vært",
    "Server" : "Server",
    "Users" : "Brugere",
    "Login Attributes" : "Login-attributter",
    "Groups" : "Grupper",
    "Test Configuration" : "Test konfigurationen",
    "Help" : "Hjælp",
    "Groups meeting these criteria are available in %s:" : "Grupper som opfylder disse kriterier er tilgængelige i %s:",
    "Only these object classes:" : "Kun disse objektklasser:",
    "Only from these groups:" : "Kun fra disse grupper:",
    "Search groups" : "Søg grupper",
    "Available groups" : "Tilgængelige grupper",
    "Selected groups" : "Valgte grupper",
    "Edit LDAP Query" : "Redigér LDAP-forespørgsel",
    "LDAP Filter:" : "LDAP-filter:",
    "The filter specifies which LDAP groups shall have access to the %s instance." : "Filteret angiver hvilke LDAP-grupper, der skal have adgang til instansen %s.",
    "Verify settings and count groups" : "Verificér indstillinger og optællingsgrupper",
    "When logging in, %s will find the user based on the following attributes:" : "Når der logges ind, så vil %s finde brugeren baseret på følgende attributter:",
    "LDAP / AD Username:" : "LDAP/AD-brugernavn:",
    "Allows login against the LDAP / AD username, which is either uid or samaccountname and will be detected." : "Tillader login mod LDAP/AD-brugernavnet, hvilket enten er et uid eller samaccountname, og vil blive detekteret.",
    "LDAP / AD Email Address:" : "E-mailadresser for LDAP/AD:",
    "Allows login against an email attribute. Mail and mailPrimaryAddress will be allowed." : "Tillader login mod en e-mailattribut. Mail og mailPrimaryAddress vil være tilladt.",
    "Other Attributes:" : "Andre attributter:",
    "Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action. Example: \"uid=%%uid\"" : "Definerer dét filter der anvendes, når der er forsøg på at logge ind. %%uuid erstattter brugernavnet i login-handlingen. Eksempel: \"uid=%%uuid\"",
    "Test Loginname" : "Test loginnavn",
    "Verify settings" : "Verificér indstillinger",
    "1. Server" : "1. server",
    "%s. Server:" : "%s. server:",
    "Host" : "Vært",
    "You can omit the protocol, except you require SSL. Then start with ldaps://" : "Du kan udelade protokollen, medmindre du skal bruge SSL. Start i så fald med ldaps://",
    "Port" : "Port",
    "Detect Port" : "Registrér port",
    "User DN" : "Bruger DN",
    "The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." : "DN'et for klientbrugeren, for hvilken forbindelsen skal foretages, eks. uid=agent,dc=eksempel,dc=com. For anonym adgang lades DN og Password stå tomme.",
    "Password" : "Kodeord",
    "For anonymous access, leave DN and Password empty." : "For anonym adgang, skal du lade DN og Adgangskode tomme.",
    "One Base DN per line" : "Ét Base DN per linje",
    "You can specify Base DN for users and groups in the Advanced tab" : "Du kan specificere base DN for brugere og grupper i fanen Advanceret",
    "Detect Base DN" : "Registrér Base DN",
    "Test Base DN" : "Test Base DN",
    "Avoids automatic LDAP requests. Better for bigger setups, but requires some LDAP knowledge." : "Undgår automatiske LDAP-forespørgsler. Bedre på større opsætninger, men kræver en del LDAP-kendskab.",
    "Manually enter LDAP filters (recommended for large directories)" : "Angiv LDAP-filtre manuelt (anbefales til større kataloger)",
    "Limit %s access to users meeting these criteria:" : "Begræns %s-adgangen til brugere som imødekommer disse kriterier:",
    "The most common object classes for users are organizationalPerson, person, user, and inetOrgPerson. If you are not sure which object class to select, please consult your directory admin." : "De fleste gængse objektklasser for brugere er organizationalPerson, person, user og inetOrgPerson. Hvis du ikker er sikker på hvilken objektklasse, der skal vælges, så tal med administratoren af dit katalog.",
    "The filter specifies which LDAP users shall have access to the %s instance." : "Filteret angiver hvilke LDAP-brugere, der skal have adgang til %s-instansen.",
    "Verify settings and count users" : "Verificér indstillinger og optalte brugere",
    "Saving" : "Gemmer",
    "Back" : "Tilbage",
    "Continue" : "Videre",
    "LDAP" : "LDAP",
    "Expert" : "Ekspert",
    "Advanced" : "Avanceret",
    "<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." : "<b>Advarsel:</b> Apps'ene user_ldap og user_webdavauth er ikke kompatible. Du kan opleve uventet adfærd. Spørg venligst din systemadministrator om at slå én af dem fra.",
    "<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." : "<b>Advarsel:</b> PHP-modulet LDAP er ikke installeret - backend'en vil ikke fungere. Anmod venligst din systemadministrator om at installere det.",
    "Connection Settings" : "Forbindelsesindstillinger ",
    "Configuration Active" : "Konfiguration Aktiv",
    "When unchecked, this configuration will be skipped." : "Hvis der ikke er markeret, så springes denne konfiguration over.",
    "Backup (Replica) Host" : "Vært for sikkerhedskopier (replika)",
    "Give an optional backup host. It must be a replica of the main LDAP/AD server." : "Angiv valgfrit en vært for sikkerhedskopiering. Dette skal være en replikering af den primære LDAP/AD-server.",
    "Backup (Replica) Port" : "Port for sikkerhedskopi (replika)",
    "Disable Main Server" : "Deaktiver Hovedserver",
    "Only connect to the replica server." : "Forbind kun til replika serveren.",
    "Case insensitive LDAP server (Windows)" : "LDAP-server som ikke er følsom over for store/små bogstaver (Windows)",
    "Turn off SSL certificate validation." : "Deaktiver SSL certifikat validering",
    "Not recommended, use it for testing only! If connection only works with this option, import the LDAP server's SSL certificate in your %s server." : "Anbefales ikke - bruges kun til testformål! Hvis forbindelse udelukkende fungerer med dette tilvalg, så importér LDAP-serverens SSL-certifikat i din %s-server.",
    "Cache Time-To-Live" : "Cache levetid",
    "in seconds. A change empties the cache." : "i sekunder. En ændring vil tømme cachen.",
    "Directory Settings" : "Mappeindstillinger",
    "User Display Name Field" : "Vist brugernavn felt",
    "The LDAP attribute to use to generate the user's display name." : "LDAP-attributten som skal bruges til at oprette brugerens viste navn.",
    "Base User Tree" : "Base Bruger Træ",
    "One User Base DN per line" : "Én bruger-Base DN per linje",
    "User Search Attributes" : "Attributter for brugersøgning",
    "Optional; one attribute per line" : "Valgfrit; én attribut per linje",
    "Group Display Name Field" : "Navnefelt for gruppevisning",
    "The LDAP attribute to use to generate the groups's display name." : "LDAP-attributten som skal bruges til at oprette gruppens viste navn.",
    "Base Group Tree" : "Base Group Tree",
    "One Group Base DN per line" : "Ét gruppe-Base DN per linje",
    "Group Search Attributes" : "Attributter for gruppesøgning",
    "Group-Member association" : "Guppemedlem forening",
    "Nested Groups" : "Indlejrede grupper",
    "When switched on, groups that contain groups are supported. (Only works if the group member attribute contains DNs.)" : "Når slået til, så vil grupper som rummer grupper blive understøttet. (Dette fungerer kun, hvis attributten for gruppemedlem indeholder DN'er.)",
    "Paging chunksize" : "Fragmentstørrelse for sideinddeling",
    "Chunksize used for paged LDAP searches that may return bulky results like user or group enumeration. (Setting it 0 disables paged LDAP searches in those situations.)" : "Fragmentstørrelse som bruges til sideinddelte LDAP-søgninger, der kan returnere omfattende resultater såsom bruger eller gruppe-optælling. (Angivelse til 0 vil slå sideinddelte LDAP-søgninger fra for disse situationer.)",
    "Special Attributes" : "Specielle attributter",
    "Quota Field" : "Kvote Felt",
    "Quota Default" : "Standard for kvota",
    "in bytes" : "i bytes",
    "Email Field" : "Felt for e-mail",
    "User Home Folder Naming Rule" : "Navneregel for brugerens hjemmemappe",
    "Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." : "Lad stå tom for brugernavn (standard). Alternativt, angiv en LDAP/AD-attribut.",
    "Internal Username" : "Internt Brugernavn",
    "By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder. It is also a part of remote URLs, for instance for all *DAV services. With this setting, the default behavior can be overridden. To achieve a similar behavior as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users." : "Som udgangspunkt oprettes det interne brugernavn fra UUID-attributten. Den sørger for at brugernavnet er unikt, og at der ikke kræves konvertering af tegnene. Det interne brugernavn er begrænset således, at det kun er følgende tegn som tillades: [a-zA-Z0-9_.@-] . Andre tegn erstattes med deres tilsvarende ASCII-kode eller bliver simpelthen udeladt. Ved kollisioner tilføjes/forøges et tal. Det interne brugernavn bruges til at identificere en bruger internt. Det er også standardnavnet for brugerens hjemmemappe. Det er desuden en del af fjern-URL'er, for eksempel for alle *DAV-tjenester. Med denne indstilling, så kan standardadfærden tilsidesættes. For at opnå en adfærd som ligner dén fra før ownCloud 5, så angives attributten for vist brugernavn i det følgende feed. Lad den stå tom for standardadfærd. Ændringer vil kune påvirke nyligt kortlagte (tilføjede) LDAP-brugere.",
    "Internal Username Attribute:" : "Internt attribut for brugernavn:",
    "Override UUID detection" : "Tilsidesæt UUID-detektering",
    "By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." : "Som udgangspunkt registreres UUID-attributten automatisk. UUID-attributten bruges til entydig identificering af LDAP-brugere og -grupper. I tillæg vil det interne brugernavn blive oprettes på basis af UUID'et, hvis andet ikke angives ovenfor. Du kan tilsidesætte indstillingen og angive en attribut efter eget valg. Du skal sørge for at dén attribut du selv vælger, kan hentes for både brugere og grupper, samt at den er unik. Lad stå tom for standardadfærd. Ændringer vil kun påvirke nyilgt kortlagte (tilføjede) LDAP-brugere  og -grupper.",
    "UUID Attribute for Users:" : "UUID-attribut for brugere:",
    "UUID Attribute for Groups:" : "UUID-attribut for grupper:",
    "Username-LDAP User Mapping" : "Kortlægning mellem brugernavn og LDAP-bruger",
    "Usernames are used to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have an internal username. This requires a mapping from username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found. The internal username is used all over. Clearing the mappings will have leftovers everywhere. Clearing the mappings is not configuration sensitive, it affects all LDAP configurations! Never clear the mappings in a production environment, only in a testing or experimental stage." : "Brugernavne bruges til at lagre og tildele (meta)data. For at kunne identificere og genkende brugere præcist, så vil hver LDAP-bruger have et internt brugernavn. Det oprettede brugernavn kortlægges til UUID'et for LDAP-brugeren. I tillæg mellemlagres DN'et for at mindske LDAP-interaktioner, men det benyttes ikke til identifikation. Hvis DN'et ændres, så vil ændringerne blive registreret. Det interne brugernavn anvendes overalt. Hvis kortlægningerne ryddes, så vil der være rester overalt. Rydning af kortlægningerne er ikke konfigurationssensitivt - det påvirker alle LDAP-konfigurationer! Ryd aldrig kortlægningerne i et produktionsmiljø, kun i et teststadie eller eksperimentelt stadie.",
    "Clear Username-LDAP User Mapping" : "Ryd kortlægning mellem brugernavn og LDAP-bruger",
    "Clear Groupname-LDAP Group Mapping" : "Ryd kortlægning mellem gruppenavn og LDAP-gruppe"
},
"nplurals=2; plural=(n != 1);");
