OC.L10N.register(
    "user_ldap",
    {
    "Failed to clear the mappings." : "Ocurrió un fallo al borrar las asignaciones.",
    "Failed to delete the server configuration" : "No se pudo borrar la configuración del servidor",
    "The configuration is valid and the connection could be established!" : "¡La configuración es válida y la conexión puede establecerse!",
    "The configuration is valid, but the Bind failed. Please check the server settings and credentials." : "La configuración es válida, pero falló el nexo. Por favor, compruebe la configuración del servidor y las credenciales.",
    "The configuration is invalid. Please have a look at the logs for further details." : "La configuración no es válida. Por favor, revise el registro para más detalles.",
    "No action specified" : "No se ha especificado la acción",
    "No configuration specified" : "No se ha especificado la configuración",
    "No data specified" : "No se han especificado los datos",
    " Could not set configuration %s" : "No se pudo establecer la configuración %s",
    "Action does not exist" : "La acción no existe.",
    "Configuration incorrect" : "Configuración Incorrecta",
    "Configuration incomplete" : "Configuración incompleta",
    "Configuration OK" : "Configuración correcta",
    "Select groups" : "Seleccionar grupos",
    "Select object classes" : "Seleccionar la clase de objeto",
    "Please check the credentials, they seem to be wrong." : "Por favor verifique las credenciales, parecen no ser correctas.",
    "Please specify the port, it could not be auto-detected." : "Por favor especifique el puerto, no pudo ser autodetectado.",
    "Base DN could not be auto-detected, please revise credentials, host and port." : "Base DN no puede ser detectada automáticamente, por favor revise credenciales, host y puerto.",
    "Could not detect Base DN, please enter it manually." : "No se pudo detectar Base DN, por favor ingrésela manualmente.",
    "{nthServer}. Server" : "{nthServer}. servidor",
    "No object found in the given Base DN. Please revise." : "No se encuentra ningún objeto en la Base DN dada. Por favor revisar.",
    "More than 1.000 directory entries available." : "Más de 1.000 directorios disponibles.",
    " entries available within the provided Base DN" : "entradas disponibles dentro de la BaseDN provista",
    "An error occurred. Please check the Base DN, as well as connection settings and credentials." : "Un error ocurrió. Por favor revise la Base DN, también como la configuración de la conexión y credenciales.",
    "Do you really want to delete the current Server Configuration?" : "¿Realmente desea eliminar la configuración actual del servidor?",
    "Confirm Deletion" : "Confirmar eliminación",
    "Mappings cleared successfully!" : "¡Asignaciones borradas exitosamente!",
    "Error while clearing the mappings." : "Error mientras se borraban las asignaciones.",
    "Saving failed. Please make sure the database is in Operation. Reload before continuing." : "Guardado fallido. Por favor, asegúrese de que la base de datos está en Operación. Actualizar antes de continuar.",
    "Switching the mode will enable automatic LDAP queries. Depending on your LDAP size they may take a while. Do you still want to switch the mode?" : "Cambiando el modo habilitará automáticamente las consultas LDAP. Dependiendo del tamaño de su LDAP puede tardar un rato. ¿Desea cambiar el modo?",
    "Mode switch" : "Modo interruptor",
    "Select attributes" : "Seleccionar atributos",
    "User not found. Please check your login attributes and username. Effective filter (to copy-and-paste for command line validation): <br/>" : "Usuario no encontrado. Por favor verifique los atributos de inicio de sesión y nombre de usuario. Filtro eficaz (copie-y-pegue para validar desde la línea de comando):<br/>",
    "User found and settings verified." : "Usuario encontrado y configuración verificada.",
    "Settings verified, but one user found. Only the first will be able to login. Consider a more narrow filter." : "Configuración verificada, pero no se encuentra ningún usuario. Sólo el primero podrá iniciar sesión. Considere un filtro más estrecho.",
    "An unspecified error occurred. Please check the settings and the log." : "Un error no especificado ocurrió. Por favor verifique las configuraciones y el registro.",
    "The search filter is invalid, probably due to syntax issues like uneven number of opened and closed brackets. Please revise." : "El filtro de búsqueda es inválido, probablemente debido a problemas de sintáxis tales como números impares de paréntesis abiertos y cerrados. Por favor revíselos.",
    "A connection error to LDAP / AD occurred, please check host, port and credentials." : "Un error de conexión a LDAP / AD ocurrió, por favor verifique host, puerto y credenciales.",
    "The %uid placeholder is missing. It will be replaced with the login name when querying LDAP / AD." : "El marcador de posición %uid no está presente. Será reemplazado con el nombre de inicio de sesión cuando se consulte LDAP / AD.",
    "Please provide a login name to test against" : "Por favor suministre un nombre de inicio de sesión para probar",
    "The group box was disabled, because the LDAP / AD server does not support memberOf." : "El cuadro de grupo fue deshabilitado, porque el servidor LDAP / AD no admite memberOf.",
    "_%s group found_::_%s groups found_" : ["Grupo %s encontrado","Grupos %s encontrados"],
    "_%s user found_::_%s users found_" : ["Usuario %s encontrado","Usuarios %s encontrados"],
    "Could not detect user display name attribute. Please specify it yourself in advanced ldap settings." : "No se pudo detectar el atributo de nombre de usuario pantalla. Por favor especifique lo mismo en ajustes avanzados ldap.",
    "Could not find the desired feature" : "No se puede encontrar la función deseada.",
    "Invalid Host" : "Host inválido",
    "Server" : "Servidor",
    "Users" : "Usuarios",
    "Login Attributes" : "Atributos de inicio de sesión",
    "Groups" : "Grupos",
    "Test Configuration" : "Configuración de prueba",
    "Help" : "Ayuda",
    "Groups meeting these criteria are available in %s:" : "Los grupos que cumplen estos criterios están disponibles en %s:",
    "Only these object classes:" : "Sólo estas clases de objetos:",
    "Only from these groups:" : "Sólo desde estos grupos:",
    "Search groups" : "Buscar grupos",
    "Available groups" : "Grupos disponibles",
    "Selected groups" : "Grupos seleccionados",
    "Edit LDAP Query" : "Editar consulta LDAP",
    "LDAP Filter:" : "Filtro LDAP:",
    "The filter specifies which LDAP groups shall have access to the %s instance." : "El filtro especifica que grupos LDAP tendrán acceso a %s.",
    "Test Filter" : "Filtro de prueba",
    "Verify settings and count groups" : "Verificar configuraciones y contar grupos",
    "When logging in, %s will find the user based on the following attributes:" : "Cuando se inicia sesión, %s encontrará al usuario basado en los siguientes atributos:",
    "LDAP / AD Username:" : "Nombre de usuario LDAP /AD:",
    "Allows login against the LDAP / AD username, which is either uid or samaccountname and will be detected." : "Permite el inicio de sesión contra el nombre de usuario LDAP / AD, el cual es o el uid o samaccountname y será detectado.",
    "LDAP / AD Email Address:" : "LDAP / AD dirección de correo electrónico:",
    "Allows login against an email attribute. Mail and mailPrimaryAddress will be allowed." : "Permite el inicio de sesión contra un atributo de correo electrónico. Correo y dirección primario de correo electrónico está habilitada.",
    "Other Attributes:" : "Otros atributos:",
    "Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action. Example: \"uid=%%uid\"" : "Define el filtro a aplicar cuando se intenta identificar. %%uid remplazará al nombre de usuario en el proceso de identificación. Por ejemplo: \"uid=%%uid\"",
    "Test Loginname" : "Probar nombre de sesión",
    "Verify settings" : "Verificar configuración",
    "1. Server" : "1. Servidor",
    "%s. Server:" : "%s. Servidor:",
    "Host" : "Servidor",
    "You can omit the protocol, except you require SSL. Then start with ldaps://" : "Puede omitir el protocolo, excepto si requiere SSL. En ese caso, empiece con ldaps://",
    "Port" : "Puerto",
    "Detect Port" : "Detectar puerto",
    "User DN" : "DN usuario",
    "The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." : "El DN del usuario cliente con el que se hará la asociación, p.ej. uid=agente,dc=ejemplo,dc=com. Para acceso anónimo, deje DN y contraseña vacíos.",
    "Password" : "Contraseña",
    "For anonymous access, leave DN and Password empty." : "Para acceso anónimo, deje DN y contraseña vacíos.",
    "One Base DN per line" : "Un DN Base por línea",
    "You can specify Base DN for users and groups in the Advanced tab" : "Puede especificar el DN base para usuarios y grupos en la pestaña Avanzado",
    "Detect Base DN" : "Detectar Base DN",
    "Test Base DN" : "Probar Base DN",
    "Avoids automatic LDAP requests. Better for bigger setups, but requires some LDAP knowledge." : "Evita peticiones automáticas al LDAP. Mejor para grandes configuraciones, pero requiere cierto conocimiento de LDAP.",
    "Manually enter LDAP filters (recommended for large directories)" : "Ingrese manualmente los filtros LDAP (Recomendado para grandes directorios)",
    "Limit %s access to users meeting these criteria:" : "Limitar el acceso a %s a los usuarios que cumplan estos criterios:",
    "The most common object classes for users are organizationalPerson, person, user, and inetOrgPerson. If you are not sure which object class to select, please consult your directory admin." : "Los objetos de clases más comunes para los usuarios son organizationalPerson, persona, usuario y inetOrgPerson. Si no está seguro de qué objeto de clase seleccionar, por favor, consulte con su administrador de directorio. ",
    "The filter specifies which LDAP users shall have access to the %s instance." : "El filtro especifica que usuarios LDAP pueden tener acceso a %s.",
    "Verify settings and count users" : "Verificar configuración y contar usuarios",
    "Saving" : "Guardando",
    "Back" : "Atrás",
    "Continue" : "Continuar",
    "LDAP" : "LDAP",
    "Expert" : "Experto",
    "Advanced" : "Avanzado",
    "<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." : "<b>Advertencia:</b> Las apps user_ldap y user_webdavauth son incompatibles. Puede que experimente un comportamiento inesperado. Pídale a su administrador del sistema que desactive uno de ellos.",
    "<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." : "<b>Advertencia:</b> El módulo LDAP de PHP no está instalado, el sistema no funcionará. Por favor consulte al administrador del sistema para instalarlo.",
    "Connection Settings" : "Configuración de conexión",
    "Configuration Active" : "Configuracion activa",
    "When unchecked, this configuration will be skipped." : "Cuando esté desmarcado, esta configuración se omitirá",
    "Backup (Replica) Host" : "Servidor de copia de seguridad (Réplica)",
    "Give an optional backup host. It must be a replica of the main LDAP/AD server." : "Dar un servidor de copia de seguridad opcional. Debe ser una réplica del servidor principal LDAP / AD.",
    "Backup (Replica) Port" : "Puerto para copias de seguridad (Replica)",
    "Disable Main Server" : "Deshabilitar servidor principal",
    "Only connect to the replica server." : "Conectar sólo con el servidor de réplica.",
    "Case insensitive LDAP server (Windows)" : "Servidor de LDAP insensible a mayúsculas/minúsculas (Windows)",
    "Turn off SSL certificate validation." : "Apagar la validación por certificado SSL.",
    "Not recommended, use it for testing only! If connection only works with this option, import the LDAP server's SSL certificate in your %s server." : "No se recomienda, ¡utilícelo únicamente para pruebas! Si la conexión sólo funciona con esta opción, importe el certificado SSL del servidor LDAP en su servidor %s.",
    "Cache Time-To-Live" : "Cache TTL",
    "in seconds. A change empties the cache." : "en segundos. Un cambio vacía la caché.",
    "Directory Settings" : "Configuracion de directorio",
    "User Display Name Field" : "Campo de nombre de usuario a mostrar",
    "The LDAP attribute to use to generate the user's display name." : "El campo LDAP a usar para generar el nombre para mostrar del usuario.",
    "Base User Tree" : "Árbol base de usuario",
    "One User Base DN per line" : "Un DN Base de Usuario por línea",
    "User Search Attributes" : "Atributos de la busqueda de usuario",
    "Optional; one attribute per line" : "Opcional; un atributo por linea",
    "Group Display Name Field" : "Campo de nombre de grupo a mostrar",
    "The LDAP attribute to use to generate the groups's display name." : "El campo LDAP a usar para generar el nombre para mostrar del grupo.",
    "Base Group Tree" : "Árbol base de grupo",
    "One Group Base DN per line" : "Un DN Base de Grupo por línea",
    "Group Search Attributes" : "Atributos de búsqueda de grupo",
    "Group-Member association" : "Asociación Grupo-Miembro",
    "Nested Groups" : "Grupos anidados",
    "When switched on, groups that contain groups are supported. (Only works if the group member attribute contains DNs.)" : "Cuando se active, se permitirán grupos que contengan otros grupos (solo funciona si el atributo de miembro de grupo contiene DNs).",
    "Paging chunksize" : "Tamaño de los fragmentos de paginación",
    "Chunksize used for paged LDAP searches that may return bulky results like user or group enumeration. (Setting it 0 disables paged LDAP searches in those situations.)" : "Tamaño de los fragmentos usado para búsquedas LDAP paginadas que pueden devolver resultados voluminosos, como enumeración de usuarios o de grupos. (Si se establece en 0, se deshabilitan las búsquedas LDAP paginadas en esas situaciones.)",
    "Special Attributes" : "Atributos especiales",
    "Quota Field" : "Cuota",
    "Quota Default" : "Cuota por defecto",
    "in bytes" : "en bytes",
    "Email Field" : "E-mail",
    "User Home Folder Naming Rule" : "Regla para la carpeta Home de usuario",
    "Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." : "Vacío para el nombre de usuario (por defecto). En otro caso, especifique un atributo LDAP/AD.",
    "Internal Username" : "Nombre de usuario interno",
    "By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder. It is also a part of remote URLs, for instance for all *DAV services. With this setting, the default behavior can be overridden. To achieve a similar behavior as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users." : "El nombre de usuario interno será creado de forma predeterminada desde el atributo UUID. Esto asegura que el nombre de usuario es único y los caracteres no necesitan ser convertidos. En el nombre de usuario interno sólo se pueden usar estos caracteres: [ a-zA-Z0-9_.@- ]. El resto de caracteres son sustituidos por su correspondiente en ASCII o simplemente omitidos. En caso de duplicidades, se añadirá o incrementará un número. El nombre de usuario interno es usado para identificar un usuario. Es también el nombre predeterminado para la carpeta personal del usuario en ownCloud. También es parte de URLs remotas, por ejemplo, para todos los servicios *DAV. Con esta configuración el comportamiento predeterminado puede ser cambiado. Para conseguir un comportamiento similar a como era antes de ownCloud 5, introduzca el campo del nombre para mostrar del usuario en la siguiente caja. Déjelo vacío para el comportamiento predeterminado. Los cambios solo tendrán efecto en los usuarios LDAP mapeados (añadidos) recientemente.",
    "Internal Username Attribute:" : "Atributo de nombre de usuario interno:",
    "Override UUID detection" : "Sobrescribir la detección UUID",
    "By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." : "Por defecto, el atributo UUID es autodetectado. Este atributo es usado para identificar indudablemente usuarios y grupos LDAP. Además, el nombre de usuario interno será creado en base al UUID, si no ha sido especificado otro comportamiento arriba. Puedes sobrescribir la configuración y pasar un atributo de tu elección. Debes asegurarte de que el atributo de tu elección sea accesible por los usuarios y grupos y ser único. Déjalo en blanco para usar el comportamiento por defecto. Los cambios tendrán efecto solo en los usuarios y grupos de LDAP mapeados (añadidos) recientemente.",
    "UUID Attribute for Users:" : "Atributo UUID para usuarios:",
    "UUID Attribute for Groups:" : "Atributo UUID para Grupos:",
    "Username-LDAP User Mapping" : "Asignación del Nombre de usuario de un usuario LDAP",
    "Usernames are used to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have an internal username. This requires a mapping from username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found. The internal username is used all over. Clearing the mappings will have leftovers everywhere. Clearing the mappings is not configuration sensitive, it affects all LDAP configurations! Never clear the mappings in a production environment, only in a testing or experimental stage." : "Los usuarios son usados para almacenar y asignar (meta) datos. Con el fin de identificar de forma precisa y reconocer usuarios, cada usuario de LDAP tendrá un nombre de usuario interno. Esto requiere un mapeo entre el nombre de usuario y el usuario del LDAP. El nombre de usuario creado es mapeado respecto al UUID del usuario en el LDAP. De forma adicional, el DN es cacheado para reducir la interacción entre el LDAP, pero no es usado para identificar. Si el DN cambia, los cambios serán aplicados. El nombre de usuario interno es usado por encima de todo. Limpiar los mapeos dejará restos por todas partes, no es sensible a configuración, ¡afecta a todas las configuraciones del LDAP! Nunca limpies los mapeos en un entorno de producción, únicamente en una fase de desarrollo o experimental.",
    "Clear Username-LDAP User Mapping" : "Borrar la asignación de los Nombres de usuario de los usuarios LDAP",
    "Clear Groupname-LDAP Group Mapping" : "Borrar la asignación de los Nombres de grupo de los grupos de LDAP"
},
"nplurals=2; plural=(n != 1);");
