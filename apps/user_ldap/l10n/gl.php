<?php $TRANSLATIONS = array(
"Failed to clear the mappings." => "Non foi posíbel limpar as asignacións.",
"Failed to delete the server configuration" => "Non foi posíbel eliminar a configuración do servidor",
"The configuration is valid and the connection could be established!" => "A configuración é correcta e pode estabelecerse a conexión.",
"The configuration is valid, but the Bind failed. Please check the server settings and credentials." => "A configuración é correcta, mais a ligazón non. Comprobe a configuración do servidor e as credenciais.",
"The configuration is invalid. Please look in the ownCloud log for further details." => "A configuración non é correcta. Vexa o rexistro de ownCloud para máis detalles",
"Deletion failed" => "Produciuse un fallo ao eliminar",
"Take over settings from recent server configuration?" => "Tomar os recentes axustes de configuración do servidor?",
"Keep settings?" => "Manter os axustes?",
"Cannot add server configuration" => "Non é posíbel engadir a configuración do servidor",
"mappings cleared" => "limpadas as asignacións",
"Success" => "Correcto",
"Error" => "Erro",
"Connection test succeeded" => "A proba de conexión foi satisfactoria",
"Connection test failed" => "A proba de conexión fracasou",
"Do you really want to delete the current Server Configuration?" => "Confirma que quere eliminar a configuración actual do servidor?",
"Confirm Deletion" => "Confirmar a eliminación",
"<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behaviour. Please ask your system administrator to disable one of them." => "<b>Aviso:</b> Os aplicativos user_ldap e user_webdavauth son incompatíbeis. Pode acontecer un comportamento estraño. Consulte co administrador do sistema para desactivar un deles.",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>Aviso:</b> O módulo PHP LDAP non está instalado, o servidor non funcionará. Consulte co administrador do sistema para instalalo.",
"Server configuration" => "Configuración do servidor",
"Add Server Configuration" => "Engadir a configuración do servidor",
"Host" => "Servidor",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "Pode omitir o protocolo agás que precise de SSL. Nese caso comece con ldaps://",
"Base DN" => "DN base",
"One Base DN per line" => "Un DN base por liña",
"You can specify Base DN for users and groups in the Advanced tab" => "Pode especificar a DN base para usuarios e grupos na lapela de «Avanzado»",
"User DN" => "DN do usuario",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "O DN do cliente do usuario co que hai que estabelecer unha conexión, p.ex uid=axente, dc=exemplo, dc=com. Para o acceso anónimo deixe o DN e o contrasinal baleiros.",
"Password" => "Contrasinal",
"For anonymous access, leave DN and Password empty." => "Para o acceso anónimo deixe o DN e o contrasinal baleiros.",
"User Login Filter" => "Filtro de acceso de usuarios",
"Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action." => "Define o filtro que se aplica cando se intenta o acceso. %%uid substitúe o nome de usuario e a acción de acceso.",
"use %%uid placeholder, e.g. \"uid=%%uid\"" => "usar a marca de posición %%uid, p.ex «uid=%%uid»",
"User List Filter" => "Filtro da lista de usuarios",
"Defines the filter to apply, when retrieving users." => "Define o filtro a aplicar cando se recompilan os usuarios.",
"without any placeholder, e.g. \"objectClass=person\"." => "sen ningunha marca de posición, como p.ex «objectClass=persoa».",
"Group Filter" => "Filtro de grupo",
"Defines the filter to apply, when retrieving groups." => "Define o filtro a aplicar cando se recompilan os grupos.",
"without any placeholder, e.g. \"objectClass=posixGroup\"." => "sen ningunha marca de posición, como p.ex «objectClass=grupoPosix».",
"Connection Settings" => "Axustes da conexión",
"Configuration Active" => "Configuración activa",
"When unchecked, this configuration will be skipped." => "Se está sen marcar, omítese esta configuración.",
"Port" => "Porto",
"Backup (Replica) Host" => "Servidor da copia de seguranza (Réplica)",
"Give an optional backup host. It must be a replica of the main LDAP/AD server." => "Indicar un servidor de copia de seguranza opcional. Debe ser unha réplica do servidor principal LDAP/AD.",
"Backup (Replica) Port" => "Porto da copia de seguranza (Réplica)",
"Disable Main Server" => "Desactivar o servidor principal",
"When switched on, ownCloud will only connect to the replica server." => "Cando está activado, ownCloud só se conectará ao servidor de réplica.",
"Use TLS" => "Usar TLS",
"Do not use it additionally for LDAPS connections, it will fail." => "Non utilizalo ademais para conexións LDAPS xa que fallará.",
"Case insensitve LDAP server (Windows)" => "Servidor LDAP que non distingue entre maiúsculas e minúsculas (Windows)",
"Turn off SSL certificate validation." => "Desactiva a validación do certificado SSL.",
"If connection only works with this option, import the LDAP server's SSL certificate in your ownCloud server." => "Se a conexión só funciona con esta opción importe o certificado SSL do servidor LDAP no seu servidor ownCloud.",
"Not recommended, use for testing only." => "Non se recomenda. Só para probas.",
"Cache Time-To-Live" => "Tempo de persistencia da caché",
"in seconds. A change empties the cache." => "en segundos. Calquera cambio baleira a caché.",
"Directory Settings" => "Axustes do directorio",
"User Display Name Field" => "Campo de mostra do nome de usuario",
"The LDAP attribute to use to generate the user`s ownCloud name." => "O atributo LDAP a empregar para xerar o nome de usuario de ownCloud.",
"Base User Tree" => "Base da árbore de usuarios",
"One User Base DN per line" => "Un DN base de usuario por liña",
"User Search Attributes" => "Atributos de busca do usuario",
"Optional; one attribute per line" => "Opcional; un atributo por liña",
"Group Display Name Field" => "Campo de mostra do nome de grupo",
"The LDAP attribute to use to generate the groups`s ownCloud name." => "O atributo LDAP úsase para xerar os nomes dos grupos de ownCloud.",
"Base Group Tree" => "Base da árbore de grupo",
"One Group Base DN per line" => "Un DN base de grupo por liña",
"Group Search Attributes" => "Atributos de busca do grupo",
"Group-Member association" => "Asociación de grupos e membros",
"Special Attributes" => "Atributos especiais",
"Quota Field" => "Campo de cota",
"Quota Default" => "Cota predeterminada",
"in bytes" => "en bytes",
"Email Field" => "Campo do correo",
"User Home Folder Naming Rule" => "Regra de nomeado do cartafol do usuario",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "Deixar baleiro para o nome de usuario (predeterminado). Noutro caso, especifique un atributo LDAP/AD.",
"Internal Username" => "Nome de usuario interno",
"By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder in ownCloud. It is also a port of remote URLs, for instance for all *DAV services. With this setting, the default behaviour can be overriden. To achieve a similar behaviour as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behaviour. Changes will have effect only on newly mapped (added) LDAP users." => "De xeito predeterminado, o nome de usuario interno crease a partires do atributo UUID. Asegurase de que o nome de usuario é único e de non ter que converter os caracteres. O nome de usuario interno ten a limitación de que só están permitidos estes caracteres: [ a-zA-Z0-9_.@- ].  Os outros caracteres substitúense pola súa correspondencia ASCII ou simplemente omítense. Nas colisións engadirase/incrementarase un número. O nome de usuario interno utilizase para identificar a un usuario interno. É tamén o nome predeterminado do cartafol persoal do usuario en ownCloud. Tamén é un porto de URL remoto, por exemplo, para todos os servizos *DAV. Con este axuste, o comportamento predeterminado pode ser sobrescrito. Para lograr un comportamento semellante ao anterior ownCloud 5 introduza o atributo do nome para amosar do usuario no seguinte campo. Déixeo baleiro para o comportamento predeterminado. Os cambios terán efecto só nas novas asignacións (engadidos) de usuarios de LDAP.",
"Internal Username Attribute:" => "Atributo do nome de usuario interno:",
"Override UUID detection" => "Ignorar a detección do UUID",
"By default, ownCloud autodetects the UUID attribute. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behaviour. Changes will have effect only on newly mapped (added) LDAP users and groups." => "De xeito predeterminado, ownCloud detecta automaticamente o atributo UUID. O atributo UUID utilizase para identificar, sen dúbida, aos usuarios e grupos LDAP. Ademais, crearase o usuario interno baseado no UUID, se non se especifica anteriormente o contrario. Pode anular a configuración e pasar un atributo da súa escolla. Vostede debe asegurarse de que o atributo da súa escolla pode ser recuperado polos usuarios e grupos e de que é único. Déixeo baleiro para o comportamento predeterminado. Os cambios terán efecto só nas novas asignacións (engadidos) de usuarios de LDAP.",
"UUID Attribute:" => "Atributo do UUID:",
"Username-LDAP User Mapping" => "Asignación do usuario ao «nome de usuario LDAP»",
"ownCloud uses usernames to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have a internal username. This requires a mapping from ownCloud username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found by ownCloud. The internal ownCloud name is used all over in ownCloud. Clearing the Mappings will have leftovers everywhere. Clearing the Mappings is not configuration sensitive, it affects all LDAP configurations! Do never clear the mappings in a production environment. Only clear mappings in a testing or experimental stage." => "ownCloud utiliza os nomes de usuario para almacenar e asignar (meta) datos. Coa fin de identificar con precisión e recoñecer aos usuarios, cada usuario LDAP terá un nome de usuario interno. Isto require unha asignación de ownCloud nome de usuario a usuario LDAP. O nome de usuario creado asignase ao UUID do usuario LDAP. Ademais o DN almacenase na caché, para así reducir a interacción do LDAP, mais non se utiliza para a identificación. Se o DN cambia, os cambios poden ser atopados polo ownCloud. O nome interno no ownCloud utilizase en todo o ownCloud. A limpeza das asignacións deixará rastros en todas partes. A limpeza das asignacións non é sensíbel á configuración, afecta a todas as configuracións de LDAP! Non limpar nunca as asignacións nun entorno de produción. Limpar as asignacións só en fases de proba ou experimentais.",
"Clear Username-LDAP User Mapping" => "Limpar a asignación do usuario ao «nome de usuario LDAP»",
"Clear Groupname-LDAP Group Mapping" => "Limpar a asignación do grupo ao «nome de grupo LDAP»",
"Test Configuration" => "Probar a configuración",
"Help" => "Axuda"
);
