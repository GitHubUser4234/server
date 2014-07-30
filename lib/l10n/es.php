<?php
$TRANSLATIONS = array(
"Cannot write into \"config\" directory!" => "No se puede escribir en el directorio de Configuración!",
"This can usually be fixed by giving the webserver write access to the config directory" => "Esto puede ser facilmente solucionado, dando permisos de escritura al directorio de configuración en el servidor Web",
"See %s" => "Mirar %s",
"This can usually be fixed by %sgiving the webserver write access to the config directory%s." => "Esto puede ser facilmente solucionado, %sdando permisos de escritura al directorio de configuración en el servidor Web%s.",
"You are accessing the server from an untrusted domain." => "Está accediendo al servidor desde un dominio inseguro.",
"Please contact your administrator. If you are an administrator of this instance, configure the \"trusted_domain\" setting in config/config.php. An example configuration is provided in config/config.sample.php." => "Contacte a su administrador. Si usted es el administrador, configure \"trusted_domain\" en config/config.php. En config/config.sample.php se encuentra un ejemplo para la configuración.",
"Help" => "Ayuda",
"Personal" => "Personal",
"Settings" => "Ajustes",
"Users" => "Usuarios",
"Admin" => "Administración",
"Failed to upgrade \"%s\"." => "Falló la actualización \"%s\".",
"App \\\"%s\\\" can't be installed because it is not compatible with this version of ownCloud." => "La aplicación \\\"%s\\\" no se puede instalar porque no es compatible con esta versión de ownCloud.",
"No app name specified" => "No se ha especificado nombre de la aplicación",
"Unknown filetype" => "Tipo de archivo desconocido",
"Invalid image" => "Imagen inválida",
"web services under your control" => "Servicios web bajo su control",
"App directory already exists" => "El directorio de la aplicación ya existe",
"Can't create app folder. Please fix permissions. %s" => "No se puede crear la carpeta de la aplicación. Corrija los permisos. %s",
"No source specified when installing app" => "No se ha especificado origen cuando se ha instalado la aplicación",
"No href specified when installing app from http" => "No href especificado cuando se ha instalado la aplicación",
"No path specified when installing app from local file" => "Sin path especificado  cuando se ha instalado la aplicación desde el fichero local",
"Archives of type %s are not supported" => "Ficheros de tipo %s no son soportados",
"Failed to open archive when installing app" => "Fallo de apertura de fichero mientras se instala la aplicación",
"App does not provide an info.xml file" => "La aplicación no suministra un fichero info.xml",
"App can't be installed because of not allowed code in the App" => "La aplicación no puede ser instalada por tener código no autorizado en la aplicación",
"App can't be installed because it is not compatible with this version of ownCloud" => "La aplicación no se puede instalar porque no es compatible con esta versión de ownCloud",
"App can't be installed because it contains the <shipped>true</shipped> tag which is not allowed for non shipped apps" => "La aplicación no se puede instalar porque contiene la etiqueta\n<shipped>\ntrue\n</shipped>\nque no está permitida para aplicaciones no distribuidas",
"App can't be installed because the version in info.xml/version is not the same as the version reported from the app store" => "La aplicación no puede ser instalada por que la versión en info.xml/version no es la misma que la establecida en la app store",
"Application is not enabled" => "La aplicación no está habilitada",
"Authentication error" => "Error de autenticación",
"Token expired. Please reload page." => "Token expirado. Por favor, recarga la página.",
"Unknown user" => "Usuario desconocido",
"%s enter the database username." => "%s ingresar el usuario de la base de datos.",
"%s enter the database name." => "%s ingresar el nombre de la base de datos",
"%s you may not use dots in the database name" => "%s puede utilizar puntos en el nombre de la base de datos",
"MS SQL username and/or password not valid: %s" => "Usuario y/o contraseña de MS SQL no válidos: %s",
"You need to enter either an existing account or the administrator." => "Tiene que ingresar una cuenta existente o la del administrador.",
"MySQL/MariaDB username and/or password not valid" => "Nombre de usuario y/o contraseña de MySQL/MariaDB inválidos",
"DB Error: \"%s\"" => "Error BD: \"%s\"",
"Offending command was: \"%s\"" => "Comando infractor: \"%s\"",
"MySQL/MariaDB user '%s'@'localhost' exists already." => "El usuario de MySQL/MariaDB '%s'@'localhost' ya existe.",
"Drop this user from MySQL/MariaDB" => "Eliminar este usuario de MySQL/MariaDB",
"MySQL/MariaDB user '%s'@'%%' already exists" => "El usuario de MySQL/MariaDB '%s'@'%%' ya existe",
"Drop this user from MySQL/MariaDB." => "Eliminar este usuario de MySQL/MariaDB.",
"Oracle connection could not be established" => "No se pudo establecer la conexión a Oracle",
"Oracle username and/or password not valid" => "Usuario y/o contraseña de Oracle no válidos",
"Offending command was: \"%s\", name: %s, password: %s" => "Comando infractor: \"%s\", nombre: %s, contraseña: %s",
"PostgreSQL username and/or password not valid" => "Usuario y/o contraseña de PostgreSQL no válidos",
"Set an admin username." => "Configurar un nombre de usuario del administrador",
"Set an admin password." => "Configurar la contraseña del administrador.",
"Your web server is not yet properly setup to allow files synchronization because the WebDAV interface seems to be broken." => "Su servidor web aún no está configurado adecuadamente para permitir sincronización de archivos ya que la interfaz WebDAV parece no estar funcionando.",
"Please double check the <a href='%s'>installation guides</a>." => "Por favor, vuelva a comprobar las <a href='%s'>guías de instalación</a>.",
"%s shared »%s« with you" => "%s ha compatido  »%s« contigo",
"Sharing %s failed, because the file does not exist" => "No se pudo compartir %s porque el archivo no existe",
"You are not allowed to share %s" => "Usted no está autorizado para compartir %s",
"Sharing %s failed, because the user %s is the item owner" => "Compartiendo %s ha fallado, ya que el usuario %s es el dueño del elemento",
"Sharing %s failed, because the user %s does not exist" => "Compartiendo %s ha fallado, ya que el usuario %s no existe",
"Sharing %s failed, because the user %s is not a member of any groups that %s is a member of" => "Compartiendo %s ha fallado, ya que el usuario %s no es miembro de algún grupo que %s es miembro",
"Sharing %s failed, because this item is already shared with %s" => "Compartiendo %s ha fallado, ya que este elemento ya está compartido con %s",
"Sharing %s failed, because the group %s does not exist" => "Compartiendo %s ha fallado, ya que el grupo %s no existe",
"Sharing %s failed, because %s is not a member of the group %s" => "Compartiendo %s ha fallado, ya que %s no es miembro del grupo %s",
"You need to provide a password to create a public link, only protected links are allowed" => "Es necesario definir una contraseña para crear un enlace publico. Solo los enlaces protegidos están permitidos",
"Sharing %s failed, because sharing with links is not allowed" => "Compartiendo %s ha fallado, ya que compartir con enlaces no está permitido",
"Share type %s is not valid for %s" => "Compartir tipo %s no es válido para %s",
"Setting permissions for %s failed, because the permissions exceed permissions granted to %s" => "Configuración de permisos para %s ha fallado, ya que los permisos superan los permisos dados a %s",
"Setting permissions for %s failed, because the item was not found" => "Configuración de permisos para %s ha fallado, ya que el elemento no fue encontrado",
"Can not set expire date. Shares can not expire later then %s after they where shared" => "No se pudo fijar fecha de caducidad. Los archivos compartidos no pueden caducar luego de %s después de ser compartidos.",
"Can not set expire date. Expire date is in the past" => "No se pudo fijar fecha de caducidad. La fecha está en el pasado",
"Sharing backend %s must implement the interface OCP\\Share_Backend" => "El motor compartido %s debe implementar la interfaz OCP\\Share_Backend",
"Sharing backend %s not found" => "El motor compartido %s no se ha encontrado",
"Sharing backend for %s not found" => "Motor compartido para %s no encontrado",
"Sharing %s failed, because the user %s is the original sharer" => "Compartiendo %s ha fallado, ya que el usuario %s es el compartidor original",
"Sharing %s failed, because the permissions exceed permissions granted to %s" => "Compartiendo %s ha fallado, ya que los permisos superan los permisos otorgados a %s",
"Sharing %s failed, because resharing is not allowed" => "Compartiendo %s ha fallado, ya que volver a compartir no está permitido",
"Sharing %s failed, because the sharing backend for %s could not find its source" => "Compartir %s falló porque el motor compartido para %s podría no encontrar su origen",
"Sharing %s failed, because the file could not be found in the file cache" => "Compartiendo %s ha fallado, ya que el archivo no pudo ser encontrado en el cache de archivo",
"Could not find category \"%s\"" => "No puede encontrar la categoria \"%s\"",
"seconds ago" => "hace segundos",
"_%n minute ago_::_%n minutes ago_" => array("Hace %n minuto","Hace %n minutos"),
"_%n hour ago_::_%n hours ago_" => array("Hace %n hora","Hace %n horas"),
"today" => "hoy",
"yesterday" => "ayer",
"_%n day go_::_%n days ago_" => array("Hace %n día","Hace %n días"),
"last month" => "mes pasado",
"_%n month ago_::_%n months ago_" => array("Hace %n mes","Hace %n meses"),
"last year" => "año pasado",
"years ago" => "hace años",
"Only the following characters are allowed in a username: \"a-z\", \"A-Z\", \"0-9\", and \"_.@-\"" => "Solo los siguientes caracteres están permitidos en un nombre de usuario: \"a-z\", \"A-Z\", \"0-9\", and \"_.@-\"",
"A valid username must be provided" => "Se debe proporcionar un nombre de usuario válido",
"A valid password must be provided" => "Se debe proporcionar una contraseña válida",
"The username is already being used" => "El nombre de usuario ya está en uso",
"No database drivers (sqlite, mysql, or postgresql) installed." => "No están instalados los drivers de BBDD  (sqlite, mysql, o postgresql)",
"Permissions can usually be fixed by %sgiving the webserver write access to the root directory%s." => "Los permisos usualmente pueden ser  solucionados, %sdando permisos de escritura al directorio de configuración en el servidor Web%s.",
"Cannot write into \"config\" directory" => "No se puede escribir el el directorio de configuración",
"Cannot write into \"apps\" directory" => "No se puede escribir en el directorio de \"apps\"",
"This can usually be fixed by %sgiving the webserver write access to the apps directory%s or disabling the appstore in the config file." => "Esto puede ser facilmente solucionado, %sdando permisos de escritura al servidor Web en el directorio%s de apps o deshabilitando la tienda de apps en el archivo de configuración.",
"Cannot create \"data\" directory (%s)" => "No puedo crear del directorio \"data\" (%s)",
"This can usually be fixed by <a href=\"%s\" target=\"_blank\">giving the webserver write access to the root directory</a>." => "Esto puede ser solucionado <a href=\"%s\" target=\"_blank\">dando al servidor web permisos de escritura en el directorio raíz</a>.",
"Setting locale to %s failed" => "Falló la activación del idioma %s ",
"Please install one of theses locales on your system and restart your webserver." => "Por favor instale uno de estos idiomas en su sitema y reinicie su servidor Web.",
"Please ask your server administrator to install the module." => "Consulte al administrador de su servidor para instalar el módulo.",
"PHP module %s not installed." => "El ódulo PHP %s no está instalado.",
"PHP %s or higher is required." => "Se requiere PHP %s o superior.",
"Please ask your server administrator to update PHP to the latest version. Your PHP version is no longer supported by ownCloud and the PHP community." => "Consulte a su administrador del servidor para actualizar PHP a la versión más reciente. Su versión de PHP ya no es apoyado por ownCloud y la comunidad PHP.",
"PHP Safe Mode is enabled. ownCloud requires that it is disabled to work properly." => "PHP Safe mode está habilitado. ownCloud requiere que se desactive para que funcione correctamente.",
"PHP Safe Mode is a deprecated and mostly useless setting that should be disabled. Please ask your server administrator to disable it in php.ini or in your webserver config." => "Modo Seguro de PHP es un entorno en desuso y en su mayoría inútil que debe ser desactivada. Contacte al administrador del servidor para desactivarlo en php.ini o en la configuración del servidor web.",
"Magic Quotes is enabled. ownCloud requires that it is disabled to work properly." => "Magic Quotes está habilitado. ownCloud requiere que se desactive para que funcione correctamente.",
"Magic Quotes is a deprecated and mostly useless setting that should be disabled. Please ask your server administrator to disable it in php.ini or in your webserver config." => "Magic Quotes es un entorno en desuso y en su mayoría inútil que debe ser desactivada. Consulte a su administrador del servidor para desactivarlo en php.ini o en la configuración del servidor web.",
"PHP modules have been installed, but they are still listed as missing?" => "Los módulos PHP se han instalado, pero aparecen listados como si faltaran",
"Please ask your server administrator to restart the web server." => "Consulte al administrador de su servidor para reiniciar el servidor web.",
"PostgreSQL >= 9 required" => "PostgreSQL 9 o superior requerido.",
"Please upgrade your database version" => "Actualice su versión de base de datos.",
"Error occurred while checking PostgreSQL version" => "Error ocurrido mientras se chequeaba la versión de PostgreSQL",
"Please make sure you have PostgreSQL >= 9 or check the logs for more information about the error" => "Por favor, asegúrese de que tiene PostgreSQL 9 o superior, o revise los registros para obtener más información acerca del error.",
"Please change the permissions to 0770 so that the directory cannot be listed by other users." => "Por favor cambie los permisos a 0770 para que el directorio no se pueda mostrar para otros usuarios.",
"Data directory (%s) is readable by other users" => "Directorio de datos (%s) se puede leer por otros usuarios.",
"Data directory (%s) is invalid" => "Directorio de datos (%s) no es válida",
"Please check that the data directory contains a file \".ocdata\" in its root." => "Verifique que el directorio de datos contiene un archivo \".ocdata\" en su directorio raíz.",
"Could not obtain lock type %d on \"%s\"." => "No se pudo realizar el bloqueo %d en \"%s\"."
);
$PLURAL_FORMS = "nplurals=2; plural=(n != 1);";
