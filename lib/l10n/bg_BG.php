<?php
$TRANSLATIONS = array(
"Cannot write into \"config\" directory!" => "Неуспешен опит за запис в \"config\" папката!",
"This can usually be fixed by giving the webserver write access to the config directory" => "Това може да бъде решено единствено като разрешиш на уеб сървъра да пише в config папката.",
"See %s" => "Виж %s",
"This can usually be fixed by %sgiving the webserver write access to the config directory%s." => "Това обикновено може да бъде оправено като %s даде разрешение на уеб сървъра да записва в config папката %s.",
"You are accessing the server from an untrusted domain." => "Свръзваш се със сървъра от неодобрен домейн.",
"Please contact your administrator. If you are an administrator of this instance, configure the \"trusted_domain\" setting in config/config.php. An example configuration is provided in config/config.sample.php." => "Моля, свържи се с администратора. Ако ти си администраторът, на този сървър, промени \"trusted_domain\" настройките в  config/config.php. Примерна конфигурация е приложена в config/config.sample.php.",
"Help" => "Помощ",
"Personal" => "Лични",
"Settings" => "Настройки",
"Users" => "Потребители",
"Admin" => "Админ",
"Failed to upgrade \"%s\"." => "Неуспешно обновяване на \"%s\".",
"App \\\"%s\\\" can't be installed because it is not compatible with this version of ownCloud." => "Приложението \\\"%s\\\" не може да бъде инсталирано, защото не е съвместимо с тази версия на ownCloud.",
"No app name specified" => "Не е зададено име на преложението",
"Unknown filetype" => "Непознат тип файл.",
"Invalid image" => "Невалидно изображение.",
"web services under your control" => "уеб услуги под твой контрол",
"App directory already exists" => "Папката на приложението вече съществува.",
"Can't create app folder. Please fix permissions. %s" => "Неуспешно създаване на папката за приложението. Моля, оправете разрешенията. %s",
"No source specified when installing app" => "Не е зададен източник при инсталацията на приложението.",
"No href specified when installing app from http" => "Липсва съдържанието на връзката за инсталиране на приложението",
"No path specified when installing app from local file" => "Не е зададен пътя до локалния файл за инсталиране на приложението.",
"Archives of type %s are not supported" => "Архиви от тип %s не се подържат",
"Failed to open archive when installing app" => "Неуспешно отваряне на архив по времен на инсталацията на приложението.",
"App does not provide an info.xml file" => "Приложенението не добавило info.xml",
"App can't be installed because of not allowed code in the App" => "Приложението няма да бъде инсталирано, защото използва неразрешен код.",
"App can't be installed because it is not compatible with this version of ownCloud" => "Приложението няма да бъде инсталирано, защото не е съвместимо с текущата версия на ownCloud.",
"App can't be installed because it contains the <shipped>true</shipped> tag which is not allowed for non shipped apps" => "Приложението няма да бъде инсталирано, защото съдържа <shipped>true</shipped>, който таг не е разрешен за не ship-нати приложения.",
"App can't be installed because the version in info.xml/version is not the same as the version reported from the app store" => "Приложението няма да бъде инсталирано, защото версията в info.xml/version не съвпада с версията публикувана в магазина за приложения.",
"Application is not enabled" => "Приложението не е включено",
"Authentication error" => "Проблем с идентификацията",
"Token expired. Please reload page." => "Изтекла сесия. Моля, презареди страницата.",
"Unknown user" => "Непознат потребител",
"%s enter the database username." => "%s въведи потребителско име за базата данни.",
"%s enter the database name." => "%s въведи име на базата данни.",
"%s you may not use dots in the database name" => "%s, не може да ползваш точки в името на базата данни.",
"MS SQL username and/or password not valid: %s" => "Невалидно MS SQL потребителско име и/или парола: %s.",
"You need to enter either an existing account or the administrator." => "Необходимо е да въведеш съществуващ профил или като администратор.",
"MySQL/MariaDB username and/or password not valid" => "MySQL/MariaDB потребителското име и/или паролата са невалидни.",
"DB Error: \"%s\"" => "Грешка в базата данни: \"%s\".",
"Offending command was: \"%s\"" => "Проблемната команда беше: \"%s\".",
"MySQL/MariaDB user '%s'@'localhost' exists already." => "MySQL/MariaDB потребител '%s'@'localhost' вече съществува.",
"Drop this user from MySQL/MariaDB" => "Премахни този потребител от MySQL/MariaDB.",
"MySQL/MariaDB user '%s'@'%%' already exists" => "MySQL/MariaDB потребител '%s'@'%%' вече съществува.",
"Drop this user from MySQL/MariaDB." => "Премахни този потребител от MySQL/MariaDB.",
"Oracle connection could not be established" => "Oracle връзка не можа да се осъществи.",
"Oracle username and/or password not valid" => "Невалидно Oracle потребителско име и/или парола.",
"Offending command was: \"%s\", name: %s, password: %s" => "Проблемната команда беше: \"%s\", име: %s, парола: %s.",
"PostgreSQL username and/or password not valid" => "Невалидно PostgreSQL потребителско име и/или парола.",
"Set an admin username." => "Задай потребителско име за администратор.",
"Set an admin password." => "Задай парола за администратор.",
"Your web server is not yet properly setup to allow files synchronization because the WebDAV interface seems to be broken." => "Твоят web сървър все още не е правилно настроен да позволява синхронизация на файлове, защото WebDAV интерфейсът изглежда не работи.",
"Please double check the <a href='%s'>installation guides</a>." => "Моля, провери <a href='%s'>ръководството за инсталиране</a> отново.",
"%s shared »%s« with you" => "%s сподели »%s« с теб",
"Sharing %s failed, because the file does not exist" => "Неуспешно споделяне на %s, защото файлът не съществува.",
"You are not allowed to share %s" => "Не ти е разрешено да споделяш %s.",
"Sharing %s failed, because the user %s is the item owner" => "Споделяне на %s е неуспешно, защото потребител %s е оригиналния собственик.",
"Sharing %s failed, because the user %s does not exist" => "Неуспешно споделяне на %s, защото потребител %s не съществува.",
"Sharing %s failed, because the user %s is not a member of any groups that %s is a member of" => "Неуспешно споделяне на %s, защото %s не е член никоя от групите, в които %s членува.",
"Sharing %s failed, because this item is already shared with %s" => "Неуспешно споделяне на %s, защото това съдържание е вече споделено с %s.",
"Sharing %s failed, because the group %s does not exist" => "Неупешно споделяне на %s, защото групата %s не съществува.",
"Sharing %s failed, because %s is not a member of the group %s" => "Неуспешно споделяне на %s, защото %s не е член на групата %s.",
"You need to provide a password to create a public link, only protected links are allowed" => "Трябва да зададеш парола, за да създадеш общодостъпен линк за споделяне, само защитени с пароли линкове са разрешени.",
"Sharing %s failed, because sharing with links is not allowed" => "Неуспешно споделяне на %s, защото споделянето посредством връзки не е разрешено.",
"Share type %s is not valid for %s" => "Споделянето на тип %s не валидно за %s.",
"Setting permissions for %s failed, because the permissions exceed permissions granted to %s" => "Неуспешна промяна на правата за достъп за %s, защото промените надвишават правата на достъп дадени на %s.",
"Setting permissions for %s failed, because the item was not found" => "Неуспешна промяна на правата за достъп за %s, защото съдържанието не е открито.",
"Sharing backend %s must implement the interface OCP\\Share_Backend" => "Споделянето на сървърния %s трябва да поддържа OCP\\Share_Backend интерфейс.",
"Sharing backend %s not found" => "Споделянето на сървърния %s не е открито.",
"Sharing backend for %s not found" => "Споделянето на сървъра за %s не е открито.",
"Sharing %s failed, because the user %s is the original sharer" => "Споделяне на %s е неуспешно, защото потребител %s е оригиналния собственик.",
"Sharing %s failed, because the permissions exceed permissions granted to %s" => "Неуспешно споделяне на %s, защото промените надвишават правата на достъп дадени на %s.",
"Sharing %s failed, because resharing is not allowed" => "Неуспешно споделяне на %s, защото повторно споделяне не е разрешено.",
"Sharing %s failed, because the sharing backend for %s could not find its source" => "Неуспешно споделяне на %s, защото не е открит първоизточникът на %s, за да бъде споделяне по сървъра.",
"Sharing %s failed, because the file could not be found in the file cache" => "Неуспешно споделяне на %s, защото файлът не може да бъде намерен в кеша.",
"Could not find category \"%s\"" => "Невъзможно откриване на категорията \"%s\".",
"seconds ago" => "преди секунди",
"_%n minute ago_::_%n minutes ago_" => array("","преди %n минути"),
"_%n hour ago_::_%n hours ago_" => array("","преди %n часа"),
"today" => "днес",
"yesterday" => "вчера",
"_%n day go_::_%n days ago_" => array("","преди %n дена"),
"last month" => "миналия месец",
"_%n month ago_::_%n months ago_" => array("","преди %n месеца"),
"last year" => "миналата година",
"years ago" => "преди години",
"Only the following characters are allowed in a username: \"a-z\", \"A-Z\", \"0-9\", and \"_.@-\"" => "Само следните символи са разрешени в потребителското име: \"a-z\", \"A-Z\", \"0-9\", и \"_.@-\".",
"A valid username must be provided" => "Валидно потребителско име трябва да бъде зададено.",
"A valid password must be provided" => "Валидна парола трябва да бъде зададена.",
"The username is already being used" => "Това потребителско име е вече заето.",
"No database drivers (sqlite, mysql, or postgresql) installed." => "Липсват инсталирани драйвери за бази данни(sqlite, mysql или postgresql).",
"Permissions can usually be fixed by %sgiving the webserver write access to the root directory%s." => "Правата за достъп обикновено могат да бъдат оправени като %s даде разрешение на уеб сървъра да пише в root папката %s.",
"Cannot write into \"config\" directory" => "Неуспешен опит за запис в \"config\" папката.",
"Cannot write into \"apps\" directory" => "Неуспешен опит за запис в \"apps\" папката.",
"This can usually be fixed by %sgiving the webserver write access to the apps directory%s or disabling the appstore in the config file." => "Това обикновено може да бъде оправено като %s даде разрешение на уеб сървъра да записва в app папката %s или като изключи магазина за приложения в config файла.",
"Cannot create \"data\" directory (%s)" => "Неуспешен опит за създаване на \"data\" папката (%s).",
"This can usually be fixed by <a href=\"%s\" target=\"_blank\">giving the webserver write access to the root directory</a>." => "Това обикновено може да бъде оправено като <a href=\"%s\" target=\"_blank\">дадеш разрешение на уеб сървъра да записва в root  папката</a>.",
"Setting locale to %s failed" => "Неуспешно задаване на %s като настройка език-държава.",
"Please install one of theses locales on your system and restart your webserver." => "Моля, инсталирай една от тези език-държава комбинации на твоят сървър и рестартирай уеб сървъра.",
"Please ask your server administrator to install the module." => "Моля, поискай твоят администратор да инсталира модула.",
"PHP module %s not installed." => "PHP модулът %s не е инсталиран.",
"PHP %s or higher is required." => "Изисква се PHP %s или по-нова.",
"Please ask your server administrator to update PHP to the latest version. Your PHP version is no longer supported by ownCloud and the PHP community." => "Моля, поискай твоят администратор да обнови PHP до най-новата верския. Твоята PHP версия вече не се поддържа от ownCloud и PHP общността.",
"PHP Safe Mode is enabled. ownCloud requires that it is disabled to work properly." => "PHP Safe Mode е включен. ownCloud изисква този режим да бъде изключен, за да функионира нормално.",
"PHP Safe Mode is a deprecated and mostly useless setting that should be disabled. Please ask your server administrator to disable it in php.ini or in your webserver config." => "PHP Safe Mode е непропръчителна и общо взето безсмислена настройка и трябва да бъде изключена. Моля, поискай твоя администратор да я изключи ви php.ini или в конфигурацията на уве сървъра.",
"Magic Quotes is enabled. ownCloud requires that it is disabled to work properly." => "Magic Quotes е включен. ownCloud изисква да е изключен, за да функнионира нормално.",
"Magic Quotes is a deprecated and mostly useless setting that should be disabled. Please ask your server administrator to disable it in php.ini or in your webserver config." => "Magic Quotes е непропръчителна и общо взето безсмислена настройка и трябва да бъде изключена. Моля, поискай твоя администратор да я изключи ви php.ini или в конфигурацията на уве сървъра.",
"PHP modules have been installed, but they are still listed as missing?" => "PHP модулите са инсталирани, но все още се обявяват като липсващи?",
"Please ask your server administrator to restart the web server." => "Моля, поискай от своя администратор да рестартира уеб сървъра.",
"PostgreSQL >= 9 required" => "Изисква се PostgreSQL >= 9",
"Please upgrade your database version" => "Моля, обнови базата данни.",
"Error occurred while checking PostgreSQL version" => "Настъпи грешка при проверката на версията на PostgreSQL.",
"Please make sure you have PostgreSQL >= 9 or check the logs for more information about the error" => "Моля, увери се, че PostgreSQL >= 9 или провери докладите за повече информация относно грешката.",
"Please change the permissions to 0770 so that the directory cannot be listed by other users." => "Моля, промени правата за достъп на 0770, за да не може директорията да бъде видяна от други потребители.",
"Data directory (%s) is readable by other users" => "Data папката (%s) може да бъде разгледана от други потребители",
"Data directory (%s) is invalid" => "Data папката (%s) e невалидна",
"Please check that the data directory contains a file \".ocdata\" in its root." => "Моля, увери се, че data папката съдържа файл \".ocdata\" в себе си.",
"Could not obtain lock type %d on \"%s\"." => "Неуспешен опит за ексклузивен достъп от типa %d върху \"%s\"."
);
$PLURAL_FORMS = "nplurals=2; plural=(n != 1);";
