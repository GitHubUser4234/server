<?php
$TRANSLATIONS = array(
"Cannot write into \"config\" directory!" => "Запись в каталог \"config\" невозможна",
"This can usually be fixed by giving the webserver write access to the config directory" => "Обычно это можно исправить, предоставив веб-серверу права на запись в папке конфигурации",
"See %s" => "Просмотр %s",
"This can usually be fixed by %sgiving the webserver write access to the config directory%s." => "Обычно это можно исправить, %sпредоставив веб-серверу права на запись в папке конфигурации%s.",
"Sample configuration detected" => "Обнаружена конфигурация из примера",
"It has been detected that the sample configuration has been copied. This can break your installation and is unsupported. Please read the documentation before performing changes on config.php" => "Была обнаружена конфигурация из примера. Это может повредить вашей системе и это не поддерживается. Пожалуйста прочтите доументацию перед внесением изменений в файл config.php",
"Help" => "Помощь",
"Personal" => "Личное",
"Settings" => "Настройки",
"Users" => "Пользователи",
"Admin" => "Администрирование",
"App \\\"%s\\\" can't be installed because it is not compatible with this version of ownCloud." => "Невозможно установить приложение \\\"%s\\\", т.к. оно несовместимо с этой версией ownCloud.",
"No app name specified" => "Не указано имя приложения",
"Unknown filetype" => "Неизвестный тип файла",
"Invalid image" => "Изображение повреждено",
"web services under your control" => "веб-сервисы под вашим управлением",
"App directory already exists" => "Папка приложения уже существует",
"Can't create app folder. Please fix permissions. %s" => "Не удалось создать директорию. Исправьте права доступа. %s",
"No source specified when installing app" => "Не указан источник при установке приложения",
"No href specified when installing app from http" => "Не указан атрибут href при установке приложения через http",
"No path specified when installing app from local file" => "Не указан путь при установке приложения из локального файла",
"Archives of type %s are not supported" => "Архивы %s не поддерживаются",
"Failed to open archive when installing app" => "Не возможно открыть архив при установке приложения",
"App does not provide an info.xml file" => "Приложение не имеет файла info.xml",
"App can't be installed because of not allowed code in the App" => "Приложение невозможно установить. В нем содержится запрещенный код.",
"App can't be installed because it is not compatible with this version of ownCloud" => "Приложение невозможно установить. Не совместимо с текущей версией ownCloud.",
"App can't be installed because it contains the <shipped>true</shipped> tag which is not allowed for non shipped apps" => "Приложение невозможно установить. Оно содержит параметр <shipped>true</shipped> который не допустим для приложений, не входящих в поставку.",
"App can't be installed because the version in info.xml/version is not the same as the version reported from the app store" => "Приложение невозможно установить. Версия в info.xml/version не совпадает с версией заявленной в магазине приложений",
"Application is not enabled" => "Приложение не разрешено",
"Authentication error" => "Ошибка аутентификации",
"Token expired. Please reload page." => "Токен просрочен. Перезагрузите страницу.",
"Unknown user" => "Неизвестный пользователь",
"%s enter the database username." => "%s введите имя пользователя базы данных.",
"%s enter the database name." => "%s введите имя базы данных.",
"%s you may not use dots in the database name" => "%s Вы не можете использовать точки в имени базы данных",
"MS SQL username and/or password not valid: %s" => "Неверное имя пользователя и/или пароль MS SQL: %s",
"You need to enter either an existing account or the administrator." => "Вы должны войти или в существующий аккаунт или под администратором.",
"MySQL/MariaDB username and/or password not valid" => "Неверное имя пользователя и/или пароль MySQL/MariaDB",
"DB Error: \"%s\"" => "Ошибка БД: \"%s\"",
"Offending command was: \"%s\"" => "Вызываемая команда была: \"%s\"",
"MySQL/MariaDB user '%s'@'localhost' exists already." => "Пользователь MySQL '%s'@'localhost' уже существует.",
"Drop this user from MySQL/MariaDB" => "Удалить данного участника из MySQL/MariaDB",
"MySQL/MariaDB user '%s'@'%%' already exists" => "Пользователь MySQL '%s'@'%%' уже существует.",
"Drop this user from MySQL/MariaDB." => "Удалить данного участника из MySQL/MariaDB.",
"Oracle connection could not be established" => "соединение с Oracle не может быть установлено",
"Oracle username and/or password not valid" => "Неверное имя пользователя и/или пароль Oracle",
"Offending command was: \"%s\", name: %s, password: %s" => "Вызываемая команда была: \"%s\", имя: %s, пароль: %s",
"PostgreSQL username and/or password not valid" => "Неверное имя пользователя и/или пароль PostgreSQL",
"Set an admin username." => "Задать имя пользователя для admin.",
"Set an admin password." => "Задать пароль для admin.",
"Your web server is not yet properly setup to allow files synchronization because the WebDAV interface seems to be broken." => "Ваш веб сервер до сих пор не настроен правильно для возможности синхронизации файлов, похоже что проблема в неисправности интерфейса WebDAV.",
"Please double check the <a href='%s'>installation guides</a>." => "Пожалуйста, дважды просмотрите <a href='%s'>инструкции по установке</a>.",
"%s shared »%s« with you" => "%s поделился »%s« с вами",
"Sharing %s failed, because the file does not exist" => "Публикация %s неудачна, т.к. файл не существует",
"You are not allowed to share %s" => "Вам запрещено публиковать %s",
"Sharing %s failed, because the user %s is the item owner" => "Не удалось установить общий доступ для %s, пользователь %s уже  является владельцем",
"Sharing %s failed, because the user %s does not exist" => "Не удалось установить общий доступ для %s, пользователь %s не существует.",
"Sharing %s failed, because the user %s is not a member of any groups that %s is a member of" => "Не удалось опубликовать %s, т.к. пользователь %s не является членом какой-либо группы в которую входит %s",
"Sharing %s failed, because this item is already shared with %s" => "Не удалось установить общий доступ для %s ,в виду того что, объект уже находиться в общем доступе с %s",
"Sharing %s failed, because the group %s does not exist" => "Не удалось установить общий доступ для %s, группа %s не существует.",
"Sharing %s failed, because %s is not a member of the group %s" => "Не удалось установить общий доступ для %s, %s не является членом группы %s",
"You need to provide a password to create a public link, only protected links are allowed" => "Вам нужно задать пароль для создания публичной ссылки. Разрешены только защищённые ссылки",
"Sharing %s failed, because sharing with links is not allowed" => "Не удалось установить общий доступ для %s, потому что обмен со ссылками не допускается",
"Share type %s is not valid for %s" => "Такой тип общего доступа как %s не допустим для %s",
"Setting permissions for %s failed, because the permissions exceed permissions granted to %s" => "Настройка прав доступа для %s невозможна, поскольку права доступа превышают предоставленные права доступа %s",
"Setting permissions for %s failed, because the item was not found" => "Не удалось произвести настройку прав доступа для %s , элемент не был найден.",
"Cannot set expiration date. Expiration date is in the past" => "Невозможно установить дату окончания. Дата окончания в прошлом.",
"Sharing backend %s must implement the interface OCP\\Share_Backend" => "Бэкенд для опубликования %s должен реализовывать интерфейс OCP\\Share_Backend",
"Sharing backend %s not found" => "Бэкэнд для общего доступа %s не найден",
"Sharing backend for %s not found" => "Бэкэнд для общего доступа к %s не найден",
"Sharing %s failed, because the user %s is the original sharer" => "Публикация %s неудачна, т.к. пользователь %s - публикатор оригинала файла",
"Sharing %s failed, because the permissions exceed permissions granted to %s" => "Не удалось опубликовать %s, т.к. права %s превышают предоставленные права доступа ",
"Sharing %s failed, because resharing is not allowed" => "Публикация %s неудачна, т.к републикация запрещена",
"Sharing %s failed, because the sharing backend for %s could not find its source" => "Не удалось опубликовать %s, т.к. опубликованный бэкенд для %s не смог найти свой источник",
"Sharing %s failed, because the file could not be found in the file cache" => "Не удалось опубликовать %s, т.к. файл не был обнаружен в файловом кеше.",
"Could not find category \"%s\"" => "Категория \"%s\"  не найдена",
"seconds ago" => "несколько секунд назад",
"_%n minute ago_::_%n minutes ago_" => array("%n минута назад","%n минуты назад","%n минут назад"),
"_%n hour ago_::_%n hours ago_" => array("%n час назад","%n часа назад","%n часов назад"),
"today" => "сегодня",
"yesterday" => "вчера",
"_%n day go_::_%n days ago_" => array("%n день назад","%n дня назад","%n дней назад"),
"last month" => "в прошлом месяце",
"_%n month ago_::_%n months ago_" => array("%n месяц назад","%n месяца назад","%n месяцев назад"),
"last year" => "в прошлом году",
"years ago" => "несколько лет назад",
"Only the following characters are allowed in a username: \"a-z\", \"A-Z\", \"0-9\", and \"_.@-\"" => "Только следующие символы допускаются в имени пользователя: \"a-z\", \"A-Z\", \"0-9\", и \"_.@-\"",
"A valid username must be provided" => "Укажите правильное имя пользователя",
"A valid password must be provided" => "Укажите валидный пароль",
"The username is already being used" => "Имя пользователя уже используется",
"No database drivers (sqlite, mysql, or postgresql) installed." => "Не установлены драйвера баз данных (sqlite, mysql или postgresql)",
"Permissions can usually be fixed by %sgiving the webserver write access to the root directory%s." => "Обычно это можно исправить, %sпредоставив веб-серверу права на запись в корневой папке%s.",
"Cannot write into \"config\" directory" => "Запись в каталог \"config\" невозможна",
"Cannot write into \"apps\" directory" => "Запись в каталог \"app\" невозможна",
"This can usually be fixed by %sgiving the webserver write access to the apps directory%s or disabling the appstore in the config file." => "Обычно это можно исправить, %sпредоставив веб-серверу права на запись в папку приложений%s или отключив appstore в файле конфигурации.",
"Cannot create \"data\" directory (%s)" => "Невозможно создать каталог \"data\" (%s)",
"This can usually be fixed by <a href=\"%s\" target=\"_blank\">giving the webserver write access to the root directory</a>." => "Обычно это можно исправить, <a href=\"%s\" target=\"_blank\">предоставив веб-серверу права на запись в корневой папке.",
"Setting locale to %s failed" => "Установка локали в %s не удалась",
"Please ask your server administrator to install the module." => "Пожалуйста, попростите администратора сервера установить модуль.",
"PHP module %s not installed." => "Не установлен PHP-модуль %s.",
"PHP %s or higher is required." => "Требуется PHP %s или выше",
"Please ask your server administrator to update PHP to the latest version. Your PHP version is no longer supported by ownCloud and the PHP community." => "Пожалуйста, обратитесь к администратору сервера, чтобы обновить PHP до последней версии. Ваша версия PHP больше не поддерживается ownCloud и сообществом PHP.",
"PHP Safe Mode is enabled. ownCloud requires that it is disabled to work properly." => "Включен безопасный режим PHP. ownCloud требует, чтобы он был выключен для корректной работы.",
"PHP Safe Mode is a deprecated and mostly useless setting that should be disabled. Please ask your server administrator to disable it in php.ini or in your webserver config." => "Безопасный режим PHP не поддерживается и его следует выключить как практически бесполезную настройку. Пожалуйста, попросите администратора сервера выключить его в php.ini либо в вашей конфигурации веб-сервера.",
"Magic Quotes is enabled. ownCloud requires that it is disabled to work properly." => "Включен режим Magic Quotes. ownCloud требует, чтобы он был выключен для корректной работы.",
"Magic Quotes is a deprecated and mostly useless setting that should be disabled. Please ask your server administrator to disable it in php.ini or in your webserver config." => "Magic Quotes не поддерживается и его следует выключить как практически бесполезную настройку. Пожалуйста, попросите администратора сервера выключить его в php.ini либо в вашей конфигурации веб-сервера.",
"PHP modules have been installed, but they are still listed as missing?" => "Модули PHP был установлены, но все еще в списке как недостающие?",
"Please ask your server administrator to restart the web server." => "Пожалуйста, попросите администратора вашего сервера перезапустить веб-сервер.",
"PostgreSQL >= 9 required" => "Требуется PostgreSQL >= 9",
"Please upgrade your database version" => "Пожалуйста, обновите вашу версию базы данных",
"Error occurred while checking PostgreSQL version" => "Произошла ошибка при проверке версии PostgreSQL",
"Please make sure you have PostgreSQL >= 9 or check the logs for more information about the error" => "Пожалуйста, обедитесь что версия PostgreSQL >= 9 или проверьте логи за дополнительной информацией об ошибке",
"Please change the permissions to 0770 so that the directory cannot be listed by other users." => "Пожалуйста, измениите флаги разрешений на 0770 чтобы другие пользователи не могли получить списка файлов этой папки.",
"Data directory (%s) is readable by other users" => "Папка данных (%s) доступна для чтения другим пользователям",
"Data directory (%s) is invalid" => "Папка данных (%s) не верна",
"Please check that the data directory contains a file \".ocdata\" in its root." => "Пожалуйста, убедитесь, что папка данных содержит в корне файл \".ocdata\".",
"Could not obtain lock type %d on \"%s\"." => "Не удалось получить блокировку типа %d на \"%s\""
);
$PLURAL_FORMS = "nplurals=3; plural=(n%10==1 && n%100!=11 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2);";
