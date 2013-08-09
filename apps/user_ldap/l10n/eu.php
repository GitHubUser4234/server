<?php
$TRANSLATIONS = array(
"Failed to delete the server configuration" => "Zerbitzariaren konfigurazioa ezabatzeak huts egin du",
"The configuration is valid and the connection could be established!" => "Konfigurazioa egokia da eta konexioa ezarri daiteke!",
"The configuration is valid, but the Bind failed. Please check the server settings and credentials." => "Konfigurazioa ongi dago, baina Bind-ek huts egin du. Mesedez egiaztatu zerbitzariaren ezarpenak eta kredentzialak.",
"The configuration is invalid. Please look in the ownCloud log for further details." => "Konfigurazioa ez dago ongi. Mesedez ikusi ownCloud-en egunerokoa informazio gehiago eskuratzeko.",
"Deletion failed" => "Ezabaketak huts egin du",
"Take over settings from recent server configuration?" => "oraintsuko zerbitzariaren konfigurazioaren ezarpenen ardura hartu?",
"Keep settings?" => "Mantendu ezarpenak?",
"Cannot add server configuration" => "Ezin da zerbitzariaren konfigurazioa gehitu",
"Success" => "Arrakasta",
"Error" => "Errorea",
"Connection test succeeded" => "Konexio froga ongi burutu da",
"Connection test failed" => "Konexio frogak huts egin du",
"Do you really want to delete the current Server Configuration?" => "Ziur zaude Zerbitzariaren Konfigurazioa ezabatu nahi duzula?",
"Confirm Deletion" => "Baieztatu Ezabatzea",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>Abisua:</b> PHPk behar duen LDAP modulua ez dago instalaturik, motorrak ez du funtzionatuko. Mesedez eskatu zure sistema kudeatzaileari instala dezan.",
"Server configuration" => "Zerbitzariaren konfigurazioa",
"Add Server Configuration" => "Gehitu Zerbitzariaren Konfigurazioa",
"Host" => "Hostalaria",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "Protokoloa ez da beharrezkoa, SSL behar baldin ez baduzu. Honela bada hasi ldaps://",
"Base DN" => "Oinarrizko DN",
"One Base DN per line" => "DN Oinarri bat lerroko",
"You can specify Base DN for users and groups in the Advanced tab" => "Erabiltzaile eta taldeentzako Oinarrizko DN zehaztu dezakezu Aurreratu fitxan",
"User DN" => "Erabiltzaile DN",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "Lotura egingo den bezero erabiltzailearen DNa, adb. uid=agent,dc=example,dc=com. Sarrera anonimoak gaitzeko utzi DN eta Pasahitza hutsik.",
"Password" => "Pasahitza",
"For anonymous access, leave DN and Password empty." => "Sarrera anonimoak gaitzeko utzi DN eta Pasahitza hutsik.",
"User Login Filter" => "Erabiltzaileen saioa hasteko iragazkia",
"Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action." => "Saioa hastean erabiliko den iragazkia zehazten du. %%uid-ek erabiltzaile izena ordezkatzen du saioa hasterakoan.",
"use %%uid placeholder, e.g. \"uid=%%uid\"" => "erabili %%uid txantiloia, adb. \"uid=%%uid\"",
"User List Filter" => "Erabiltzaile zerrendaren Iragazkia",
"Defines the filter to apply, when retrieving users." => "Erabiltzaileak jasotzen direnean ezarriko den iragazkia zehazten du.",
"without any placeholder, e.g. \"objectClass=person\"." => "txantiloirik gabe, adb. \"objectClass=person\".",
"Group Filter" => "Taldeen iragazkia",
"Defines the filter to apply, when retrieving groups." => "Taldeak jasotzen direnean ezarriko den iragazkia zehazten du.",
"without any placeholder, e.g. \"objectClass=posixGroup\"." => "txantiloirik gabe, adb. \"objectClass=posixGroup\".",
"Connection Settings" => "Konexio Ezarpenak",
"Configuration Active" => "Konfigurazio Aktiboa",
"When unchecked, this configuration will be skipped." => "Markatuta ez dagoenean, konfigurazio hau ez da kontutan hartuko.",
"Port" => "Portua",
"Backup (Replica) Host" => "Babeskopia (Replica) Ostalaria",
"Give an optional backup host. It must be a replica of the main LDAP/AD server." => "Eman babeskopia ostalari gehigarri bat. LDAP/AD zerbitzari nagusiaren replica bat izan behar da.",
"Backup (Replica) Port" => "Babeskopia (Replica) Ataka",
"Disable Main Server" => "Desgaitu Zerbitzari Nagusia",
"Use TLS" => "Erabili TLS",
"Do not use it additionally for LDAPS connections, it will fail." => "Ez erabili LDAPS konexioetarako, huts egingo du.",
"Case insensitve LDAP server (Windows)" => "Maiuskulak eta minuskulak ezberditzen ez dituen LDAP zerbitzaria (windows)",
"Turn off SSL certificate validation." => "Ezgaitu SSL ziurtagirien egiaztapena.",
"Not recommended, use for testing only." => "Ez da aholkatzen, erabili bakarrik frogak egiteko.",
"Cache Time-To-Live" => "Katxearen Bizi-Iraupena",
"in seconds. A change empties the cache." => "segundutan. Aldaketak katxea husten du.",
"Directory Settings" => "Karpetaren Ezarpenak",
"User Display Name Field" => "Erabiltzaileen bistaratzeko izena duen eremua",
"Base User Tree" => "Oinarrizko Erabiltzaile Zuhaitza",
"One User Base DN per line" => "Erabiltzaile DN Oinarri bat lerroko",
"User Search Attributes" => "Erabili Bilaketa Atributuak ",
"Optional; one attribute per line" => "Aukerakoa; atributu bat lerro bakoitzeko",
"Group Display Name Field" => "Taldeen bistaratzeko izena duen eremua",
"Base Group Tree" => "Oinarrizko Talde Zuhaitza",
"One Group Base DN per line" => "Talde DN Oinarri bat lerroko",
"Group Search Attributes" => "Taldekatu Bilaketa Atributuak ",
"Group-Member association" => "Talde-Kide elkarketak",
"Special Attributes" => "Atributu Bereziak",
"Quota Field" => "Kuota Eremua",
"Quota Default" => "Kuota Lehenetsia",
"in bytes" => "bytetan",
"Email Field" => "Eposta eremua",
"User Home Folder Naming Rule" => "Erabiltzailearen Karpeta Nagusia Izendatzeko Patroia",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "Utzi hutsik erabiltzaile izenarako (lehentsia). Bestela zehaztu LDAP/AD atributua.",
"Internal Username" => "Barneko erabiltzaile izena",
"Test Configuration" => "Egiaztatu Konfigurazioa",
"Help" => "Laguntza"
);
$PLURAL_FORMS = "nplurals=2; plural=(n != 1);";
