<?php
$TRANSLATIONS = array(
"Failed to clear the mappings." => "Не удалось очистить соотвествия.",
"Failed to delete the server configuration" => "Не удалось удалить конфигурацию сервера",
"The configuration is valid and the connection could be established!" => "Конфигурация правильная и подключение может быть установлено!",
"The configuration is valid, but the Bind failed. Please check the server settings and credentials." => "Конфигурация верна, но операция подключения завершилась неудачно. Пожалуйста, проверьте настройки сервера и учетные данные.",
"The configuration is invalid. Please look in the ownCloud log for further details." => "Конфигурация не верна. Пожалуйста, посмотрите в журнале ownCloud детали.",
"Deletion failed" => "Удаление не удалось",
"Take over settings from recent server configuration?" => "Принять настройки из последней конфигурации сервера?",
"Keep settings?" => "Сохранить настройки?",
"Cannot add server configuration" => "Не получилось добавить конфигурацию сервера",
"mappings cleared" => "Соответствия очищены",
"Success" => "Успешно",
"Error" => "Ошибка",
"Connection test succeeded" => "Проверка соединения удалась",
"Connection test failed" => "Проверка соединения не удалась",
"Do you really want to delete the current Server Configuration?" => "Вы действительно хотите удалить существующую конфигурацию сервера?",
"Confirm Deletion" => "Подтверждение удаления",
"<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." => "<b>Предупреждение:</b> Приложения user_ldap и user_webdavauth не совместимы. Вы можете наблюдать некорректное поведение. Пожалуйста попросите Вашего системного администратора отключить одно из них.",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>Внимание:</b> Модуль LDAP для PHP не установлен, бэкенд не будет работать. Пожалуйста, попросите вашего системного администратора его установить. ",
"Server configuration" => "Конфигурация сервера",
"Add Server Configuration" => "Добавить конфигурацию сервера",
"Host" => "Сервер",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "Можно опустить протокол, за исключением того, когда вам требуется SSL. Тогда начните с ldaps :/ /",
"Base DN" => "Базовый DN",
"One Base DN per line" => "По одному базовому DN в строке.",
"You can specify Base DN for users and groups in the Advanced tab" => "Вы можете задать Base DN для пользователей и групп на вкладке \"Расширенное\"",
"User DN" => "DN пользователя",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "DN-клиента пользователя, с которым связывают должно быть заполнено, например, uid=агент, dc=пример, dc=com. Для анонимного доступа, оставьте DN и пароль пустыми.",
"Password" => "Пароль",
"For anonymous access, leave DN and Password empty." => "Для анонимного доступа оставьте DN и пароль пустыми.",
"User Login Filter" => "Фильтр входа пользователей",
"User List Filter" => "Фильтр списка пользователей",
"Group Filter" => "Фильтр группы",
"Connection Settings" => "Настройки подключения",
"Configuration Active" => "Конфигурация активна",
"When unchecked, this configuration will be skipped." => "Когда галочка снята, эта конфигурация будет пропущена.",
"Port" => "Порт",
"Backup (Replica) Host" => "Адрес резервного сервера",
"Give an optional backup host. It must be a replica of the main LDAP/AD server." => "Укажите дополнительный резервный сервер. Он должен быть репликой главного LDAP/AD сервера.",
"Backup (Replica) Port" => "Порт резервного сервера",
"Disable Main Server" => "Отключение главного сервера",
"Use TLS" => "Использовать TLS",
"Do not use it additionally for LDAPS connections, it will fail." => "Не используйте совместно с безопасными подключениями (LDAPS), это не сработает.",
"Case insensitve LDAP server (Windows)" => "Нечувствительный к регистру сервер LDAP (Windows)",
"Turn off SSL certificate validation." => "Отключить проверку сертификата SSL.",
"Cache Time-To-Live" => "Кэш времени жизни",
"in seconds. A change empties the cache." => "в секундах. Изменение очистит кэш.",
"Directory Settings" => "Настройки каталога",
"User Display Name Field" => "Поле отображаемого имени пользователя",
"Base User Tree" => "База пользовательского дерева",
"One User Base DN per line" => "По одной базовому DN пользователей в строке.",
"User Search Attributes" => "Поисковые атрибуты пользователя",
"Optional; one attribute per line" => "Опционально; один атрибут на линию",
"Group Display Name Field" => "Поле отображаемого имени группы",
"Base Group Tree" => "База группового дерева",
"One Group Base DN per line" => "По одной базовому DN групп в строке.",
"Group Search Attributes" => "Атрибуты поиска для группы",
"Group-Member association" => "Ассоциация Группа-Участник",
"Special Attributes" => "Специальные атрибуты",
"Quota Field" => "Поле квота",
"Quota Default" => "Квота по умолчанию",
"in bytes" => "в байтах",
"Email Field" => "Поле адресса эллектронной почты",
"User Home Folder Naming Rule" => "Правило именования Домашней Папки Пользователя",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "Оставьте имя пользователя пустым (по умолчанию). Иначе укажите атрибут LDAP/AD.",
"Internal Username" => "Внутреннее имя пользователя",
"Internal Username Attribute:" => "Аттрибут для внутреннего имени:",
"Override UUID detection" => "Переопределить нахождение UUID",
"UUID Attribute:" => "Аттрибут для UUID:",
"Username-LDAP User Mapping" => "Соответствия Имя-Пользователь LDAP",
"Clear Username-LDAP User Mapping" => "Очистить соответствия Имя-Пользователь LDAP",
"Clear Groupname-LDAP Group Mapping" => "Очистить соответствия Группа-Группа LDAP",
"Test Configuration" => "Тестовая конфигурация",
"Help" => "Помощь"
);
$PLURAL_FORMS = "nplurals=3; plural=(n%10==1 && n%100!=11 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2);";
