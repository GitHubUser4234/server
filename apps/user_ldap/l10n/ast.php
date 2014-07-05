<?php
$TRANSLATIONS = array(
"Failed to clear the mappings." => "Hebo un fallu al desaniciar les asignaciones.",
"Failed to delete the server configuration" => "Fallu al desaniciar la configuración del sirvidor",
"The configuration is valid and the connection could be established!" => "¡La configuración ye válida y pudo afitase la conexón!",
"The configuration is valid, but the Bind failed. Please check the server settings and credentials." => "La configuración ye válida, pero falló'l vínculu.  Por favor, comprueba la configuración y les credenciales nel sirvidor.",
"The configuration is invalid. Please have a look at the logs for further details." => "La configuración nun ye válida. Por favor, écha-y un güeyu a los rexistros pa más detalles.",
"No action specified" => "Nun s'especificó l'aición",
"No configuration specified" => "Nun s'especificó la configuración",
"No data specified" => "Nun s'especificaron los datos",
" Could not set configuration %s" => "Nun pudo afitase la configuración %s",
"Deletion failed" => "Falló'l borráu",
"Take over settings from recent server configuration?" => "¿Asumir los axustes actuales de la configuración del sirvidor?",
"Keep settings?" => "¿Caltener los axustes?",
"{nthServer}. Server" => "{nthServer}. Sirvidor",
"Cannot add server configuration" => "Nun pue amestase la configuración del sirvidor",
"mappings cleared" => "Asignaciones desaniciaes",
"Success" => "Con ésitu",
"Error" => "Fallu",
"Please specify a Base DN" => "Especifica un DN base",
"Could not determine Base DN" => "Nun pudo determinase un DN base",
"Please specify the port" => "Especifica'l puertu",
"Configuration OK" => "Configuración correuta",
"Configuration incorrect" => "Configuración incorreuta",
"Configuration incomplete" => "Configuración incompleta",
"Select groups" => "Esbillar grupos",
"Select object classes" => "Seleicionar la clas d'oxetu",
"Select attributes" => "Esbillar atributos",
"Connection test succeeded" => "Test de conexón esitosu",
"Connection test failed" => "Falló'l test de conexón",
"Do you really want to delete the current Server Configuration?" => "¿Daveres que quies desaniciar la configuración actual del sirvidor?",
"Confirm Deletion" => "Confirmar desaniciu",
"_%s group found_::_%s groups found_" => array("%s grupu alcontráu","%s grupos alcontraos"),
"_%s user found_::_%s users found_" => array("%s usuariu alcontráu","%s usuarios alcontraos"),
"Could not find the desired feature" => "Nun pudo alcontrase la carauterística deseyada",
"Invalid Host" => "Host inválidu",
"Server" => "Sirvidor",
"User Filter" => "Filtru d'usuariu",
"Login Filter" => "Filtru de login",
"Group Filter" => "Filtru de Grupu",
"Save" => "Guardar",
"Test Configuration" => "Configuración de prueba",
"Help" => "Ayuda",
"Groups meeting these criteria are available in %s:" => "Los grupos que cumplen estos criterios tán disponibles en %s:",
"only those object classes:" => "namái d'estes clases d'oxetu:",
"only from those groups:" => "manái d'estos grupos:",
"Edit raw filter instead" => "Editar el filtru en brutu en so llugar",
"Raw LDAP filter" => "Filtru LDAP en brutu",
"The filter specifies which LDAP groups shall have access to the %s instance." => "El filtru especifica qué grupos LDAP van tener accesu a %s.",
"groups found" => "grupos alcontraos",
"Users login with this attribute:" => "Aniciu de sesión d'usuarios con esti atributu:",
"LDAP Username:" => "Nome d'usuariu LDAP",
"LDAP Email Address:" => "Direición e-mail LDAP:",
"Other Attributes:" => "Otros atributos:",
"Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action. Example: \"uid=%%uid\"" => "Define'l filtru a aplicar cuando s'intenta identificar. %%uid va trocar al nome d'usuariu nel procesu d'identificación. Por exemplu: \"uid=%%uid\"",
"1. Server" => "1. Sirvidor",
"%s. Server:" => "%s. Sirvidor:",
"Add Server Configuration" => "Amestar configuración del sirvidor",
"Delete Configuration" => "Desaniciar configuración",
"Host" => "Equipu",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "Pues omitir el protocolu, sacantes si necesites SSL. Nesi casu, entama con ldaps://",
"Port" => "Puertu",
"User DN" => "DN usuariu",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "El DN del usuariu veceru col que va facese l'asociación, p.ex. uid=axente,dc=exemplu,dc=com. P'accesu anónimu, dexa DN y contraseña baleros.",
"Password" => "Contraseña",
"For anonymous access, leave DN and Password empty." => "Pa un accesu anónimu, dexar el DN y la contraseña baleros.",
"One Base DN per line" => "Un DN Base por llinia",
"You can specify Base DN for users and groups in the Advanced tab" => "Pues especificar el DN base pa usuarios y grupos na llingüeta Avanzáu",
"Limit %s access to users meeting these criteria:" => "Llendar l'accesu a %s a los usuarios que cumplan estos criterios:",
"The filter specifies which LDAP users shall have access to the %s instance." => "El filtru especifica qué usuarios LDAP puen tener accesu a %s.",
"users found" => "usuarios alcontraos",
"Back" => "Atrás",
"Continue" => "Continuar",
"Expert" => "Espertu",
"Advanced" => "Avanzáu",
"<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." => "<b>Avisu:</b> Les apps user_ldap y user_webdavauth son incompatibles. Pues esperimentar un comportamientu inesperáu. Entruga al to alministrador de sistemes pa desactivar una d'elles.",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>Avisu:</b> El módulu LDAP de PHP nun ta instaláu, el sistema nun va funcionar. Por favor consulta al alministrador del sistema pa instalalu.",
"Connection Settings" => "Axustes de conexón",
"Configuration Active" => "Configuración activa",
"When unchecked, this configuration will be skipped." => "Cuando nun tea conseñáu, saltaráse esta configuración.",
"Backup (Replica) Host" => "Sirvidor de copia de seguranza (Réplica)",
"Give an optional backup host. It must be a replica of the main LDAP/AD server." => "Dar un sirvidor de copia de seguranza opcional. Tien de ser una réplica del sirvidor principal LDAP / AD.",
"Backup (Replica) Port" => "Puertu pa copies de seguranza (Réplica)",
"Disable Main Server" => "Deshabilitar sirvidor principal",
"Only connect to the replica server." => "Coneutar namái col sirvidor de réplica.",
"Case insensitive LDAP server (Windows)" => "Sirvidor de LDAP insensible a mayúscules/minúscules (Windows)",
"Turn off SSL certificate validation." => "Apagar la validación del certificáu SSL.",
"Not recommended, use it for testing only! If connection only works with this option, import the LDAP server's SSL certificate in your %s server." => "Nun se recomienda, ¡úsalu namái pa pruebes! Si la conexón namái funciona con esta opción, importa'l certificáu SSL del sirvidor LDAP nel to sirvidor %s.",
"Cache Time-To-Live" => "Cache Time-To-Live",
"in seconds. A change empties the cache." => "en segundos. Un cambéu vacia la caché.",
"Directory Settings" => "Axustes del direutoriu",
"User Display Name Field" => "Campu de nome d'usuariu a amosar",
"The LDAP attribute to use to generate the user's display name." => "El campu LDAP a usar pa xenerar el nome p'amosar del usuariu.",
"Base User Tree" => "Árbol base d'usuariu",
"One User Base DN per line" => "Un DN Base d'Usuariu por llinia",
"User Search Attributes" => "Atributos de la gueta d'usuariu",
"Optional; one attribute per line" => "Opcional; un atributu por llinia",
"Group Display Name Field" => "Campu de nome de grupu a amosar",
"The LDAP attribute to use to generate the groups's display name." => "El campu LDAP a usar pa xenerar el nome p'amosar del grupu.",
"Base Group Tree" => "Árbol base de grupu",
"One Group Base DN per line" => "Un DN Base de Grupu por llinia",
"Group Search Attributes" => "Atributos de gueta de grupu",
"Group-Member association" => "Asociación Grupu-Miembru",
"Nested Groups" => "Grupos añeraos",
"When switched on, groups that contain groups are supported. (Only works if the group member attribute contains DNs.)" => "Cuando s'active, van permitise grupos que contengan otros grupos (namái funciona si l'atributu de miembru de grupu contién DNs).",
"Paging chunksize" => "Tamañu de los fragmentos de paxinación",
"Chunksize used for paged LDAP searches that may return bulky results like user or group enumeration. (Setting it 0 disables paged LDAP searches in those situations.)" => "Tamañu de los fragmentos usáu pa busques LDAP paxinaes que puen devolver resultaos voluminosos, como enubmeración d'usuarios o de grupos. (Si s'afita en 0, van deshabilitase les busques LDAP paxinaes neses situaciones.)",
"Special Attributes" => "Atributos especiales",
"Quota Field" => "Cuota",
"Quota Default" => "Cuota por defeutu",
"in bytes" => "en bytes",
"Email Field" => "E-mail",
"User Home Folder Naming Rule" => "Regla pa la carpeta Home d'usuariu",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "Baleru pal nome d'usuariu (por defeutu). N'otru casu, especifica un atributu LDAP/AD.",
"Internal Username" => "Nome d'usuariu internu",
"By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder. It is also a part of remote URLs, for instance for all *DAV services. With this setting, the default behavior can be overridden. To achieve a similar behavior as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users." => "El nome d'usuariu internu va crease de forma predeterminada dende l'atributu UUID. Esto asegura que'l nome d'usuariu ye únicu y los caráuteres nun necesiten convertise. Nel nome d'usuariu internu namái puen usase estos caráuteres: [ a-zA-Z0-9_.@- ]. El restu de caráuteres sustitúyense pol so correspondiente en ASCII u omítense. En casu de duplicidaes, va amestase o incrementase un númberu. El nome d'usuariu internu úsase pa identificar un usuariu. Ye tamién el nome predetermináu pa la carpeta personal del usuariu en ownCloud. Tamién ye parte d'URLs remotes, por exemplu, pa tolos servicios *DAV. Con esta configuración el comportamientu predetermináu pue cambiase. Pa consiguir un comportamientu asemeyáu a como yera enantes d'ownCloud 5, introduz el campu del nome p'amosar del usuariu na siguiente caxa. Déxalu baleru pal comportamientu predetermináu. Los cambeos namái van tener efeutu nos usuarios LDAP mapeaos (amestaos) recién.",
"Internal Username Attribute:" => "Atributu Nome d'usuariu Internu:",
"Override UUID detection" => "Sobrescribir la deteición UUID",
"By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." => "Por defeutu, l'atributu UUID autodetéutase. Esti atributu úsase pa identificar induldablemente usuarios y grupos LDAP. Arriendes, el nome d'usuariu internu va crease en bas al UUID, si nun s'especificó otru comportamientu arriba. Pues sobrescribir la configuración y pasar un atributu de la to eleición. Tienes d'asegurate de que l'atributu de la to eleición seya accesible polos usuarios y grupos y ser únicu. Déxalu en blanco pa usar el comportamientu por defeutu. Los cambeos van tener efeutu namái nos usuarios y grupos de LDAP mapeaos (amestaos) recién.",
"UUID Attribute for Users:" => "Atributu UUID pa usuarios:",
"UUID Attribute for Groups:" => "Atributu UUID pa Grupos:",
"Username-LDAP User Mapping" => "Asignación del Nome d'usuariu LDAP",
"Usernames are used to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have a internal username. This requires a mapping from username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found. The internal username is used all over. Clearing the mappings will have leftovers everywhere. Clearing the mappings is not configuration sensitive, it affects all LDAP configurations! Never clear the mappings in a production environment, only in a testing or experimental stage." => "Los usuarios úsense p'almacenar y asignar (meta) datos. Col envís d'identificar de forma precisa y reconocer usuarios, cada usuariu de LDAP va tener un nome d'usuariu internu. Esto requier un mapéu ente'l nome d'usuariu y l'usuariu del LDAP. El nome d'usuariu creáu mapéase respeutu al UUID del usuariu nel LDAP. De forma adicional, el DN cachéase p'amenorgar la interaición ente'l LDAP, pero nun s'usa pa identificar. Si'l DN camuda, los cambeos van aplicase. El nome d'usuariu internu úsase penriba de too. Llimpiar los mapeos va dexar restos per toos llaos, nun ye sensible a configuración, ¡afeuta a toles configuraciones del LDAP! Enxamás llimpies los mapeos nun entornu de producción, namái nuna fase de desendolcu o esperimental.",
"Clear Username-LDAP User Mapping" => "Llimpiar l'asignación de los Nomes d'usuariu de los usuarios LDAP",
"Clear Groupname-LDAP Group Mapping" => "Llimpiar l'asignación de los Nomes de grupu de los grupos de LDAP"
);
$PLURAL_FORMS = "nplurals=2; plural=(n != 1);";
