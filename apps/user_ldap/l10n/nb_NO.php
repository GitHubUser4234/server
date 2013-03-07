<?php $TRANSLATIONS = array(
"Failed to delete the server configuration" => "Klarte ikke å slette tjener-konfigurasjonen.",
"The configuration is valid and the connection could be established!" => "Konfigurasjonen er i orden og tilkoblingen skal være etablert!",
"The configuration is valid, but the Bind failed. Please check the server settings and credentials." => "Konfigurasjonen er i orden, men Bind mislyktes. Vennligst sjekk tjener-konfigurasjonen og påloggingsinformasjonen.",
"The configuration is invalid. Please look in the ownCloud log for further details." => "Konfigurasjonen er ikke i orden. Vennligst se ownClouds logfil for flere detaljer.",
"Deletion failed" => "Sletting mislyktes",
"Take over settings from recent server configuration?" => "Hent innstillinger fra tidligere tjener-konfigurasjon?",
"Keep settings?" => "Behold innstillinger?",
"Cannot add server configuration" => "Kan ikke legge til tjener-konfigurasjon",
"Connection test succeeded" => "Tilkoblingstest lyktes",
"Connection test failed" => "Tilkoblingstest mislyktes",
"Do you really want to delete the current Server Configuration?" => "Er du sikker på at du vil slette aktiv tjener-konfigurasjon?",
"Confirm Deletion" => "Bekreft sletting",
"<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behaviour. Please ask your system administrator to disable one of them." => "<b>Advarsel:</b>Apps user_ldap og user_webdavauth er ikke kompatible. Du kan oppleve uventet atferd fra systemet. Vennligst spør din system-administrator om å deaktivere en av dem.",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>Warning:</b> PHP LDAP modulen er ikke installert, hjelperen vil ikke virke. Vennligst be din system-administrator om å installere den.",
"Server configuration" => "Tjener-konfigurasjon",
"Add Server Configuration" => "Legg til tjener-konfigurasjon",
"Host" => "Tjener",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "Du kan utelate protokollen, men du er påkrevd å bruke SSL.  Deretter starte med ldaps://",
"Base DN" => "Base DN",
"One Base DN per line" => "En hoved DN pr. linje",
"You can specify Base DN for users and groups in the Advanced tab" => "Du kan spesifisere Base DN for brukere og grupper under Avansert fanen",
"User DN" => "Bruker DN",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "DN nummeret til klienten som skal bindes til, f.eks. uid=agent,dc=example,dc=com. For anonym tilgang, la DN- og passord-feltet stå tomt.",
"Password" => "Passord",
"For anonymous access, leave DN and Password empty." => "For anonym tilgang, la DN- og passord-feltet stå tomt.",
"User Login Filter" => "Brukerpålogging filter",
"Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action." => "Definerer filteret som skal brukes når et påloggingsforsøk blir utført. %%uid erstatter brukernavnet i innloggingshandlingen.",
"use %%uid placeholder, e.g. \"uid=%%uid\"" => "bruk %%uid plassholder, f.eks. \"uid=%%uid\"",
"User List Filter" => "Brukerliste filter",
"Defines the filter to apply, when retrieving users." => "Definerer filteret som skal brukes, når systemet innhenter brukere.",
"without any placeholder, e.g. \"objectClass=person\"." => "uten noe plassholder, f.eks. \"objectClass=person\".",
"Group Filter" => "Gruppefilter",
"Defines the filter to apply, when retrieving groups." => "Definerer filteret som skal brukes, når systemet innhenter grupper.",
"without any placeholder, e.g. \"objectClass=posixGroup\"." => "uten noe plassholder, f.eks. \"objectClass=posixGroup\".",
"Configuration Active" => "Konfigurasjon aktiv",
"When unchecked, this configuration will be skipped." => "Når ikke huket av så vil denne konfigurasjonen bli hoppet over.",
"Port" => "Port",
"Backup (Replica) Host" => "Sikkerhetskopierings (Replica) vert",
"Use TLS" => "Bruk TLS",
"Case insensitve LDAP server (Windows)" => "Case-insensitiv LDAP tjener (Windows)",
"Turn off SSL certificate validation." => "Slå av SSL-sertifikat validering",
"If connection only works with this option, import the LDAP server's SSL certificate in your ownCloud server." => "Hvis tilgang kun fungerer med dette alternativet, importer LDAP-tjenerens SSL-sertifikat til din egen ownCloud tjener.",
"Not recommended, use for testing only." => "Ikke anbefalt, bruk kun for testing",
"in seconds. A change empties the cache." => "i sekunder. En endring tømmer bufferen.",
"User Display Name Field" => "Vis brukerens navnfelt",
"The LDAP attribute to use to generate the user`s ownCloud name." => "LDAP-attributen å bruke for å generere brukers ownCloud navn.",
"Base User Tree" => "Hovedbruker tre",
"One User Base DN per line" => "En Bruker Base DN pr. linje",
"Group Display Name Field" => "Vis gruppens navnfelt",
"The LDAP attribute to use to generate the groups`s ownCloud name." => "LDAP-attributen å bruke for å generere gruppens ownCloud navn.",
"Base Group Tree" => "Hovedgruppe tre",
"One Group Base DN per line" => "En gruppe hoved-DN pr. linje",
"Group-Member association" => "gruppe-medlem assosiasjon",
"in bytes" => "i bytes",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "La stå tom for brukernavn (standard). Ellers, spesifiser en LDAP/AD attributt.",
"Help" => "Hjelp"
);
