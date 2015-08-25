OC.L10N.register(
    "user_ldap",
    {
    "Failed to clear the mappings." : "Klarte ikke å nullstille tilknytningene.",
    "Failed to delete the server configuration" : "Klarte ikke å slette tjener-konfigurasjonen.",
    "The configuration is invalid: anonymous bind is not allowed." : "Konfigurasjonen er ugyldig: Anonym binding er ikke tillatt.",
    "The configuration is valid and the connection could be established!" : "Konfigurasjonen er i orden og tilkoblingen skal være etablert!",
    "The configuration is valid, but the Bind failed. Please check the server settings and credentials." : "Konfigurasjonen er i orden, men binding mislyktes. Vennligst sjekk tjener-konfigurasjonen og påloggingsinformasjonen.",
    "The configuration is invalid. Please have a look at the logs for further details." : "Konfigurasjonen er ikke gyldig. Sjekk loggene for flere detaljer.",
    "No action specified" : "Ingen handling spesifisert",
    "No configuration specified" : "Ingen konfigurasjon spesifisert",
    "No data specified" : "Ingen data spesifisert",
    " Could not set configuration %s" : "Klarte ikke å sette konfigurasjon %s",
    "Action does not exist" : "Aksjonen eksisterer ikke",
    "The Base DN appears to be wrong" : "Basis-DN ser ut til å være feil",
    "Configuration incorrect" : "Konfigurasjon feil",
    "Configuration incomplete" : "Konfigurasjon ufullstendig",
    "Configuration OK" : "Konfigurasjon OK",
    "Select groups" : "Velg grupper",
    "Select object classes" : "Velg objektklasser",
    "Please check the credentials, they seem to be wrong." : "Sjekk påloggingsdetaljene; de ser ut til å være feil.",
    "Please specify the port, it could not be auto-detected." : "Vennligst spesifiser porten. Den kunne ikke påvises automatisk.",
    "Base DN could not be auto-detected, please revise credentials, host and port." : "Basis-DN kunne ikke påvises automatisk. Se igjennom pålogginsdetaljer, vertsnavn og portnummer.",
    "Could not detect Base DN, please enter it manually." : "Klarte ikke å påvise basis-DN. Det må skrives inn manuelt.",
    "{nthServer}. Server" : "{nthServer}. server",
    "No object found in the given Base DN. Please revise." : "Intet objekt funnet i angitt basis-DN. Revider oppsettet.",
    "More than 1.000 directory entries available." : "Mer enn 1000 katalogoppføringer tilgjengelig.",
    " entries available within the provided Base DN" : "oppføringer tilgjengelig innenfor angitt basis-DN",
    "An error occurred. Please check the Base DN, as well as connection settings and credentials." : "Det oppstod en feil. Sjekk basis-DN, tilkoblingsoppsett og påloggingsdetaljer.",
    "Do you really want to delete the current Server Configuration?" : "Er du sikker på at du vil slette aktiv tjener-konfigurasjon?",
    "Confirm Deletion" : "Bekreft sletting",
    "Mappings cleared successfully!" : "Tilknytningene ble nullstilt!",
    "Error while clearing the mappings." : "Feil ved nullstilling av tilknytningene.",
    "Anonymous bind is not allowed. Please provide a User DN and Password." : "Anonym binding er ikke tillatt. Oppgi en bruker-DN og passord.",
    "LDAP Operations error. Anonymous bind might not be allowed." : "Feil ved LDAP-operasjon. Anonym binding er kanskje ikke tillatt.",
    "Saving failed. Please make sure the database is in Operation. Reload before continuing." : "Lagring fellet. Forsikre deg om at database er i gang. Last på nytt før du fortsetter.",
    "Switching the mode will enable automatic LDAP queries. Depending on your LDAP size they may take a while. Do you still want to switch the mode?" : "Endring av modus vil aktivere automatiske LDAP-spørringer. Avhengig av din LDAP-størrelse kan de ta litt tid. Vil du likevel endre modus?",
    "Mode switch" : "Endring av modus",
    "Select attributes" : "Velg attributter",
    "User not found. Please check your login attributes and username. Effective filter (to copy-and-paste for command line validation): <br/>" : "Bruker ikke funnet. Sjekk påloggingsattributtene og brukernavnet. Virksomt filter (kopier og lim inn for validering på kommandolinjen): <br/>",
    "User found and settings verified." : "Bruker funnet og innstillingene sjekket.",
    "Settings verified, but one user found. Only the first will be able to login. Consider a more narrow filter." : "Innstillinger sjekket, men en bruker funnet. Kun den første vil kunne logge inn. Vurder et smalere filter.",
    "An unspecified error occurred. Please check the settings and the log." : "En uspesifisert feil oppstod. Sjekk innstillingene og loggen.",
    "The search filter is invalid, probably due to syntax issues like uneven number of opened and closed brackets. Please revise." : "Søkefilteret er ugyldig, antakelig pga. syntaksproblemer som ulikt antall start- og sluttparenteser. Vennligst sjekk.",
    "A connection error to LDAP / AD occurred, please check host, port and credentials." : "Det oppstod en feil ved tilkobling til LDAP / AD. Sjekk vertsnavn, portnummer og påloggingsdetaljer.",
    "The %uid placeholder is missing. It will be replaced with the login name when querying LDAP / AD." : "Plassholder %uid mangler. Den erstattes av påloggingsnavnet ved spørring mot LDAP / AD.",
    "Please provide a login name to test against" : "Vennligst oppgi et påloggingsnavn å teste mot",
    "The group box was disabled, because the LDAP / AD server does not support memberOf." : "Gruppeboksen ble deaktivert fordi LDAP- / AD-serveren ikke støtter memberOf.",
    "_%s group found_::_%s groups found_" : ["%s gruppe funnet","%s grupper funnet"],
    "_%s user found_::_%s users found_" : ["%s bruker funnet","%s brukere funnet"],
    "Could not detect user display name attribute. Please specify it yourself in advanced ldap settings." : "Kunne ikke påvise attributt for brukers visningsnavn. Du må selv spesifisere det i avanserte LDAP-innstillinger.",
    "Could not find the desired feature" : "Fant ikke den ønskede funksjonaliteten",
    "Invalid Host" : "Ugyldig tjener",
    "Server" : "Server",
    "Users" : "Brukere",
    "Login Attributes" : "Påloggingsattributter",
    "Groups" : "Grupper",
    "Test Configuration" : "Test konfigurasjonen",
    "Help" : "Hjelp",
    "Groups meeting these criteria are available in %s:" : "Grupper som tilfredsstiller disse kriteriene er tilgjengelige i %s:",
    "Only these object classes:" : "Kun disse objektklassene:",
    "Only from these groups:" : "Kun fra disse gruppene:",
    "Search groups" : "Søk i grupper",
    "Available groups" : "Tilgjengelige grupper",
    "Selected groups" : "Valgte grupper",
    "Edit LDAP Query" : "Rediger LDAP-spørring",
    "LDAP Filter:" : "LDAP-filter:",
    "The filter specifies which LDAP groups shall have access to the %s instance." : "Filteret spesifiserer hvilke LDAP-grupper som skal ha tilgang til %s-instansen.",
    "Verify settings and count groups" : "Sjekk innstillinger og tell grupper",
    "When logging in, %s will find the user based on the following attributes:" : "Ved pålogging vil %s finne brukeren basert på følgende attributter:",
    "LDAP / AD Username:" : "LDAP / AD brukernavn:",
    "Allows login against the LDAP / AD username, which is either uid or samaccountname and will be detected." : "Tillater pålogging med LDAP / AD brukernavn, som er enten uid eller samaccountname og vil bli oppdaget.",
    "LDAP / AD Email Address:" : "LDAP / AD Epost-adresse:",
    "Allows login against an email attribute. Mail and mailPrimaryAddress will be allowed." : "Log alltid på med en epost-attributt. Mail og mailPrimaryAddress vil være tillatt.",
    "Other Attributes:" : "Andre attributter:",
    "Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action. Example: \"uid=%%uid\"" : "Definerer filteret som skal brukes når noen prøver å logge inn. %%uid erstatter brukernavnet i innloggingen. Eksempel: \"uid=%%uid\"",
    "Test Loginname" : "Test påloggingsnavn",
    "Verify settings" : "Sjekk innstillinger",
    "1. Server" : "1. server",
    "%s. Server:" : "%s. server:",
    "Add a new and blank configuration" : "Legg til en ny tom konfigurasjon",
    "Copy current configuration into new directory binding" : "Kopier gjeldende konfigurasjon til ny katalogbinding",
    "Delete the current configuration" : "Slett gjeldende konfigurasjon",
    "Host" : "Tjener",
    "You can omit the protocol, except you require SSL. Then start with ldaps://" : "Du kan utelate protokollen, men du er påkrevd å bruke SSL.  Deretter starte med ldaps://",
    "Port" : "Port",
    "Detect Port" : "Påvis port",
    "User DN" : "Bruker DN",
    "The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." : "DN for klientbrukeren som binding skal gjøres med, f.eks. uid=agent,dc=example,dc=com. For anonym tilgang, la DN og passord stå tomme.",
    "Password" : "Passord",
    "For anonymous access, leave DN and Password empty." : "For anonym tilgang, la DN- og passord-feltet stå tomt.",
    "One Base DN per line" : "En basis-DN pr. linje",
    "You can specify Base DN for users and groups in the Advanced tab" : "Du kan spesifisere basis-DN for brukere og grupper under Avansert fanen",
    "Detect Base DN" : "Påvis basis-DN",
    "Test Base DN" : "Test basis-DN",
    "Avoids automatic LDAP requests. Better for bigger setups, but requires some LDAP knowledge." : "Unngår automatiske LDAP-forespørsler. Bedre for store oppsett men krever litt LDAP-kunnskap.",
    "Manually enter LDAP filters (recommended for large directories)" : "Legg inn LDAP-filtre manuelt (anbefalt for store kataloger)",
    "Limit %s access to users meeting these criteria:" : "Begrens %s-tilgang til brukere som tilfredsstiller disse kriteriene:",
    "The most common object classes for users are organizationalPerson, person, user, and inetOrgPerson. If you are not sure which object class to select, please consult your directory admin." : "De mest vanlige objektklassene for brukere er organizationalPerson, person, user og inetOrgPerson. Kontakt katalogadministratoren hvis du er usikker på hvilken objektklasse du skal velge.",
    "The filter specifies which LDAP users shall have access to the %s instance." : "Filteret spesifiserer hvilke LDAP-brukere som skal ha tilgang til %s-instansen.",
    "Verify settings and count users" : "Sjekk innstillinger og tell brukere",
    "Saving" : "Lagrer",
    "Back" : "Tilbake",
    "Continue" : "Fortsett",
    "LDAP" : "LDAP",
    "Expert" : "Ekspert",
    "Advanced" : "Avansert",
    "<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." : "<b>Advarsel:</b> Appene user_ldap og user_webdavauth er ikke kompatible med hverandre. Uventet oppførsel kan forekomme. Be systemadministratoren om å deaktivere en av dem.",
    "<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." : "<b>Advarsel:</b> PHP LDAP-modulen er ikke installert og serveren vil ikke virke. Vennligst be systemadministratoren installere den.",
    "Connection Settings" : "Innstillinger for tilkobling",
    "Configuration Active" : "Konfigurasjon aktiv",
    "When unchecked, this configuration will be skipped." : "Når ikke huket av så vil denne konfigurasjonen bli hoppet over.",
    "Backup (Replica) Host" : "Sikkerhetskopierings (Replica) vert",
    "Give an optional backup host. It must be a replica of the main LDAP/AD server." : "Oppgi en valgfri reservetjener. Den må være en replika av hovedtjeneren for LDAP/AD.",
    "Backup (Replica) Port" : "Reserve (Replika) Port",
    "Disable Main Server" : "Deaktiver hovedtjeneren",
    "Only connect to the replica server." : "Koble til bare replika-tjeneren.",
    "Turn off SSL certificate validation." : "Slå av SSL-sertifikat validering",
    "Not recommended, use it for testing only! If connection only works with this option, import the LDAP server's SSL certificate in your %s server." : "Ikke anbefalt, bruk kun for testing! Hvis tilkobling bare virker med dette valget, importer LDAP-tjenerens SSL-sertifikat i %s-serveren din.",
    "Cache Time-To-Live" : "Levetid i mellomlager",
    "in seconds. A change empties the cache." : "i sekunder. En endring tømmer bufferen.",
    "Directory Settings" : "Innstillinger for katalog",
    "User Display Name Field" : "Felt med brukerens visningsnavn",
    "The LDAP attribute to use to generate the user's display name." : "LDAP-attributten som skal brukes til å generere brukerens visningsnavn.",
    "Base User Tree" : "Basis for bruker-tre",
    "One User Base DN per line" : "En basis-DN for brukere pr. linje",
    "User Search Attributes" : "Attributter for brukersøk",
    "Optional; one attribute per line" : "Valgfritt, en attributt pr. linje",
    "Group Display Name Field" : "Felt med gruppens visningsnavn",
    "The LDAP attribute to use to generate the groups's display name." : "LDAP-attributten som skal brukes til å generere gruppens visningsnavn.",
    "Base Group Tree" : "Basis for gruppe-tre",
    "One Group Base DN per line" : "En basis-DN for grupper pr. linje",
    "Group Search Attributes" : "Attributter for gruppesøk",
    "Group-Member association" : "gruppe-medlem assosiasjon",
    "Nested Groups" : "Nestede grupper",
    "When switched on, groups that contain groups are supported. (Only works if the group member attribute contains DNs.)" : "Grupper som inneholder grupper er tillatt når denne er slått på. (Virker bare hvis gruppenes member-attributt inneholder DN-er.)",
    "Paging chunksize" : "Sidestørrelse",
    "Chunksize used for paged LDAP searches that may return bulky results like user or group enumeration. (Setting it 0 disables paged LDAP searches in those situations.)" : "Sidestørrelsen brukes for sidevise (paged) LDAP-søk som kan returnere store resultater, som f.eks. gjennomløping av brukere eller grupper. (Sett til 0 for å deaktivere sidevis LDAP-spørring i disse situasjonene.)",
    "Special Attributes" : "Spesielle attributter",
    "Quota Field" : "Felt med lagringskvote",
    "Quota Default" : "Standard lagringskvote",
    "in bytes" : "i bytes",
    "Email Field" : "Felt med e-postadresse",
    "User Home Folder Naming Rule" : "Navneregel for brukers hjemmemappe",
    "Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." : "La stå tom for brukernavn (standard). Ellers, spesifiser en LDAP/AD attributt.",
    "Internal Username" : "Internt brukernavn",
    "By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder. It is also a part of remote URLs, for instance for all *DAV services. With this setting, the default behavior can be overridden. To achieve a similar behavior as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users." : "Som standard vil det interne brukernavnet bli laget utifra UUID-attributten. Dette sikrer at brukernavnet er unikt og at det ikke er nødvendig å konvertere tegn. Det interne brukernavnet har den begrensningen at bare disse tegnene er tillatt: [ a-zA-Z0-9_.@- ]. Andre tegn erstattes av tilsvarende ASCII-tegn eller blir ganske enkelt utelatt. Ved kollisjon blir et nummer lagt til / øket. Det interne brukernavnet brukes til å identifisere en bruker internt. Det er også standardnavnet på brukerens hjemmemappe. Det er også med i eksterne URL-er, for eksempel for alle *DAV-tjenester. Med denne innstillingen kan standard oppførsel overstyres. For å få en oppførsel som likner oppførselen før ownCloud 5, legg inn attributten for brukerens visningsnavn i dette feltet. La feltet stå tomt for standard oppførsel. Endringer vil kun påvirke nylig tilknyttede (opprettede) LDAP-brukere.",
    "Internal Username Attribute:" : "Attributt for internt brukernavn:",
    "Override UUID detection" : "Overstyr UUID-påvisning",
    "By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." : "Som standard blir UUID-attributten påvist automatisk. UUID-attributten brukes til å identifisere LDAP-brukere og -grupper unikt. Det interne brukernavnet vil også bli laget basert på UUID, hvis ikke annet er spesifisert ovenfor. Du kan overstyre innstillingen og oppgi den attributten du ønsker. Du må forsikre deg om at din valgte attributt kan hentes ut både for brukere og for grupper og at den er unik. La stå tomt for standard oppførsel. Endringer vil kun påvirke nylig tilknyttede (opprettede) LDAP-brukere og -grupper.",
    "UUID Attribute for Users:" : "UUID-attributt for brukere:",
    "UUID Attribute for Groups:" : "UUID-attributt for grupper:",
    "Username-LDAP User Mapping" : "Tilknytning av brukernavn til LDAP-bruker",
    "Usernames are used to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have an internal username. This requires a mapping from username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found. The internal username is used all over. Clearing the mappings will have leftovers everywhere. Clearing the mappings is not configuration sensitive, it affects all LDAP configurations! Never clear the mappings in a production environment, only in a testing or experimental stage." : "Brukernavn brukes til å lagre og tilordne (meta)data. For at brukere skal identifiseres og gjenkjennes presist, vil hver LDAP-bruker ha et internt brukernavn. Dette krever en tilknytning fra brukernavn til LDAP-bruker. Brukernavn som opprettes blir knyttet til LDAP-brukerens UUID. I tillegg mellomlagres DN for å redusere LDAP-kommunikasjon, men det brukes ikke til identifisering. Hvis DN endres vil endringene bli oppdaget. Det interne brukernavnet brukes alle steder. Nullstilling av tilknytningene vil etterlate seg rester overalt. Nullstilling av tilknytningene skjer ikke pr. konfigurasjon, det påvirker alle LDAP-konfigurasjoner! Nullstill aldri tilknytningene i et produksjonsmiljø, kun ved testing eller eksperimentering.",
    "Clear Username-LDAP User Mapping" : "Nullstill tilknytning av brukernavn til LDAP-bruker",
    "Clear Groupname-LDAP Group Mapping" : "Nullstill tilknytning av gruppenavn til LDAP-gruppe"
},
"nplurals=2; plural=(n != 1);");
