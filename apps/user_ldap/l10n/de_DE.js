OC.L10N.register(
    "user_ldap",
    {
    "Failed to clear the mappings." : "Löschen der Zuordnungen fehlgeschlagen.",
    "Failed to delete the server configuration" : "Löschen der Serverkonfiguration fehlgeschlagen",
    "Invalid configuration: Anonymous binding is not allowed." : "Die Konfiguration ist ungültig: anonymes Binden ist nicht erlaubt. ",
    "Valid configuration, connection established!" : "Gültige Konfiguration, Verbindung hergestellt!",
    "Valid configuration, but binding failed. Please check the server settings and credentials." : "Die Konfiguration ist gültig, aber der LDAP-Bind ist fehlgeschlagen. Bitte überprüfen Sie die Servereinstellungen und die Anmeldeinformationen. ",
    "Invalid configuration. Please have a look at the logs for further details." : "Die Konfiguration ist ungültig. Weitere Details finden Sie in den Logdateien. ",
    "No action specified" : "Keine Aktion angegeben",
    "No configuration specified" : "Keine Konfiguration angegeben",
    "No data specified" : "Keine Daten angegeben",
    " Could not set configuration %s" : "Die Konfiguration %s konnte nicht gesetzt werden",
    "Action does not exist" : "Aktion existiert nicht",
    "LDAP user and group backend" : "LDAP Benutzer- und Gruppen-Backend",
    "Renewing …" : "Erneuere …",
    "Very weak password" : "Sehr schwaches Passwort",
    "Weak password" : "Schwaches Passwort",
    "So-so password" : "Passables Passwort",
    "Good password" : "Gutes Passwort",
    "Strong password" : "Starkes Passwort",
    "The Base DN appears to be wrong" : "Die Base-DN scheint falsch zu sein",
    "Testing configuration…" : "Teste Konfiguration",
    "Configuration incorrect" : "Konfiguration nicht korrekt",
    "Configuration incomplete" : "Konfiguration nicht vollständig",
    "Configuration OK" : "Konfiguration OK",
    "Select groups" : "Gruppen auswählen",
    "Select object classes" : "Objektklassen auswählen",
    "Please check the credentials, they seem to be wrong." : "Bitte überprüfen Sie die Anmeldeinformationen, sie sind anscheinend falsch.",
    "Please specify the port, it could not be auto-detected." : "Bitte geben Sie den Port an, er konnte nicht automatisch erkannt werden.",
    "Base DN could not be auto-detected, please revise credentials, host and port." : "Die Base DN konnte nicht automatisch erkannt werden, bitte überprüfen Sie Anmeldeinformationen, Host und Port.",
    "Could not detect Base DN, please enter it manually." : "Die Base DN konnte nicht erkannt werden, bitte geben Sie sie manuell ein.",
    "{nthServer}. Server" : "{nthServer}. - Server",
    "No object found in the given Base DN. Please revise." : "Keine Objekte in der angegebenen Base-DN gefunden, bitte überprüfen.",
    "More than 1,000 directory entries available." : "Es sind mehr als 1.000 Verzeichniseinträge verfügbar.",
    "_{objectsFound} entry available within the provided Base DN_::_{objectsFound} entries available within the provided Base DN_" : ["{objectsFound} Eintrag in der angegebenen Base DN verfügbar","{objectsFound} Einträge in der angegebenen Base DN verfügbar"],
    "An error occurred. Please check the Base DN, as well as connection settings and credentials." : "Es ist ein Fehler aufgetreten. Bitte überprüfen Sie die Base DN wie auch die Verbindungseinstellungen und Anmeldeinformationen.",
    "Do you really want to delete the current Server Configuration?" : "Soll die aktuelle Serverkonfiguration wirklich gelöscht werden?",
    "Confirm Deletion" : "Löschen bestätigen",
    "Mappings cleared successfully!" : "Zuordnungen erfolgreich gelöscht!",
    "Error while clearing the mappings." : "Fehler beim Löschen der Zuordnungen.",
    "Anonymous bind is not allowed. Please provide a User DN and Password." : "Anonymous Bind ist nicht erlaubt. Bitte geben Sie eine User-DN und ein Passwort angeben.",
    "LDAP Operations error. Anonymous bind might not be allowed." : "Fehler in den LDAP-Operationen. Anonymous Bind ist anscheinend nicht erlaubt.",
    "Saving failed. Please make sure the database is in Operation. Reload before continuing." : "Speichern fehlgeschlagen. Bitte stellen Sie sicher, dass die Datenbank in Betrieb ist. Bitte laden Sie vor dem Fortfahren neu.",
    "Switching the mode will enable automatic LDAP queries. Depending on your LDAP size they may take a while. Do you still want to switch the mode?" : "Das Umschalten des Modus ermöglicht automatische LDAP-Abfragen. Abhängig von Ihrer LDAP-Größe können diese einige Zeit in Anspruch nehmen. Wollen Sie immer noch den Modus wechseln?",
    "Mode switch" : "Modus umschalten",
    "Select attributes" : "Attribute auswählen",
    "User not found. Please check your login attributes and username. Effective filter (to copy-and-paste for command-line validation): <br/>" : "Benutzer nicht gefunden. Bitte überprüfen Sie Ihre Anmelde-Attribute und Benutzernamen. Wirksamer Filter (zum Kopieren und Einfügen bei der Überprüfung auf der Kommandozeile): <br/>",
    "User found and settings verified." : "Benutzer gefunden und Einstellungen überprüft.",
    "Consider narrowing your search, as it encompassed many users, only the first one of whom will be able to log in." : "Erwägen Sie, Ihre Suche einzugrenzen, da sie viele Benutzer umfaßte. Nur der erste wird sich anmelden können.",
    "An unspecified error occurred. Please check log and settings." : "Ein nicht näher spezifizierter Fehler ist aufgetreten. Bitte prüfe die Logdatei und Einstellungen.",
    "The search filter is invalid, probably due to syntax issues like uneven number of opened and closed brackets. Please revise." : "Der Suchfilter ist ungültig, möglicherweise bestehen Eingabefehler wie z.B. eine ungerade Anzahl von geöffneten und geschlossenen Klammern. Bitte überarbeiten.",
    "A connection error to LDAP / AD occurred, please check host, port and credentials." : "Es ist ein Verbindungsfehler zum LDAP/AD aufgetreten, bitte überprüfen Sie Host, Port und Anmeldeinformationen.",
    "The \"%uid\" placeholder is missing. It will be replaced with the login name when querying LDAP / AD." : "Der \"1 %u id\" Platzhalter fehlt. Er wird durch den Anmeldenamen ersetzt, wenn LDAP / AD abgefragt wird.",
    "Please provide a login name to test against" : "Bitte geben Sie einen Benutzernamen an, um gegen diesen zu testen",
    "The group box was disabled, because the LDAP / AD server does not support memberOf." : "Das Gruppenfeld wurde deaktiviert, da der LDAP / AD-Server memberOf nicht unterstützt.",
    "Password change rejected. Hint: " : "Passwortändertung verweigert. Hinweis:",
    "Please login with the new password" : "Bitte mit dem neuen Passwort anmelden",
    "Your password will expire tomorrow." : "Ihr Passwort läuft morgen ab",
    "Your password will expire today." : "Ihr Passwort läuft heute ab",
    "_Your password will expire within %n day._::_Your password will expire within %n days._" : ["Ihr Passwort läuft in %n Tage ab","Ihr Passwort läuft in %n Tagen ab"],
    "LDAP / AD integration" : "LDAP/AD-Integration",
    "_%s group found_::_%s groups found_" : ["%s Gruppe gefunden","%s Gruppen gefunden"],
    "_%s user found_::_%s users found_" : ["%s Benutzer gefunden","%s Benutzer gefunden"],
    "Could not detect user display name attribute. Please specify it yourself in advanced LDAP settings." : "Das Anzeigename-Attribut des Benutzers konnte nicht gefunden werden. Bitte geben Sie es selbst in den erweiterten LDAP-Einstellungen an.",
    "Could not find the desired feature" : "Die gewünschte Funktion konnte nicht gefunden werden",
    "Invalid Host" : "Ungültiger Host",
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
    "Verify settings and count the groups" : "Überprüfe die Einstellungen und zähle die Gruppen",
    "When logging in, %s will find the user based on the following attributes:" : "Beim Anmelden wird %s den Nutzer basierend auf folgenden Attributen finden:",
    "LDAP / AD Username:" : "LDAP-/AD-Benutzername:",
    "Allows login against the LDAP / AD username, which is either \"uid\" or \"sAMAccountName\" and will be detected." : "Erlaubt die Anmeldung gegen den LDAP/AD-Benutzernamen, der entweder \"uid\" oder \"sAMAccountName\" ist, und erkannt wird.",
    "LDAP / AD Email Address:" : "LDAP-/AD-E-Mail-Adresse:",
    "Allows login against an email attribute. \"mail\" and \"mailPrimaryAddress\" allowed." : "Erlaubt die Anmeldung gegen ein E-Mail-Attribut. \"mail\" und \"mailPrimaryAddress\" sind erlaubt.",
    "Other Attributes:" : "Andere Attribute:",
    "Defines the filter to apply, when login is attempted. \"%%uid\" replaces the username in the login action. Example: \"uid=%%uid\"" : "Bestimmt den Filter, welcher bei einer Anmeldung angewandt wird. \"%%uid\" ersetzt den Benutzernamen bei der Anmeldung. Beispiel: \"uid=%%uid\"",
    "Test Loginname" : "Anmeldenamen testen",
    "Verify settings" : "Einstellungen überprüfen",
    "1. Server" : "1. Server",
    "%s. Server:" : "%s. Server:",
    "Add a new configuration" : "Füge eine neue Konfiguration hinzu.",
    "Copy current configuration into new directory binding" : "Aktuelle Konfiguration in eine neues Verzeichnis-Bind kopieren ",
    "Delete the current configuration" : "Aktuelle Konfiguration löschen",
    "Host" : "Host",
    "You can omit the protocol, unless you require SSL. If so, start with ldaps://" : "Du kannst das Protokoll auslassen, wenn du nicht SSL benötigst. Dann starte mit ldaps://",
    "Port" : "Port",
    "Detect Port" : "Port ermitteln",
    "User DN" : "Benutzer-DN",
    "The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." : "Der DN des Benutzers, mit dem der LDAP-Bind durchgeführt werden soll, z.B. uid=agent,dc=example,dc=com. Für einen anonymen Zugriff lassen Sie DN und Passwort leer.",
    "Password" : "Passwort",
    "For anonymous access, leave DN and Password empty." : "Lassen Sie die Felder DN und Passwort für einen anonymen Zugang leer.",
    "Save Credentials" : "Zugangsdaten speichern",
    "One Base DN per line" : "Einen Basis-DN pro Zeile",
    "You can specify Base DN for users and groups in the Advanced tab" : " Sie können die Basis-DN für Benutzer und Gruppen im Reiter „Fortgeschritten“ angeben",
    "Detect Base DN" : "Base-DN ermitteln",
    "Test Base DN" : "Base DN testen",
    "Avoids automatic LDAP requests. Better for bigger setups, but requires some LDAP knowledge." : "Verhindert automatische LDAP-Anfragen. Besser geeignet für größere Installationen, benötigt aber erweiterte LDAP-Kenntnisse.",
    "Manually enter LDAP filters (recommended for large directories)" : "LDAP-Filter manuell eingeben (empfohlen für große Verzeichnisse)",
    "Listing and searching for users is constrained by these criteria:" : "Auflistung und Suche nach Nutzern ist eingeschränkt durch folgende Kriterien:",
    "The most common object classes for users are organizationalPerson, person, user, and inetOrgPerson. If you are not sure which object class to select, please consult your directory admin." : "Die häufigsten Objektklassen für Benutzer sind organizationalPerson, person, user und inetOrgPerson. Wenn Sie nicht sicher, welche Objektklasse Sie wählen sollen, fragen Sie bitte Ihren Verzeichnis-Admin.",
    "The filter specifies which LDAP users shall have access to the %s instance." : "Der Filter gibt an, welche LDAP-Benutzer Zugriff auf die %s-Instanz haben sollen.",
    "Verify settings and count users" : "Einstellungen überprüfen und Benutzer zählen",
    "Saving" : "Speichern",
    "Back" : "Zurück",
    "Continue" : "Fortsetzen",
    "Please renew your password." : "Bitte erneuern Sie Ihr Passwort",
    "An internal error occurred." : "Es ist ein interner Fehler aufgetreten.",
    "Please try again or contact your administrator." : "Bitte versuchen Sie es noch einmal oder kontaktieren Sie Ihren Administrator.",
    "Current password" : "Aktuelles Passwort",
    "New password" : "Neues Passwort",
    "Renew password" : "Bitte erneuern Sie Ihr Passwort",
    "Wrong password. Reset it?" : "Falsches Passwort. Soll es zurückgesetzt werden?",
    "Wrong password." : "Falsches Passwort.",
    "Cancel" : "Abbrechen",
    "Server" : "Server",
    "Users" : "Benutzer",
    "Login Attributes" : "Anmeldeattribute",
    "Groups" : "Gruppen",
    "Expert" : "Experte",
    "Advanced" : "Fortgeschritten",
    "<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." : "<b>Warnung:</b> Da das PHP-Modul für LDAP nicht installiert ist, wird das Backend nicht funktionieren. Bitte kontaktieren Sie Ihren Systemadministrator und bitten Sie um die Installation des Moduls.",
    "Connection Settings" : "Verbindungseinstellungen",
    "Configuration Active" : "Konfiguration aktiv",
    "When unchecked, this configuration will be skipped." : "Wenn nicht angehakt, wird diese Konfiguration übersprungen.",
    "Backup (Replica) Host" : "Backup-Host (Kopie)",
    "Give an optional backup host. It must be a replica of the main LDAP/AD server." : "Geben Sie einen optionalen Backup-Host an. Es muss sich um eine Kopie des Haupt-LDAP/AD-Servers handeln.",
    "Backup (Replica) Port" : "Port des Backup-Hosts (Kopie)",
    "Disable Main Server" : "Hauptserver deaktivieren",
    "Only connect to the replica server." : "Nur zum Replikat-Server verbinden.",
    "Turn off SSL certificate validation." : "Schalten Sie die SSL-Zertifikatsprüfung aus.",
    "Not recommended, use it for testing only! If connection only works with this option, import the LDAP server's SSL certificate in your %s server." : "Nur für Testzwecke geeignet, sollte Standardmäßig nicht verwendet werden. Falls die Verbindung nur mit dieser Option funktioniert, importieren Sie das SSL-Zertifikat des LDAP-Servers in Ihren %s Server.",
    "Cache Time-To-Live" : "Speichere Time-To-Live zwischen",
    "in seconds. A change empties the cache." : "in Sekunden. Eine Änderung leert den Cache.",
    "Directory Settings" : "Ordnereinstellungen",
    "User Display Name Field" : "Feld für den Anzeigenamen des Benutzers",
    "The LDAP attribute to use to generate the user's display name." : "Das LDAP-Attribut zur Erzeugung des Anzeigenamens des Benutzers.",
    "2nd User Display Name Field" : "2. Benutzeranzeigename Feld",
    "Optional. An LDAP attribute to be added to the display name in brackets. Results in e.g. »John Doe (john.doe@example.org)«." : "Optional. Ein hinzuzufügendes LDAP-Attribut um den Namen in Klammern anzuzeigen. Beispiel: »John Doe (john.doe@example.org)«.",
    "Base User Tree" : "Basis-Benutzerbaum",
    "One User Base DN per line" : "Ein Benutzer Basis-DN pro Zeile",
    "User Search Attributes" : "Benutzersucheigenschaften",
    "Optional; one attribute per line" : "Optional; ein Attribut pro Zeile",
    "Group Display Name Field" : "Feld für den Anzeigenamen der Gruppe",
    "The LDAP attribute to use to generate the groups's display name." : "Das LDAP-Attribut zur Erzeugung des Anzeigenamens der Gruppen.",
    "Base Group Tree" : "Basis-Gruppenbaum",
    "One Group Base DN per line" : "Ein Gruppen Basis-DN pro Zeile",
    "Group Search Attributes" : "Gruppensucheigenschaften",
    "Group-Member association" : "Assoziation zwischen Gruppe und Benutzer",
    "Dynamic Group Member URL" : "Dynamische Gruppenmitglied URL",
    "The LDAP attribute that on group objects contains an LDAP search URL that determines what objects belong to the group. (An empty setting disables dynamic group membership functionality.)" : "Ein LDAP-Attribut von Gruppenobjekten, das eine LDAP Such-URL enthält die festlegt welche Objekte zu der Gruppe gehören. (Ein leeres Feld deaktiviert die Funktion \"Dynamisch Gruppenzugehörigkeit\".)",
    "Nested Groups" : "Eingebundene Gruppen",
    "When switched on, groups that contain groups are supported. (Only works if the group member attribute contains DNs.)" : "Wenn aktiviert, werden Gruppen, die Gruppen enthalten, unterstützt. (Funktioniert nur, wenn das Merkmal des Gruppenmitgliedes den Domain-Namen enthält.)",
    "Paging chunksize" : "Seitenstücke (Paging chunksize)",
    "Chunksize used for paged LDAP searches that may return bulky results like user or group enumeration. (Setting it 0 disables paged LDAP searches in those situations.)" : "Abschnittslänge von seitenweise angezeigten LDAP-Suchen, die bei Suchen wie etwa Benutzer- und Gruppen-Auflistungen ausufernd viele Ergebnisse liefern können (die Einstellung „0“ deaktiviert seitenweise angezeigte LDAP-Suchen in diesen Situationen).",
    "Enable LDAP password changes per user" : "LDAP-Passwortänderungen pro Nutzer aktivieren",
    "Allow LDAP users to change their password and allow Super Administrators and Group Administrators to change the password of their LDAP users. Only works when access control policies are configured accordingly on the LDAP server. As passwords are sent in plaintext to the LDAP server, transport encryption must be used and password hashing should be configured on the LDAP server." : "LDAP-Nutzern die Änderung ihrer Passwörter erlauben und Super-Administratoren sowie Gruppen-Administratoren die Passwortänderung ihrer LDAP-Nutzer erlauben. \nDies funktioniert nur, wenn die Zugriffsrichtlinien auf dem LDAP-Server entsprechend konfiguriert sind. Da Passwörter im Klartext an den LDAP-Server gesendet werden, muss die Transportverschlüsselung verwendet werden und das Passwort-Hashing auf dem LDAP-Server sollte konfiguriert werden.",
    "(New password is sent as plain text to LDAP)" : "(Das neue Passwort wurde als einfacher Text an LDAP gesendet)",
    "Default password policy DN" : "Standard Passwort-Regeln DN",
    "The DN of a default password policy that will be used for password expiry handling. Works only when LDAP password changes per user are enabled and is only supported by OpenLDAP. Leave empty to disable password expiry handling." : "Die DN einer Standard-Passwort-Policy, welche für den Umgang mit ablaufenden Passwörtern verwendet wird. Dies funktioniert nur wenn Passwort-Änderungen pro Benutzer via LDAP aktiviert ist. Und funktioniert nur mit OpenLDAP. Lassen Sie dieses Feld leer um den Umgang mit ablaufenden Passwörtern zu deaktivieren.",
    "Special Attributes" : "Spezielle Eigenschaften",
    "Quota Field" : "Kontingent-Feld",
    "Leave empty for user's default quota. Otherwise, specify an LDAP/AD attribute." : "Ohne Eingabe wird das Standard-Kontingent des Benutzers verwendet. Andernfall trage ein LDAP/AD-Attribut ein.",
    "Quota Default" : "Standard-Kontingent",
    "Override default quota for LDAP users who do not have a quota set in the Quota Field." : "Standard-Kontingent ignorieren für Benutzer von LDAP, die kein Kontingent festgelegt haben.",
    "Email Field" : "E-Mail-Feld",
    "Set the user's email from their LDAP attribute. Leave it empty for default behaviour." : "E-Mail-Adresse des Benutzers aus seinem LDAP-Attribut generieren. Für Standard-Verhalten leer lassen.",
    "User Home Folder Naming Rule" : "Benennungsregel für das Home-Verzeichnis des Benutzers",
    "Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." : "Ohne Eingabe wird der Benutzername (Standard) verwendet. Anderenfalls tragen Sie bitte ein LDAP/AD-Attribut ein.",
    "Internal Username" : "Interner Benutzername",
    "By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder. It is also a part of remote URLs, for instance for all *DAV services. With this setting, the default behavior can be overridden. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users." : "Standardmäßig wird der interne Benutzername aus dem UUID-Atribut erstellt. So wird sichergestellt, dass der Benutzername einmalig ist und Zeichen nicht konvertiert werden müssen. Für den internen Benutzernamen sind nur folgende Zeichen zulässig:  [ a-zA-Z0-9_.@- ]. Andere Zeichen werden mit ihrer ASCII-Entsprechung ersetzt oder einfach weggelassen. Bei Kollisionen wird eine Nummer hinzugefügt/erhöht. Der interne Benutzername wird verwandt, um den Benutzer intern zu identifizieren. Er ist ausserdem der Standardname für den Stamm-Ordner des Benutzers. Darüber hinaus ist er Teil der URLs für den Zugriff, zum Bespiel für alle *DAV-Dienste. Mit dieser Einstellung, kann das Standardverhalten geändert werden. Für die Standardeinstellung, lassen Sie das Eingabefeld leer. Änderungen wirken sich nur auf neu eingetragene (hinzugefügte) LDAP-Benutzer aus.",
    "Internal Username Attribute:" : "Interne Eigenschaften des Benutzers:",
    "Override UUID detection" : "UUID-Erkennung überschreiben",
    "By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." : "Standardmäßig wird die UUID-Eigenschaft automatisch erkannt. Die UUID-Eigenschaft wird genutzt, um einen LDAP-Benutzer und Gruppen einwandfrei zu identifizieren. Außerdem wird der interne Benutzername erzeugt, der auf Eigenschaften der UUID basiert, wenn es oben nicht anders angegeben wurde. Sie müssen allerdings sicherstellen, dass Ihre gewählten Eigenschaften zur Identifikation der Benutzer und Gruppen eindeutig sind und zugeordnet werden können. Lassen Sie es frei, um es beim Standardverhalten zu belassen. Änderungen wirken sich nur auf neu gemappte (hinzugefügte) LDAP-Benutzer und -Gruppen aus.",
    "UUID Attribute for Users:" : "UUID-Attribute für Benutzer:",
    "UUID Attribute for Groups:" : "UUID-Attribute für Gruppen:",
    "Username-LDAP User Mapping" : "LDAP-Benutzernamenzuordnung",
    "Usernames are used to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have an internal username. This requires a mapping from username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found. The internal username is used all over. Clearing the mappings will have leftovers everywhere. Clearing the mappings is not configuration sensitive, it affects all LDAP configurations! Never clear the mappings in a production environment, only in a testing or experimental stage." : "Benutzernamen dienen zum Speichern und Zuweisen von (Meta-)Daten. Um Benutzer eindeutig zu identifizieren und zu erkennen, besitzt jeder LDAP-Benutzer einen internen Benutzernamen. Dies erfordert eine Zuordnung des jeweiligen Benutzernamens zum LDAP-Benutzer. Der erstellte Benutzername wird der UUID des LDAP-Benutzers zugeordnet. Darüber hinaus wird der DN auch zwischengespeichert, um die Interaktion über LDAP zu reduzieren, was aber nicht zur Identifikation dient. Ändert sich der DN, werden die Änderungen gefunden. Der interne Benutzername wird durchgängig verwendet. Ein Löschen der Zuordnungen führt zum systemweiten Verbleib von Restdaten. Es bleibt nicht auf eine einzelne Konfiguration beschränkt, sondern wirkt sich auf alle LDAP-Konfigurationen aus! Löschen Sie die Zuordnungen nie innerhalb einer Produktivumgebung, sondern nur in einer Test- oder Experimentierumgebung.",
    "Clear Username-LDAP User Mapping" : "Lösche LDAP-Benutzernamenzuordnung",
    "Clear Groupname-LDAP Group Mapping" : "Lösche LDAP-Gruppennamenzuordnung",
    " entries available within the provided Base DN" : "Einträge in der angegebenen Base DN verfügbar",
    "LDAP" : "LDAP",
    "<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." : "<b>Warnung:</b> Die Anwendungen user_ldap und user_webdavauth sind inkompatibel. Es kann deshalb zu unerwartetem Systemverhalten kommen. Bitte kontaktieren Sie Ihren Systemadministator und bitten Sie um die Deaktivierung einer der beiden Anwendungen."
},
"nplurals=2; plural=(n != 1);");
