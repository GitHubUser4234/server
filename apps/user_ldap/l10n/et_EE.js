OC.L10N.register(
    "user_ldap",
    {
    "Failed to clear the mappings." : "Vastendususte puhastamine ebaõnnestus.",
    "Failed to delete the server configuration" : "Serveri seadistuse kustutamine ebaõnnestus",
    "The configuration is valid and the connection could be established!" : "Seadistus on korrektne ning ühendus on olemas!",
    "The configuration is valid, but the Bind failed. Please check the server settings and credentials." : "Seadistus on korrektne, kuid ühendus ebaõnnestus. Palun kontrolli serveri seadeid ja ühenduseks kasutatavaid kasutajatunnuseid.",
    "The configuration is invalid. Please have a look at the logs for further details." : "Seadistus on vigane. Lisainfot vaata palun logidest.",
    "No action specified" : "Tegevusi pole määratletud",
    "No configuration specified" : "Seadistust pole määratletud",
    "No data specified" : "Andmeid pole määratletud",
    " Could not set configuration %s" : "Ei suutnud seadistada %s",
    "Action does not exist" : "Toimingut pole olemas",
    "The Base DN appears to be wrong" : "Näib, et Base DN on vale",
    "Configuration incorrect" : "Seadistus on vigane",
    "Configuration incomplete" : "Seadistus on puudulik",
    "Configuration OK" : "Seadistus on korras",
    "Select groups" : "Vali grupid",
    "Select object classes" : "Vali objekti klassid",
    "Please check the credentials, they seem to be wrong." : "Palu nkontrolli kasutajaandmeid, need näivad olevat valed.",
    "Could not detect Base DN, please enter it manually." : "BaasDN-i tuvastamine ebaõnnestus. Palun sisesta see käsitsi.",
    "{nthServer}. Server" : "{nthServer}. Server",
    "Do you really want to delete the current Server Configuration?" : "Oled kindel, et tahad kustutada praegust serveri seadistust?",
    "Confirm Deletion" : "Kinnita kustutamine",
    "Mappings cleared successfully!" : "Vastandused on eemaldatud!",
    "Error while clearing the mappings." : "Tõrgeseose eemaldamisel.",
    "Mode switch" : "Režiimi lüliti",
    "Select attributes" : "Vali atribuudid",
    "User found and settings verified." : "Kasutaja leiti ja seaded on kontrollitud.",
    "Please provide a login name to test against" : "Palun sisesta kasutajanimi, mida testida",
    "_%s group found_::_%s groups found_" : ["%s grupp leitud","%s gruppi leitud"],
    "_%s user found_::_%s users found_" : ["%s kasutaja leitud","%s kasutajat leitud"],
    "Could not find the desired feature" : "Ei suuda leida soovitud funktsioonaalsust",
    "Invalid Host" : "Vigane server",
    "Test Configuration" : "Testi seadistust",
    "Help" : "Abiinfo",
    "Groups meeting these criteria are available in %s:" : "Kriteeriumiga sobivad grupid on saadaval %s:",
    "Only these object classes:" : "Ainult neid objektide klasse:",
    "Only from these groups:" : "Ainult neist gruppidest:",
    "Search groups" : "Otsi gruppe",
    "Available groups" : "Saadaolevad grupid",
    "Selected groups" : "Validut grupid",
    "Edit LDAP Query" : "Muuda LDAP päringut",
    "LDAP Filter:" : "LDAP filter:",
    "The filter specifies which LDAP groups shall have access to the %s instance." : "Filter määrab millised LDAP grupid saavad ligipääsu sellele %s instantsile.",
    "Verify settings and count groups" : "Kontrolli seadeid ja loe grupid üle",
    "LDAP / AD Username:" : "LDAP / AD kasutajanimi:",
    "LDAP / AD Email Address:" : "LDAP / AD e-posti aadress:",
    "Other Attributes:" : "Muud atribuudid:",
    "Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action. Example: \"uid=%%uid\"" : "Määrab sisselogimisel kasutatava filtri. %%uid asendab sisselogimistegevuses kasutajanime. Näide: \"uid=%%uid\"",
    "Test Loginname" : "Testi kasutajanime",
    "Verify settings" : "Kontrolli seadeid",
    "1. Server" : "1. Server",
    "%s. Server:" : "%s. Server:",
    "Add a new and blank configuration" : "Lisa uus ja tühi seadistus",
    "Delete the current configuration" : "Kustuta praegune seadistus",
    "Host" : "Host",
    "You can omit the protocol, except you require SSL. Then start with ldaps://" : "Sa ei saa protokolli ära jätta, välja arvatud siis, kui sa nõuad SSL-ühendust. Sel juhul alusta eesliitega ldaps://",
    "Port" : "Port",
    "Detect Port" : "Tuvasta port",
    "User DN" : "Kasutaja DN",
    "The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." : "Klientkasutaja DN, kellega seotakse, nt. uid=agent,dc=näidis,dc=com. Anonüümseks ligipääsuks jäta DN ja parool tühjaks.",
    "Password" : "Parool",
    "For anonymous access, leave DN and Password empty." : "Anonüümseks ligipääsuks jäta DN ja parool tühjaks.",
    "One Base DN per line" : "Üks baas-DN rea kohta",
    "You can specify Base DN for users and groups in the Advanced tab" : "Sa saad kasutajate ja gruppide baas DN-i määrata lisavalikute vahekaardilt",
    "Detect Base DN" : "Tuvasta Baas DN",
    "Test Base DN" : "Testi Baas DN-i",
    "Avoids automatic LDAP requests. Better for bigger setups, but requires some LDAP knowledge." : "Väldib automaatseid LDAP päringuid, Parem suurematele saitidele, aga nõuab mõningaid teadmisi LDAP kohta.",
    "Manually enter LDAP filters (recommended for large directories)" : "Sisesta LDAP filtrid automaatselt (sooitatav suurtele kataloogidele)",
    "The filter specifies which LDAP users shall have access to the %s instance." : "Filter määrab millised LDAP kasutajad pääsevad ligi %s instantsile.",
    "Saving" : "Salvestamine",
    "Back" : "Tagasi",
    "Continue" : "Jätka",
    "LDAP" : "LDAP",
    "Server" : "Server",
    "Users" : "Kasutajad",
    "Login Attributes" : "Sisselogimise andmed",
    "Groups" : "Grupid",
    "Expert" : "Ekspert",
    "Advanced" : "Täpsem",
    "<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." : "<b>Hoiatus:</b> rakendused user_ldap ja user_webdavauht ei ole ühilduvad. Töös võib esineda ootamatuid tõrkeid.\nPalu oma süsteemihalduril üks neist rakendustest kasutusest eemaldada.",
    "<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." : "<b>Hoiatus:</b>PHP LDAP moodul pole paigaldatud ning LDAP kasutamine ei ole võimalik. Palu oma süsteeihaldurit see paigaldada.",
    "Connection Settings" : "Ühenduse seaded",
    "Configuration Active" : "Seadistus aktiivne",
    "When unchecked, this configuration will be skipped." : "Kui on märkimata, siis seadistust ei kasutata.",
    "Backup (Replica) Host" : "Varuserver",
    "Give an optional backup host. It must be a replica of the main LDAP/AD server." : "Lisa valikuline varuserver. See peab olema koopia peamisest LDAP/AD serverist.",
    "Backup (Replica) Port" : "Varuserveri (replika) port",
    "Disable Main Server" : "Ära kasuta peaserverit",
    "Only connect to the replica server." : "Ühendu ainult replitseeriva serveriga.",
    "Turn off SSL certificate validation." : "Lülita SSL sertifikaadi kontrollimine välja.",
    "Not recommended, use it for testing only! If connection only works with this option, import the LDAP server's SSL certificate in your %s server." : "Pole soovitatav, kasuta seda ainult testimiseks! Kui ühendus toimib ainult selle valikuga, siis impordi LDAP serveri SSL sertifikaat oma %s serverisse.",
    "Cache Time-To-Live" : "Puhvri iga",
    "in seconds. A change empties the cache." : "sekundites. Muudatus tühjendab vahemälu.",
    "Directory Settings" : "Kausta seaded",
    "User Display Name Field" : "Kasutaja näidatava nime väli",
    "The LDAP attribute to use to generate the user's display name." : "LDAP atribuut, mida kasutatakse kasutaja kuvatava nime loomiseks.",
    "Base User Tree" : "Baaskasutaja puu",
    "One User Base DN per line" : "Üks kasutaja baas-DN rea kohta",
    "User Search Attributes" : "Kasutaja otsingu atribuudid",
    "Optional; one attribute per line" : "Valikuline; üks atribuut rea kohta",
    "Group Display Name Field" : "Grupi näidatava nime väli",
    "The LDAP attribute to use to generate the groups's display name." : "LDAP atribuut, mida kasutatakse ownCloudi grupi kuvatava nime loomiseks.",
    "Base Group Tree" : "Baasgrupi puu",
    "One Group Base DN per line" : "Üks grupi baas-DN rea kohta",
    "Group Search Attributes" : "Grupi otsingu atribuudid",
    "Group-Member association" : "Grupiliikme seotus",
    "Nested Groups" : "Sisegrupp",
    "When switched on, groups that contain groups are supported. (Only works if the group member attribute contains DNs.)" : "Sisse lülitamisel on toetatakse gruppe sisaldavad gruppe. (Toimib, kui grupi liikme atribuut sisaldab DN-e.)",
    "Paging chunksize" : "Kutsungi pataka suurus",
    "Chunksize used for paged LDAP searches that may return bulky results like user or group enumeration. (Setting it 0 disables paged LDAP searches in those situations.)" : "Pataka suurust kasutatakse LDAPi kutsungite kaupa otsingute puhul, mis võivad väljastada pikki kasutajate või gruppide loetelusid. (Määrates suuruseks 0, keelatakse LDAP patakate kaupa otsing taolistes situatsioonides)",
    "Special Attributes" : "Spetsiifilised atribuudid",
    "Quota Field" : "Mahupiirangu atribuut",
    "Quota Default" : "Vaikimisi mahupiirang",
    "Email Field" : "E-posti väli",
    "User Home Folder Naming Rule" : "Kasutaja kodukataloogi nimetamise reegel",
    "Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." : "Kasutajanime (vaikeväärtus) kasutamiseks jäta tühjaks. Vastasel juhul määra LDAP/AD omadus.",
    "Internal Username" : "Sisemine kasutajanimi",
    "Internal Username Attribute:" : "Sisemise kasutajatunnuse atribuut:",
    "Override UUID detection" : "Tühista UUID tuvastus",
    "By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." : "Vaikimis ownCloud tuvastab automaatselt UUID atribuudi. UUID atribuuti kasutatakse LDAP kasutajate ja gruppide kindlaks tuvastamiseks. Samuti tekitatakse sisemine kasutajanimi UUID alusel, kui pole määratud teisiti. Sa saad tühistada selle seadistuse ning määrata atribuudi omal valikul. Pead veenduma, et valitud atribuut toimib nii kasutajate kui gruppide puhul ning on unikaalne. Vaikimisi seadistuseks jäta tühjaks. Muudatused mõjutavad ainult uusi (lisatud) LDAP kasutajate vastendusi.",
    "UUID Attribute for Users:" : "UUID atribuut kasutajatele:",
    "UUID Attribute for Groups:" : "UUID atribuut gruppidele:",
    "Username-LDAP User Mapping" : "LDAP-Kasutajatunnus Kasutaja Vastendus",
    "Clear Username-LDAP User Mapping" : "Puhasta LDAP-Kasutajatunnus Kasutaja Vastendus",
    "Clear Groupname-LDAP Group Mapping" : "Puhasta LDAP-Grupinimi Grupp Vastendus",
    "in bytes" : "baitides"
},
"nplurals=2; plural=(n != 1);");
