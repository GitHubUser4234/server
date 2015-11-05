OC.L10N.register(
    "user_ldap",
    {
    "Failed to clear the mappings." : "Löschen der Zuordnungen fehlgeschlagen.",
    "Failed to delete the server configuration" : "Löschen der Serverkonfiguration fehlgeschlagen",
    "The configuration is invalid: anonymous bind is not allowed." : "Die Konfiguration ist ungültig: anonymes binden ist nicht erlaubt.",
    "The configuration is valid and the connection could be established!" : "Die Konfiguration ist gültig und die Verbindung konnte hergestellt werden!",
    "The configuration is valid, but the Bind failed. Please check the server settings and credentials." : "Die Konfiguration ist gültig, aber der LDAP-Bind ist fehlgeschlagen. Bitte überprüfe die Servereinstellungen und Anmeldeinformationen.",
    "The configuration is invalid. Please have a look at the logs for further details." : "Die Konfiguration ist ungültig. Weitere Details kannst Du in den Logdateien nachlesen.",
    "No action specified" : "Keine Aktion angegeben",
    "No configuration specified" : "Keine Konfiguration angegeben",
    "No data specified" : "Keine Daten angegeben",
    " Could not set configuration %s" : "Die Konfiguration %s konnte nicht gesetzt werden",
    "Action does not exist" : "Aktion existiert nicht",
    "The Base DN appears to be wrong" : "Die Base-DN scheint falsch zu sein",
    "Configuration incorrect" : "Konfiguration nicht korrekt",
    "Configuration incomplete" : "Konfiguration nicht vollständig",
    "Configuration OK" : "Konfiguration OK",
    "Select groups" : "Gruppen auswählen",
    "Select object classes" : "Objektklassen auswählen",
    "Please check the credentials, they seem to be wrong." : "Bitte überprüfe die Anmeldeinformationen, sie sind anscheinend falsch.",
    "Please specify the port, it could not be auto-detected." : "Bitte gib den Port an, er konnte nicht automatisch erkannt werden.",
    "Base DN could not be auto-detected, please revise credentials, host and port." : "Die Base DN konnte nicht automatisch erkannt werden, bitte überprüfe die Anmeldeinformationen, den Host und den Port.",
    "Could not detect Base DN, please enter it manually." : "Die Base DN konnte nicht erkannt werden, bitte manuell eingeben.",
    "{nthServer}. Server" : "{nthServer}. - Server",
    "No object found in the given Base DN. Please revise." : "Keine Objekte in der Base DN gefunden, bitte überprüfen.",
    "More than 1.000 directory entries available." : "Mehr als 1.000 Verzeichniseinträge verfügbar.",
    " entries available within the provided Base DN" : "Einträge in der Vorgesehenen Base DN verfügbar",
    "An error occurred. Please check the Base DN, as well as connection settings and credentials." : "Ein Fehler ist aufgetreten. Bitte prüfe die Base DN und auch die Verbindungs- und Anmeldeeinstellungen.",
    "Do you really want to delete the current Server Configuration?" : "Soll die aktuelle Serverkonfiguration wirklich gelöscht werden?",
    "Confirm Deletion" : "Löschen bestätigen",
    "Mappings cleared successfully!" : "Zuordnungen erfolgreich gelöscht!",
    "Error while clearing the mappings." : "Fehler beim Löschen der Zuordnungen.",
    "Anonymous bind is not allowed. Please provide a User DN and Password." : "Anonymes binden ist nicht erlaubt. Bitte eine Nutzer-DN und ein Passwort angeben.",
    "LDAP Operations error. Anonymous bind might not be allowed." : "Fehler in den LDAP-Operationen. Anonymes binden ist scheinbar nicht erlaubt.",
    "Saving failed. Please make sure the database is in Operation. Reload before continuing." : "Speichern fehlgeschlagen. Bitte stelle sicher, dass die Datenbank in Betrieb ist. Bitte lade vor dem Fortfahren neu.",
    "Switching the mode will enable automatic LDAP queries. Depending on your LDAP size they may take a while. Do you still want to switch the mode?" : "Das Umschalten des Modus ermöglicht automatische LDAP-Abfragen. Abhängig von Deiner LDAP-Größe können diese einige Zeit in Anspruch nehmen. Willst Du immer noch den Modus wechseln?",
    "Mode switch" : "Modus umschalten",
    "Select attributes" : "Attribute auswählen",
    "User not found. Please check your login attributes and username. Effective filter (to copy-and-paste for command line validation): <br/>" : "Benutzer nicht gefunden. Bitte überprüfe Deine Loginattribute und Deinen Benutzernamen. Gültige Filter (zum Kopieren und Einfügen bei der Überprüfung auf der Kommandozeile): <br/>",
    "User found and settings verified." : "Benutzer gefunden und Einstellungen überprüft.",
    "Settings verified, but one user found. Only the first will be able to login. Consider a more narrow filter." : "Einstellungen überprüft, aber einen Nutzer gefunden. Nur der Erste kann sich anmelden. Verwende möglicherweise einen engeren Filter.",
    "An unspecified error occurred. Please check the settings and the log." : "Ein nicht näher spezifizierter Fehler ist aufgetreten. Bitte prüfe die Einstellungen und die Logdatei.",
    "The search filter is invalid, probably due to syntax issues like uneven number of opened and closed brackets. Please revise." : "Der Suchfilter ist ungültig, möglicherweise bestehen Eingabefehler wie z.B. eine ungerade Anzahl von geöffneten und geschlossenen Klammern. Bitte überarbeiten.",
    "A connection error to LDAP / AD occurred, please check host, port and credentials." : "Es ist ein Verbindungsfehler zum LDAP/AD aufgetreten, bitte überprüfe Host, Port und Anmeldeinformationen.",
    "The %uid placeholder is missing. It will be replaced with the login name when querying LDAP / AD." : "Der %uid - Platzhalter fehlt. Dieser wird mit dem Anmeldenamen beim Abfragen von LDAP / AD ersetzt.",
    "Please provide a login name to test against" : "Bitte gib einen Benutzernamen an, um gegen diesen zu testen",
    "The group box was disabled, because the LDAP / AD server does not support memberOf." : "Das Gruppenfeld wurde deaktiviert, da der LDAP / AD-Server memberOf nicht unterstützt.",
    "_%s group found_::_%s groups found_" : ["%s Gruppe gefunden","%s Gruppen gefunden"],
    "_%s user found_::_%s users found_" : ["%s Benutzer gefunden","%s Benutzer gefunden"],
    "Could not detect user display name attribute. Please specify it yourself in advanced ldap settings." : "Das Anzeigename-Attribut des Benutzers konnte nicht gefunden werden. Bitte gib es in den erweiterten LDAP-Einstellungen selber an.",
    "Could not find the desired feature" : "Die gewünschte Funktion konnte nicht gefunden werden",
    "Invalid Host" : "Ungültiger Host",
    "Server" : "Server",
    "Users" : "Benutzer",
    "Login Attributes" : "Loginattribute",
    "Groups" : "Gruppen",
    "Test Configuration" : "Testkonfiguration",
    "Help" : "Hilfe",
    "Groups meeting these criteria are available in %s:" : "Gruppen, auf die diese Kriterien zutreffen, sind verfügbar in %s:",
    "Only these object classes:" : "Nur diese Objektklassen:",
    "Only from these groups:" : "Nur aus diesen Gruppen:",
    "Search groups" : "Gruppen suchen",
    "Available groups" : "Verfügbare Gruppen",
    "Selected groups" : "Ausgewählte Gruppen",
    "Edit LDAP Query" : "LDAP-Abfrage bearbeiten",
    "LDAP Filter:" : "LDAP-Filter:",
    "The filter specifies which LDAP groups shall have access to the %s instance." : "Der Filter bestimmt, welche LDAP-Gruppen Zugriff auf die %s-Instanz haben sollen.",
    "Verify settings and count groups" : "Einstellungen überprüfen und Gruppen zählen",
    "When logging in, %s will find the user based on the following attributes:" : "Beim Anmelden wird %s den Nutzer basierend auf folgenden Attributen finden:",
    "LDAP / AD Username:" : "LDAP-/AD-Benutzername:",
    "Allows login against the LDAP / AD username, which is either uid or samaccountname and will be detected." : "Erlaubt das Anmelden gegen den LDAP / AD Nutzernamen, welcher entweder eine UID oder samaccountname ist und automatisch erkannt wird.",
    "LDAP / AD Email Address:" : "LDAP-/AD-E-Mail-Adresse:",
    "Allows login against an email attribute. Mail and mailPrimaryAddress will be allowed." : "Erlaubt das Anmelden gegen ein E-Mail Attribut. Mail und mailPrimaryAddress sind erlaubt.",
    "Other Attributes:" : "Andere Attribute:",
    "Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action. Example: \"uid=%%uid\"" : "Bestimmt den Filter, welcher bei einer Anmeldung angewandt wird. %%uid ersetzt den Benutzernamen bei der Anmeldung. Beispiel: \"uid=%%uid\"",
    "Test Loginname" : "Loginnamen testen",
    "Verify settings" : "Einstellungen überprüfen",
    "1. Server" : "1. Server",
    "%s. Server:" : "%s. Server:",
    "Add a new and blank configuration" : "Eine neue und leere Konfiguration hinzufügen",
    "Copy current configuration into new directory binding" : "Aktuelle Konfiguration in eine neues Verzeichnis-Bind kopieren",
    "Delete the current configuration" : "Aktuelle Konfiguration löschen",
    "Host" : "Host",
    "You can omit the protocol, except you require SSL. Then start with ldaps://" : "Du kannst das Protokoll auslassen, außer wenn Du SSL benötigst. Beginne dann mit ldaps://",
    "Port" : "Port",
    "Detect Port" : "Port ermitteln",
    "User DN" : "Benutzer-DN",
    "The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." : "Der DN des Benutzers, mit dem der LDAP-Bind durchgeführt werden soll, z.B. uid=agent,dc=example,dc=com. Für anonymen Zugriff lasse DN und Passwort leer.",
    "Password" : "Passwort",
    "For anonymous access, leave DN and Password empty." : "Lasse die Felder DN und Passwort für anonymen Zugang leer.",
    "One Base DN per line" : "Einen Basis-DN pro Zeile",
    "You can specify Base DN for users and groups in the Advanced tab" : "Du kannst die Base DN für Benutzer und Gruppen im Reiter „Fortgeschritten“ angeben",
    "Detect Base DN" : "Base DN ermitteln",
    "Test Base DN" : "Base DN testen",
    "Avoids automatic LDAP requests. Better for bigger setups, but requires some LDAP knowledge." : "Verhindert automatische LDAP-Anfragen. Besser geeignet für größere Installationen, benötigt aber erweiterte LDAP-Kenntnisse.",
    "Manually enter LDAP filters (recommended for large directories)" : "LDAP-Filter manuell eingeben (empfohlen für große Verzeichnisse)",
    "Limit %s access to users meeting these criteria:" : "Den %s-Zugriff auf Benutzer, die den folgenden Kriterien entsprechen, beschränken:",
    "The most common object classes for users are organizationalPerson, person, user, and inetOrgPerson. If you are not sure which object class to select, please consult your directory admin." : "Die häufigsten Objektklassen für Benutzer sind organizationalPerson, person, user und inetOrgPerson. Wenn Sie nicht sicher, welche Objektklasse Sie wählen sollen, fragen Sie bitte Ihren Verzeichnis-Admin.",
    "The filter specifies which LDAP users shall have access to the %s instance." : "Der Filter gibt an, welche LDAP-Benutzer Zugriff auf die %s-Instanz haben sollen.",
    "Verify settings and count users" : "Einstellungen überprüfen und Benutzer zählen",
    "Saving" : "Speichern",
    "Back" : "Zurück",
    "Continue" : "Fortsetzen",
    "LDAP" : "LDAP",
    "Expert" : "Experte",
    "Advanced" : "Fortgeschritten",
    "<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." : "<b>Warnung:</b> Die Anwendungen user_ldap und user_webdavauth sind inkompatibel. Es kann deshalb zu unerwartetem Systemverhalten kommen. Bitte kontaktiere Deinen Systemadministator und bitte um die Deaktivierung einer der beiden Anwendungen.",
    "<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." : "<b>Warnung:</b> Da das PHP-Modul für LDAP nicht installiert ist, wird das Backend nicht funktionieren. Bitte kontaktiere Deinen Systemadministrator und bitte um die Installation des Moduls.",
    "Connection Settings" : "Verbindungseinstellungen",
    "Configuration Active" : "Konfiguration aktiv",
    "When unchecked, this configuration will be skipped." : "Konfiguration wird übersprungen wenn deaktiviert",
    "Backup (Replica) Host" : "Backup-Host (Kopie)",
    "Give an optional backup host. It must be a replica of the main LDAP/AD server." : "Gib einen optionalen Backup-Host an. Es muss sich um eine Kopie des Haupt-LDAP/AD-Servers handeln.",
    "Backup (Replica) Port" : "Port des Backup-Hosts (Kopie)",
    "Disable Main Server" : "Hauptserver deaktivieren",
    "Only connect to the replica server." : "Nur zum Replikat-Server verbinden.",
    "Turn off SSL certificate validation." : "Schalte die SSL-Zertifikatsprüfung aus.",
    "Not recommended, use it for testing only! If connection only works with this option, import the LDAP server's SSL certificate in your %s server." : "Nur für Testzwecke geeignet, sollte Standardmäßig nicht verwendet werden. Falls die Verbindung nur mit dieser Option funktioniert, importiere das SSL-Zertifikat des LDAP-Servers in deinen %s Server.",
    "Cache Time-To-Live" : "Speichere Time-To-Live zwischen",
    "in seconds. A change empties the cache." : "in Sekunden. Eine Änderung leert den Cache.",
    "Directory Settings" : "Ordnereinstellungen",
    "User Display Name Field" : "Feld für den Anzeigenamen des Benutzers",
    "The LDAP attribute to use to generate the user's display name." : "Das LDAP-Attribut zur Generierung des Anzeigenamens des Benutzers.",
    "Base User Tree" : "Basis-Benutzerbaum",
    "One User Base DN per line" : "Ein Benutzer Basis-DN pro Zeile",
    "User Search Attributes" : "Benutzersucheigenschaften",
    "Optional; one attribute per line" : "Optional; ein Attribut pro Zeile",
    "Group Display Name Field" : "Feld für den Anzeigenamen der Gruppe",
    "The LDAP attribute to use to generate the groups's display name." : "Das LDAP-Attribut zur Generierung des Anzeigenamens der Gruppen.",
    "Base Group Tree" : "Basis-Gruppenbaum",
    "One Group Base DN per line" : "Ein Gruppen Basis-DN pro Zeile",
    "Group Search Attributes" : "Gruppensucheigenschaften",
    "Group-Member association" : "Assoziation zwischen Gruppe und Benutzer",
    "Nested Groups" : "Eingebundene Gruppen",
    "When switched on, groups that contain groups are supported. (Only works if the group member attribute contains DNs.)" : "Wenn aktiviert, werden Gruppen, die Gruppen enthalten, unterstützt. (Funktioniert nur, wenn das Merkmal des Gruppenmitgliedes den Domain-Namen enthält.)",
    "Paging chunksize" : "Seitenstücke (Paging chunksize)",
    "Chunksize used for paged LDAP searches that may return bulky results like user or group enumeration. (Setting it 0 disables paged LDAP searches in those situations.)" : "Abschnittslänge von seitenweise angezeigten LDAP-Suchen, die bei Suchen wie etwa Benutzer- und Gruppen-Auflistungen ausufernd viele Ergebnisse liefern können (die Einstellung „0“ deaktiviert seitenweise angezeigte LDAP-Suchen in diesen Situationen).",
    "Special Attributes" : "Spezielle Eigenschaften",
    "Quota Field" : "Kontingent Feld",
    "Quota Default" : "Standard Kontingent",
    "in bytes" : "in Bytes",
    "Email Field" : "E-Mail-Feld",
    "User Home Folder Naming Rule" : "Benennungsregel für das Home-Verzeichnis des Benutzers",
    "Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." : "Ohne Eingabe wird der Benutzername (Standard) verwendet. Anderenfall trage ein LDAP/AD-Attribut ein.",
    "Internal Username" : "Interner Benutzername",
    "By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder. It is also a part of remote URLs, for instance for all *DAV services. With this setting, the default behavior can be overridden. To achieve a similar behavior as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users." : "Standardmäßig wird der interne Benutzername mittels des UUID-Attributes erzeugt. Dies stellt sicher, dass der Benutzername einzigartig ist und keinerlei Zeichen konvertiert werden müssen. Der interne Benutzername unterliegt Beschränkungen, die nur die nachfolgenden Zeichen erlauben: [ a-zA-Z0-9_.@- ]. Andere Zeichen werden mittels ihrer korrespondierenden Zeichen ersetzt oder einfach ausgelassen. Bei Kollisionen wird ein Zähler hinzugefügt bzw. der Zähler um einen Wert erhöht. Der interne Benutzername wird benutzt, um einen Benutzer intern zu identifizieren. Es ist ebenso der standardmäßig vorausgewählte Namen des Heimatverzeichnisses. Es ist auch ein Teil der Remote-URLs - zum Beispiel für alle *DAV-Dienste. Mit dieser Einstellung kann das Standardverhalten überschrieben werden. Um ein ähnliches Verhalten wie vor ownCloud 5 zu erzielen, fügen Sie das anzuzeigende Attribut des Benutzernamens in das nachfolgende Feld ein. Lassen Sie dies hingegen für das Standardverhalten leer. Die Änderungen werden sich nur auf neu gemappte (hinzugefügte) LDAP-Benutzer auswirken.",
    "Internal Username Attribute:" : "Attribut für interne Benutzernamen:",
    "Override UUID detection" : "UUID-Erkennung überschreiben",
    "By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." : "Standardmäßig wird die UUID-Eigenschaft automatisch erkannt. Die UUID-Eigenschaft wird genutzt, um einen LDAP-Benutzer und Gruppen einwandfrei zu identifizieren. Außerdem wird der interne Benutzername erzeugt, der auf Eigenschaften der UUID basiert, wenn es oben nicht anders angegeben wurde. Du musst allerdings sicherstellen, dass deine gewählten Eigenschaften zur Identifikation der Benutzer und Gruppen eindeutig sind und zugeordnet werden können. Lasse es frei, um es beim Standardverhalten zu belassen. Änderungen wirken sich nur auf neu gemappte (hinzugefügte) LDAP-Benutzer und -Gruppen aus.",
    "UUID Attribute for Users:" : "UUID-Attribute für Benutzer:",
    "UUID Attribute for Groups:" : "UUID-Attribute für Gruppen:",
    "Username-LDAP User Mapping" : "LDAP-Benutzernamenzuordnung",
    "Usernames are used to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have an internal username. This requires a mapping from username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found. The internal username is used all over. Clearing the mappings will have leftovers everywhere. Clearing the mappings is not configuration sensitive, it affects all LDAP configurations! Never clear the mappings in a production environment, only in a testing or experimental stage." : "Die Benutzernamen werden genutzt, um (Meta)Daten zuzuordnen und zu speichern. Um Benutzer eindeutig und präzise zu identifizieren, hat jeder LDAP-Benutzer einen internen Benutzernamen. Dies erfordert eine Zuordnung (mappen) von Benutzernamen zum LDAP-Benutzer. Der erstellte Benutzername wird der UUID des LDAP-Benutzernamens zugeordnet. Zusätzlich wird der DN zwischengespeichert, um die Interaktion mit dem LDAP zu minimieren, was aber nicht der Identifikation dient. Ändert sich der DN, werden die Änderungen durch gefunden. Der interne Benutzername, wird in überall verwendet. Werden die Zuordnungen gelöscht, bleiben überall Reste zurück. Die Löschung der Zuordnungen kann nicht in der Konfiguration vorgenommen werden, beeinflusst aber die LDAP-Konfiguration! Löschen Sie niemals die Zuordnungen in einer produktiven Umgebung. Lösche die Zuordnungen nur in einer Test- oder Experimentierumgebung.",
    "Clear Username-LDAP User Mapping" : "LDAP-Benutzernamenzuordnung löschen",
    "Clear Groupname-LDAP Group Mapping" : "LDAP-Gruppennamenzuordnung löschen"
},
"nplurals=2; plural=(n != 1);");
