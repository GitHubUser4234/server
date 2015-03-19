OC.L10N.register(
    "user_ldap",
    {
    "Failed to clear the mappings." : "Non foi posíbel limpar as asignacións.",
    "Failed to delete the server configuration" : "Non foi posíbel eliminar a configuración do servidor",
    "The configuration is valid and the connection could be established!" : "A configuración é correcta e pode estabelecerse a conexión.",
    "The configuration is valid, but the Bind failed. Please check the server settings and credentials." : "A configuración é correcta, mais a ligazón non. Comprobe a configuración do servidor e as credenciais.",
    "The configuration is invalid. Please have a look at the logs for further details." : "A configuración non é correcta. Vexa o rexistro de ownCloud para máis detalles",
    "No action specified" : "Non se especificou unha acción",
    "No configuration specified" : "Non se especificou unha configuración",
    "No data specified" : "Non se especificaron datos",
    " Could not set configuration %s" : "Non foi posíbel estabelecer a configuración %s",
    "Deletion failed" : "Produciuse un fallo ao eliminar",
    "Take over settings from recent server configuration?" : "Tomar os recentes axustes de configuración do servidor?",
    "Keep settings?" : "Manter os axustes?",
    "{nthServer}. Server" : "{nthServer}. Servidor",
    "Cannot add server configuration" : "Non é posíbel engadir a configuración do servidor",
    "mappings cleared" : "limpadas as asignacións",
    "Success" : "Correcto",
    "Error" : "Erro",
    "Please specify a Base DN" : "Indique un DN base",
    "Could not determine Base DN" : "Non se puido determinar o DN base",
    "Please specify the port" : "Especifique un porto",
    "Configuration OK" : "Configuración correcta",
    "Configuration incorrect" : "Configuración incorrecta",
    "Configuration incomplete" : "Configuración incompleta",
    "Select groups" : "Seleccionar grupos",
    "Select object classes" : "Seleccione as clases de obxectos",
    "Select attributes" : "Seleccione os atributos",
    "Connection test succeeded" : "A proba de conexión foi satisfactoria",
    "Connection test failed" : "A proba de conexión fracasou",
    "Do you really want to delete the current Server Configuration?" : "Confirma que quere eliminar a configuración actual do servidor?",
    "Confirm Deletion" : "Confirmar a eliminación",
    "_%s group found_::_%s groups found_" : ["Atopouse %s grupo","Atopáronse %s grupos"],
    "_%s user found_::_%s users found_" : ["Atopouse %s usuario","Atopáronse %s usuarios"],
    "Could not detect user display name attribute. Please specify it yourself in advanced ldap settings." : "Non foi posíbel detectar o atributo nome de usuario que mostrar. Especifiqueo vostede mesmo nos axustes avanzados de LDAP.",
    "Could not find the desired feature" : "Non foi posíbel atopar a función desexada",
    "Invalid Host" : "Máquina incorrecta",
    "Server" : "Servidor",
    "User Filter" : "Filtro do usuario",
    "Login Filter" : "Filtro de acceso",
    "Group Filter" : "Filtro de grupo",
    "Save" : "Gardar",
    "Test Configuration" : "Probar a configuración",
    "Help" : "Axuda",
    "Groups meeting these criteria are available in %s:" : "Os grupos que cumpren estes criterios están dispoñíbeis en %s:",
    "only those object classes:" : "só as clases de obxecto:",
    "only from those groups:" : "só dos grupos:",
    "Edit raw filter instead" : "Editar, no seu canto, o filtro en bruto",
    "Raw LDAP filter" : "Filtro LDAP en bruto",
    "The filter specifies which LDAP groups shall have access to the %s instance." : "O filtro especifica que grupos LDAP teñen acceso á instancia %s.",
    "Test Filter" : "Filtro de probas",
    "groups found" : "atopáronse grupos",
    "Users login with this attribute:" : "Os usuarios inician sesión con este atributo:",
    "LDAP Username:" : "Nome de usuario LDAP:",
    "LDAP Email Address:" : "Enderezo de correo LDAP:",
    "Other Attributes:" : "Outros atributos:",
    "Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action. Example: \"uid=%%uid\"" : "Define o filtro que se aplica cando se intenta o acceso. %%uid substitúe o nome de usuario e a acción de acceso. Exemplo: «uid=%%uid»",
    "1. Server" : "1. Servidor",
    "%s. Server:" : "%s. Servidor:",
    "Add Server Configuration" : "Engadir a configuración do servidor",
    "Delete Configuration" : "Eliminar a configuración",
    "Host" : "Servidor",
    "You can omit the protocol, except you require SSL. Then start with ldaps://" : "Pode omitir o protocolo agás que precise de SSL. Nese caso comece con ldaps://",
    "Port" : "Porto",
    "User DN" : "DN do usuario",
    "The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." : "O DN do cliente do usuario co que hai que estabelecer unha conexión, p.ex uid=axente, dc=exemplo, dc=com. Para o acceso anónimo deixe o DN e o contrasinal baleiros.",
    "Password" : "Contrasinal",
    "For anonymous access, leave DN and Password empty." : "Para o acceso anónimo deixe o DN e o contrasinal baleiros.",
    "One Base DN per line" : "Un DN base por liña",
    "You can specify Base DN for users and groups in the Advanced tab" : "Pode especificar a DN base para usuarios e grupos na lapela de «Avanzado»",
    "Avoids automatic LDAP requests. Better for bigger setups, but requires some LDAP knowledge." : "Evita as peticións LDAP automáticas. E o mellor para as configuracións máis grandes, mais require algúns coñecementos de LDAP.",
    "Manually enter LDAP filters (recommended for large directories)" : "Introduza manualmente os filtros LDAP (recomendado para directorios grandes)",
    "Limit %s access to users meeting these criteria:" : "Limitar o acceso a %s para os usuarios que cumpren con estes criterios:",
    "The filter specifies which LDAP users shall have access to the %s instance." : "O filtro especifica que usuarios LDAP teñen acceso á instancia %s.",
    "users found" : "atopáronse usuarios",
    "Saving" : "Gardando",
    "Back" : "Atrás",
    "Continue" : "Continuar",
    "LDAP" : "LDAP",
    "Expert" : "Experto",
    "Advanced" : "Avanzado",
    "<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." : "<b>Aviso:</b> As aplicacións user_ldap e user_webdavauth son incompatíbeis. Pode acontecer un comportamento estraño. Consulte co administrador do sistema para desactivar unha delas.",
    "<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." : "<b>Aviso:</b> O módulo PHP LDAP non está instalado, o servidor non funcionará. Consulte co administrador do sistema para instalalo.",
    "Connection Settings" : "Axustes da conexión",
    "Configuration Active" : "Configuración activa",
    "When unchecked, this configuration will be skipped." : "Se está sen marcar, omítese esta configuración.",
    "Backup (Replica) Host" : "Servidor da copia de seguranza (Réplica)",
    "Give an optional backup host. It must be a replica of the main LDAP/AD server." : "Indicar un servidor de copia de seguranza opcional. Debe ser unha réplica do servidor principal LDAP/AD.",
    "Backup (Replica) Port" : "Porto da copia de seguranza (Réplica)",
    "Disable Main Server" : "Desactivar o servidor principal",
    "Only connect to the replica server." : "Conectar só co servidor de réplica.",
    "Case insensitive LDAP server (Windows)" : "Servidor LDAP non sensíbel a maiúsculas (Windows)",
    "Turn off SSL certificate validation." : "Desactiva a validación do certificado SSL.",
    "Not recommended, use it for testing only! If connection only works with this option, import the LDAP server's SSL certificate in your %s server." : "Non recomendado, utilizar só para probas! Se a conexión só funciona con esta opción importa o certificado SSL do servidor LDAP no seu servidor %s.",
    "Cache Time-To-Live" : "Tempo de persistencia da caché",
    "in seconds. A change empties the cache." : "en segundos. Calquera cambio baleira a caché.",
    "Directory Settings" : "Axustes do directorio",
    "User Display Name Field" : "Campo de mostra do nome de usuario",
    "The LDAP attribute to use to generate the user's display name." : "O atributo LDAP a empregar para xerar o nome de usuario para amosar.",
    "Base User Tree" : "Base da árbore de usuarios",
    "One User Base DN per line" : "Un DN base de usuario por liña",
    "User Search Attributes" : "Atributos de busca do usuario",
    "Optional; one attribute per line" : "Opcional; un atributo por liña",
    "Group Display Name Field" : "Campo de mostra do nome de grupo",
    "The LDAP attribute to use to generate the groups's display name." : "O atributo LDAP úsase para xerar os nomes dos grupos que amosar.",
    "Base Group Tree" : "Base da árbore de grupo",
    "One Group Base DN per line" : "Un DN base de grupo por liña",
    "Group Search Attributes" : "Atributos de busca do grupo",
    "Group-Member association" : "Asociación de grupos e membros",
    "Nested Groups" : "Grupos aniñados",
    "When switched on, groups that contain groups are supported. (Only works if the group member attribute contains DNs.)" : "Se está activado, admítense grupos que conteñen grupos. (Só funciona se o atributo de membro de grupo conten os DN.)",
    "Paging chunksize" : "Tamaño dos fragmentos paxinados",
    "Chunksize used for paged LDAP searches that may return bulky results like user or group enumeration. (Setting it 0 disables paged LDAP searches in those situations.)" : "Tamaño dos fragmentos utilizados para as buscas LDAP paxinadas, que poden devolver resultados voluminosos como usuario ou enumeración de grupo. (Se se establece a 0, desactívanse as buscas LDAP paxinadas nesas situacións.)",
    "Special Attributes" : "Atributos especiais",
    "Quota Field" : "Campo de cota",
    "Quota Default" : "Cota predeterminada",
    "in bytes" : "en bytes",
    "Email Field" : "Campo do correo",
    "User Home Folder Naming Rule" : "Regra de nomeado do cartafol do usuario",
    "Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." : "Deixar baleiro para o nome de usuario (predeterminado). Noutro caso, especifique un atributo LDAP/AD.",
    "Internal Username" : "Nome de usuario interno",
    "By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder. It is also a part of remote URLs, for instance for all *DAV services. With this setting, the default behavior can be overridden. To achieve a similar behavior as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users." : "De xeito predeterminado, o nome de usuario interno crease a partires do atributo UUID. Asegurase de que o nome de usuario é único e de non ter que converter os caracteres. O nome de usuario interno ten a limitación de que só están permitidos estes caracteres: [ a-zA-Z0-9_.@- ].  Os outros caracteres substitúense pola súa correspondencia ASCII ou simplemente omítense. Nas colisións engadirase/incrementarase un número. O nome de usuario interno utilizase para identificar a un usuario interno. É tamén o nome predeterminado do cartafol persoal do usuario. Tamén é parte dun URL remoto, por exemplo, para todos os servizos *DAV. Con este axuste, o comportamento predeterminado pode ser sobrescrito. Para lograr un comportamento semellante ao anterior ownCloud 5 introduza o atributo do nome para amosar do usuario no seguinte campo. Déixeo baleiro para o comportamento predeterminado. Os cambios terán efecto só nas novas asignacións (engadidos) de usuarios de LDAP.",
    "Internal Username Attribute:" : "Atributo do nome de usuario interno:",
    "Override UUID detection" : "Ignorar a detección do UUID",
    "By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." : "De xeito predeterminado, o atributo UUID é detectado automaticamente. O atributo UUID utilizase para identificar, sen dúbida, aos usuarios e grupos LDAP. Ademais, crearase o usuario interno baseado no UUID, se non se especifica anteriormente o contrario. Pode anular a configuración e pasar un atributo da súa escolla. Vostede debe asegurarse de que o atributo da súa escolla pode ser recuperado polos usuarios e grupos e de que é único. Déixeo baleiro para o comportamento predeterminado. Os cambios terán efecto só nas novas asignacións (engadidos) de usuarios de LDAP.",
    "UUID Attribute for Users:" : "Atributo do UUID para usuarios:",
    "UUID Attribute for Groups:" : "Atributo do UUID para grupos:",
    "Username-LDAP User Mapping" : "Asignación do usuario ao «nome de usuario LDAP»",
    "Usernames are used to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have an internal username. This requires a mapping from username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found. The internal username is used all over. Clearing the mappings will have leftovers everywhere. Clearing the mappings is not configuration sensitive, it affects all LDAP configurations! Never clear the mappings in a production environment, only in a testing or experimental stage." : "Os nomes de usuario empréganse para almacenar e asignar (meta) datos. Coa fin de identificar con precisión e recoñecer aos usuarios, cada usuario LDAP terá un nome de usuario interno. Isto require unha asignación do nome de usuario a usuario LDAP. O nome de usuario creado asignase ao UUID do usuario LDAP. Ademais o DN almacenase na caché, para así reducir a interacción do LDAP, mais non se utiliza para a identificación. Se o DN cambia, os cambios poden ser atopados. O nome interno do usuario utilizase para todo. A limpeza das asignacións deixará rastros en todas partes. A limpeza das asignacións non é sensíbel á configuración, afecta a todas as configuracións de LDAP! Non limpar nunca as asignacións nun entorno de produción. Limpar as asignacións só en fases de proba ou experimentais.",
    "Clear Username-LDAP User Mapping" : "Limpar a asignación do usuario ao «nome de usuario LDAP»",
    "Clear Groupname-LDAP Group Mapping" : "Limpar a asignación do grupo ao «nome de grupo LDAP»"
},
"nplurals=2; plural=(n != 1);");
