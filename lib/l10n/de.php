<?php
$TRANSLATIONS = array(
"Cannot write into \"config\" directory!" => "Das Schreiben in das \"config\"-Verzeichnis nicht möglich!",
"This can usually be fixed by giving the webserver write access to the config directory" => "Dies kann normalerweise repariert werden, indem dem Webserver Schreibzugriff auf das config-Verzeichnis gegeben wird",
"See %s" => "Siehe %s",
"This can usually be fixed by %sgiving the webserver write access to the config directory%s." => "Dies kann normalerweise repariert werden, indem dem Webserver %s Schreibzugriff auf das config-Verzeichnis %s gegeben wird.",
"Sample configuration detected" => "Beispielkonfiguration gefunden",
"It has been detected that the sample configuration has been copied. This can break your installation and is unsupported. Please read the documentation before performing changes on config.php" => "Es wurde festgestellt, dass die Beispielkonfiguration kopiert wurde, Dies wird nicht unterstützt kann zum Abruch Ihrer Installation führen. Bitte lese die Dokumentation vor der Änderung an der config.php.",
"You are accessing the server from an untrusted domain." => "Du greifst von einer nicht vertrauenswürdigen Domain auf den Server zu.",
"Please contact your administrator. If you are an administrator of this instance, configure the \"trusted_domain\" setting in config/config.php. An example configuration is provided in config/config.sample.php." => "Bitte kontaktiere Deinen Administrator. Wenn du aktuell Administrator dieser Instanz bist, konfiguriere bitte die \"trusted_domain\" - Einstellung in config/config.php. Eine Beispielkonfiguration wird unter config/config.sample.php bereit gestellt.",
"Help" => "Hilfe",
"Personal" => "Persönlich",
"Settings" => "Einstellungen",
"Users" => "Benutzer",
"Admin" => "Administration",
"App \\\"%s\\\" can't be installed because it is not compatible with this version of ownCloud." => "Applikation \\\"%s\\\" kann nicht installiert werden, da sie mit dieser ownCloud Version nicht kompatibel ist.",
"No app name specified" => "Es wurde kein Applikation-Name angegeben",
"Unknown filetype" => "Unbekannter Dateityp",
"Invalid image" => "Ungültiges Bild",
"web services under your control" => "Web-Services unter Deiner Kontrolle",
"App directory already exists" => "Das Applikationsverzeichnis existiert bereits",
"Can't create app folder. Please fix permissions. %s" => "Es kann kein Applikationsordner erstellt werden. Bitte passe die  Berechtigungen an. %s",
"No source specified when installing app" => "Für die Installation der Applikation wurde keine Quelle angegeben",
"No href specified when installing app from http" => "Für die Installation der Applikation über http wurde keine Quelle (href) angegeben",
"No path specified when installing app from local file" => "Bei der Installation der Applikation aus einer lokalen Datei wurde kein Pfad angegeben",
"Archives of type %s are not supported" => "Archive vom Typ %s werden nicht unterstützt",
"Failed to open archive when installing app" => "Das Archiv konnte bei der Installation der Applikation nicht geöffnet werden",
"App does not provide an info.xml file" => "Die Applikation enthält keine info,xml Datei",
"App can't be installed because of not allowed code in the App" => "Die Applikation kann auf Grund von unerlaubtem Code nicht installiert werden",
"App can't be installed because it is not compatible with this version of ownCloud" => "Die Anwendung konnte nicht installiert werden, weil Sie nicht mit dieser Version von ownCloud kompatibel ist.",
"App can't be installed because it contains the <shipped>true</shipped> tag which is not allowed for non shipped apps" => "Die Applikation konnte nicht installiert werden, da diese das <shipped>true</shipped> Tag beinhaltet und dieses, bei nicht mitausgelieferten Applikationen, nicht erlaubt ist",
"App can't be installed because the version in info.xml/version is not the same as the version reported from the app store" => "Die Applikation konnte nicht installiert werden, da die Version in der info.xml nicht die gleiche Version wie im App-Store ist",
"Application is not enabled" => "Die Anwendung ist nicht aktiviert",
"Authentication error" => "Fehler bei der Anmeldung",
"Token expired. Please reload page." => "Token abgelaufen. Bitte lade die Seite neu.",
"Unknown user" => "Unbekannter Benutzer",
"%s enter the database username." => "%s gib den Datenbank-Benutzernamen an.",
"%s enter the database name." => "%s gib den Datenbank-Namen an.",
"%s you may not use dots in the database name" => "%s Der Datenbank-Name darf keine Punkte enthalten",
"MS SQL username and/or password not valid: %s" => "MS SQL Benutzername und/oder Password ungültig: %s",
"You need to enter either an existing account or the administrator." => "Du musst entweder ein existierendes Benutzerkonto oder das Administratoren-Konto angeben.",
"MySQL/MariaDB username and/or password not valid" => "MySQL/MariaDB Benutzername und/oder Passwort sind nicht gültig",
"DB Error: \"%s\"" => "DB Fehler: \"%s\"",
"Offending command was: \"%s\"" => "Fehlerhafter Befehl war: \"%s\"",
"MySQL/MariaDB user '%s'@'localhost' exists already." => "MySQL/MariaDB Benutzer '%s'@'localhost' existiert bereits.",
"Drop this user from MySQL/MariaDB" => "Lösche diesen Benutzer von MySQL/MariaDB",
"MySQL/MariaDB user '%s'@'%%' already exists" => "MySQL/MariaDB Benutzer '%s'@'%%' existiert bereits",
"Drop this user from MySQL/MariaDB." => "Lösche diesen Benutzer von MySQL/MariaDB.",
"Oracle connection could not be established" => "Es konnte keine Verbindung zur Oracle-Datenbank hergestellt werden",
"Oracle username and/or password not valid" => "Oracle Benutzername und/oder Passwort ungültig",
"Offending command was: \"%s\", name: %s, password: %s" => "Fehlerhafter Befehl war: \"%s\", Name: %s, Passwort: %s",
"PostgreSQL username and/or password not valid" => "PostgreSQL Benutzername und/oder Passwort ungültig",
"Set an admin username." => "Setze Administrator Benutzername.",
"Set an admin password." => "Setze Administrator Passwort",
"Your web server is not yet properly setup to allow files synchronization because the WebDAV interface seems to be broken." => "Dein Web-Server ist noch nicht für Datei-Synchronisation bereit, weil die WebDAV-Schnittstelle vermutlich defekt ist.",
"Please double check the <a href='%s'>installation guides</a>." => "Bitte prüfe die <a href='%s'>Installationsanleitungen</a>.",
"%s shared »%s« with you" => "%s teilte »%s« mit Dir",
"Sharing %s failed, because the file does not exist" => "Freigabe von %s fehlgeschlagen, da die Datei nicht existiert",
"You are not allowed to share %s" => "Die Freigabe von %s ist Dir nicht erlaubt",
"Sharing %s failed, because the user %s is the item owner" => "Freigabe von %s fehlgeschlagen, da der Nutzer %s Besitzer des Objektes ist",
"Sharing %s failed, because the user %s does not exist" => "Freigabe von %s fehlgeschlagen, da der Nutzer %s nicht existiert",
"Sharing %s failed, because the user %s is not a member of any groups that %s is a member of" => "Freigabe von %s fehlgeschlagen, da der Nutzer %s kein Gruppenmitglied einer der Gruppen von %s ist",
"Sharing %s failed, because this item is already shared with %s" => "Freigabe von %s fehlgeschlagen, da dieses Objekt schon mit %s geteilt wird",
"Sharing %s failed, because the group %s does not exist" => "Freigabe von %s fehlgeschlagen, da die Gruppe %s nicht existiert",
"Sharing %s failed, because %s is not a member of the group %s" => "Freigabe von %s fehlgeschlagen, da %s kein Mitglied der Gruppe %s ist",
"You need to provide a password to create a public link, only protected links are allowed" => "Es sind nur geschützte Links zulässig, daher müssen Sie ein Passwort angeben, um einen öffentlichen Link zu generieren",
"Sharing %s failed, because sharing with links is not allowed" => "Freigabe von %s fehlgeschlagen, da das Teilen von Verknüpfungen nicht erlaubt ist",
"Share type %s is not valid for %s" => "Freigabetyp %s ist nicht gültig für %s",
"Setting permissions for %s failed, because the permissions exceed permissions granted to %s" => "Das Setzen der Berechtigungen für %s ist fehlgeschlagen, da die Berechtigungen, die erteilten Berechtigungen %s überschreiten",
"Setting permissions for %s failed, because the item was not found" => "Das Setzen der Berechtigungen für %s ist fehlgeschlagen, da das Objekt nicht gefunden wurde",
"Cannot set expiration date. Shares cannot expire later than %s after they have been shared" => "Ablaufdatum kann nicht gesetzt werden. Freigaben können nach dem Teilen, nicht länger als %s gültig sein.",
"Cannot set expiration date. Expiration date is in the past" => "Ablaufdatum kann nicht gesetzt werden. Ablaufdatum liegt in der Vergangenheit.",
"Sharing backend %s must implement the interface OCP\\Share_Backend" => "Freigabe-Backend %s muss in der OCP\\Share_Backend - Schnittstelle implementiert werden",
"Sharing backend %s not found" => "Freigabe-Backend %s nicht gefunden",
"Sharing backend for %s not found" => "Freigabe-Backend für %s nicht gefunden",
"Sharing %s failed, because the user %s is the original sharer" => "Freigabe von %s fehlgeschlagen, da der Nutzer %s der offizielle Freigeber ist",
"Sharing %s failed, because the permissions exceed permissions granted to %s" => "Freigabe von %s fehlgeschlagen, da die Berechtigungen die erteilten Berechtigungen %s überschreiten",
"Sharing %s failed, because resharing is not allowed" => "Freigabe von %s fehlgeschlagen, da das nochmalige Freigeben einer Freigabe nicht erlaubt ist",
"Sharing %s failed, because the sharing backend for %s could not find its source" => "Freigabe von %s fehlgeschlagen, da das Freigabe-Backend für %s nicht in dieser Quelle gefunden werden konnte",
"Sharing %s failed, because the file could not be found in the file cache" => "Freigabe von %s fehlgeschlagen, da die Datei im Datei-Cache nicht gefunden werden konnte",
"Could not find category \"%s\"" => "Die Kategorie \"%s\" konnte nicht gefunden werden.",
"seconds ago" => "Gerade eben",
"_%n minute ago_::_%n minutes ago_" => array("Vor %n Minute","Vor %n Minuten"),
"_%n hour ago_::_%n hours ago_" => array("Vor %n Stunde","Vor %n Stunden"),
"today" => "Heute",
"yesterday" => "Gestern",
"_%n day go_::_%n days ago_" => array("Vor %n Tag","Vor %n Tagen"),
"last month" => "Letzten Monat",
"_%n month ago_::_%n months ago_" => array("Vor %n Monat","Vor %n Monaten"),
"last year" => "Letztes Jahr",
"years ago" => "Vor Jahren",
"Only the following characters are allowed in a username: \"a-z\", \"A-Z\", \"0-9\", and \"_.@-\"" => "Folgende Zeichen sind im Benutzernamen erlaubt: \"a-z\", \"A-Z\", \"0-9\" und \"_.@-\"",
"A valid username must be provided" => "Es muss ein gültiger Benutzername angegeben werden",
"A valid password must be provided" => "Es muss ein gültiges Passwort angegeben werden",
"The username is already being used" => "Dieser Benutzername existiert bereits",
"No database drivers (sqlite, mysql, or postgresql) installed." => "Keine Datenbanktreiber (SQLite, MYSQL, oder PostgreSQL) installiert.",
"Permissions can usually be fixed by %sgiving the webserver write access to the root directory%s." => "Berechtigungen können normalerweise repariert werden, indem dem Webserver %s Schreibzugriff auf das Wurzelverzeichnis %s gegeben wird.",
"Cannot write into \"config\" directory" => "Das Schreiben in das \"config\"-Verzeichnis nicht möglich",
"Cannot write into \"apps\" directory" => "Das Schreiben in das \"apps\"-Verzeichnis nicht möglich",
"This can usually be fixed by %sgiving the webserver write access to the apps directory%s or disabling the appstore in the config file." => "Dies kann normalerweise repariert werden, indem dem Webserver %s Schreibzugriff auf das Anwendungsverzeichnis %s gegeben wird oder die Anwendungsauswahl in der Konfigurationsdatei deaktiviert wird.",
"Cannot create \"data\" directory (%s)" => "Das Erstellen des \"data\"-Verzeichnisses nicht möglich (%s)",
"This can usually be fixed by <a href=\"%s\" target=\"_blank\">giving the webserver write access to the root directory</a>." => "Dies kann normalerweise repariert werden, indem dem Webserver <a href=\"%s\" target=\"_blank\" Schreibzugriff auf das Wurzelverzeichnis gegeben wird</a>.",
"Setting locale to %s failed" => "Das Setzen der Umgebungslokale auf %s fehlgeschlagen",
"Please install one of these locales on your system and restart your webserver." => "Bitte installiere eine dieser Sprachen auf Deinem System und starte den Webserver neu.",
"Please ask your server administrator to install the module." => "Bitte frage, für die Installation des Moduls, Deinen Server-Administrator.",
"PHP module %s not installed." => "PHP-Modul %s nicht installiert.",
"PHP %s or higher is required." => "PHP %s oder höher wird benötigt.",
"Please ask your server administrator to update PHP to the latest version. Your PHP version is no longer supported by ownCloud and the PHP community." => "Bitte frage zur Aktualisierung von PHP auf die letzte Version Deinen Server-Administrator. Deine PHP-Version wird nicht länger durch ownCloud und der PHP-Gemeinschaft unterstützt.",
"PHP Safe Mode is enabled. ownCloud requires that it is disabled to work properly." => "PHP-Sicherheitsmodus ist aktiviert. ownCloud benötigt für eine korrekte Funktion eine Deaktivierung von diesem Modus.",
"PHP Safe Mode is a deprecated and mostly useless setting that should be disabled. Please ask your server administrator to disable it in php.ini or in your webserver config." => "Der PHP-Sicherheitsmodus ist eine veraltete und meist nutzlose Einstellung, die deaktiviert  werden sollte. Bitte frage Deinen Server-Administrator zur Deaktivierung in der php.ini oder Deiner Webserver-Konfiguration.",
"Magic Quotes is enabled. ownCloud requires that it is disabled to work properly." => "Magic Quotes ist aktiviert. ownCloud benötigt für eine korrekte Funktion eine Deaktivierung von diesem Modus.",
"Magic Quotes is a deprecated and mostly useless setting that should be disabled. Please ask your server administrator to disable it in php.ini or in your webserver config." => "Magic Quotes ist eine veraltete und meist nutzlose Einstellung, die deaktiviert  werden sollte. Bitte frage Deinen Server-Administrator zur Deaktivierung in der php.ini oder Deiner Webserver-Konfiguration.",
"PHP modules have been installed, but they are still listed as missing?" => "PHP-Module wurden installiert, werden aber als noch fehlend gelistet?",
"Please ask your server administrator to restart the web server." => "Bitte frage Deinen Server-Administrator zum Neustart des Webservers.",
"PostgreSQL >= 9 required" => "PostgreSQL >= 9 benötigt",
"Please upgrade your database version" => "Bitte aktualisiere Deine Datenbankversion",
"Error occurred while checking PostgreSQL version" => "Es ist ein Fehler beim Prüfen der PostgreSQL-Version aufgetreten",
"Please make sure you have PostgreSQL >= 9 or check the logs for more information about the error" => "Stelle bitte sicher, dass Du PostgreSQL >= 9 verwendest oder prüfe die Logs für weitere Informationen über den Fehler",
"Please change the permissions to 0770 so that the directory cannot be listed by other users." => "Bitte ändere die Berechtigungen auf 0770 sodass das Verzeichnis nicht von anderen Nutzer angezeigt werden kann.",
"Data directory (%s) is readable by other users" => "Daten-Verzeichnis (%s) ist von anderen Nutzern lesbar",
"Data directory (%s) is invalid" => "Daten-Verzeichnis (%s) ist ungültig",
"Please check that the data directory contains a file \".ocdata\" in its root." => "Bitte stelle sicher, dass das Daten-Verzeichnis eine Datei namens \".ocdata\" im Wurzelverzeichnis enthält.",
"Could not obtain lock type %d on \"%s\"." => "Sperrtyp %d auf \"%s\" konnte nicht ermittelt werden."
);
$PLURAL_FORMS = "nplurals=2; plural=(n != 1);";
