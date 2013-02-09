<?php $TRANSLATIONS = array(
"Failed to delete the server configuration" => "Ha fallat en eliminar la configuració del servidor",
"The configuration is valid and the connection could be established!" => "La configuració és vàlida i s'ha pogut establir la comunicació!",
"The configuration is valid, but the Bind failed. Please check the server settings and credentials." => "La configuració és vàlida, però ha fallat el Bind. Comproveu les credencials i l'arranjament del servidor.",
"The configuration is invalid. Please look in the ownCloud log for further details." => "La configuració no és vàlida. Per més detalls mireu al registre d'ownCloud.",
"Deletion failed" => "Eliminació fallida",
"Take over settings from recent server configuration?" => "Voleu prendre l'arranjament de la configuració actual del servidor?",
"Keep settings?" => "Voleu mantenir la configuració?",
"Cannot add server configuration" => "No es pot afegir la configuració del servidor",
"Connection test succeeded" => "La prova de connexió ha reeixit",
"Connection test failed" => "La prova de connexió ha fallat",
"Do you really want to delete the current Server Configuration?" => "Voleu eliminar la configuració actual del servidor?",
"Confirm Deletion" => "Confirma l'eliminació",
"<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behaviour. Please ask your system administrator to disable one of them." => "<b>Avís:</b> Les aplicacions user_ldap i user_webdavauth són incompatibles. Podeu experimentar comportaments no desitjats. Demaneu a l'administrador del sistema que en desactivi una.",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>Avís:</b> El mòdul PHP LDAP no està instal·lat, el dorsal no funcionarà. Demaneu a l'administrador del sistema que l'instal·li.",
"Server configuration" => "Configuració del servidor",
"Add Server Configuration" => "Afegeix la configuració del servidor",
"Host" => "Màquina",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "Podeu ometre el protocol, excepte si requeriu SSL. Llavors comenceu amb ldaps://",
"Base DN" => "DN Base",
"One Base DN per line" => "Una DN Base per línia",
"You can specify Base DN for users and groups in the Advanced tab" => "Podeu especificar DN Base per usuaris i grups a la pestanya Avançat",
"User DN" => "DN Usuari",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "La DN de l'usuari client amb la que s'haurà de fer, per exemple uid=agent,dc=exemple,dc=com. Per un accés anònim, deixeu la DN i la contrasenya en blanc.",
"Password" => "Contrasenya",
"For anonymous access, leave DN and Password empty." => "Per un accés anònim, deixeu la DN i la contrasenya en blanc.",
"User Login Filter" => "Filtre d'inici de sessió d'usuari",
"Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action." => "Defineix el filtre a aplicar quan s'intenta l'inici de sessió. %%uid reemplaça el nom d'usuari en l'acció d'inici de sessió.",
"use %%uid placeholder, e.g. \"uid=%%uid\"" => "useu el paràmetre de substitució %%uid, per exemple \"uid=%%uid\"",
"User List Filter" => "Llista de filtres d'usuari",
"Defines the filter to apply, when retrieving users." => "Defineix el filtre a aplicar quan es mostren usuaris",
"without any placeholder, e.g. \"objectClass=person\"." => "sense cap paràmetre de substitució, per exemple \"objectClass=persona\"",
"Group Filter" => "Filtre de grup",
"Defines the filter to apply, when retrieving groups." => "Defineix el filtre a aplicar quan es mostren grups.",
"without any placeholder, e.g. \"objectClass=posixGroup\"." => "sense cap paràmetre de substitució, per exemple \"objectClass=grupPosix\".",
"Configuration Active" => "Configuració activa",
"When unchecked, this configuration will be skipped." => "Si està desmarcat, aquesta configuració s'ometrà.",
"Port" => "Port",
"Backup (Replica) Host" => "Màquina de còpia de serguretat (rèplica)",
"Give an optional backup host. It must be a replica of the main LDAP/AD server." => "Afegiu una màquina de còpia de seguretat opcional. Ha de ser una rèplica del servidor LDAP/AD principal.",
"Backup (Replica) Port" => "Port de la còpia de seguretat (rèplica)",
"Disable Main Server" => "Desactiva el servidor principal",
"When switched on, ownCloud will only connect to the replica server." => "Quan està connectat, ownCloud només es connecta al servidor de la rèplica.",
"Use TLS" => "Usa TLS",
"Do not use it for SSL connections, it will fail." => "No ho useu en connexions SSL, fallarà.",
"Case insensitve LDAP server (Windows)" => "Servidor LDAP sense distinció entre majúscules i minúscules (Windows)",
"Turn off SSL certificate validation." => "Desactiva la validació de certificat SSL.",
"If connection only works with this option, import the LDAP server's SSL certificate in your ownCloud server." => "Si la connexió només funciona amb aquesta opció, importeu el certificat SSL del servidor LDAP en el vostre servidor ownCloud.",
"Not recommended, use for testing only." => "No recomanat, ús només per proves.",
"in seconds. A change empties the cache." => "en segons. Un canvi buidarà la memòria de cau.",
"User Display Name Field" => "Camp per mostrar el nom d'usuari",
"The LDAP attribute to use to generate the user`s ownCloud name." => "Atribut LDAP a usar per generar el nom d'usuari ownCloud.",
"Base User Tree" => "Arbre base d'usuaris",
"One User Base DN per line" => "Una DN Base d'Usuari per línia",
"User Search Attributes" => "Atributs de cerca d'usuari",
"Optional; one attribute per line" => "Opcional; Un atribut per línia",
"Group Display Name Field" => "Camp per mostrar el nom del grup",
"The LDAP attribute to use to generate the groups`s ownCloud name." => "Atribut LDAP a usar per generar el nom de grup ownCloud.",
"Base Group Tree" => "Arbre base de grups",
"One Group Base DN per line" => "Una DN Base de Grup per línia",
"Group Search Attributes" => "Atributs de cerca de grup",
"Group-Member association" => "Associació membres-grup",
"in bytes" => "en bytes",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "Deixeu-ho buit pel nom d'usuari (per defecte). Altrament, especifiqueu un atribut LDAP/AD.",
"Help" => "Ajuda"
);
