OC.L10N.register(
    "user_ldap",
    {
    "Failed to clear the mappings." : "Не вдалося очистити відображення.",
    "Failed to delete the server configuration" : "Не вдалося видалити конфігурацію сервера",
    "The configuration is valid and the connection could be established!" : "Конфігурація вірна і зв'язок може бути встановлений ​​!",
    "The configuration is valid, but the Bind failed. Please check the server settings and credentials." : "Конфігурація вірна, але встановити зв'язок не вдалося. Будь ласка, перевірте налаштування сервера і облікові дані.",
    "The configuration is invalid. Please have a look at the logs for further details." : "Конфігурація є недійсною. Будь ласка, дивіться журнали для отримання додаткової інформації.",
    "No action specified" : "Ніяких дій не вказано",
    "No configuration specified" : "Немає конфігурації",
    "No data specified" : "Немає даних",
    " Could not set configuration %s" : "Не вдалося встановити конфігурацію %s",
    "Configuration incorrect" : "Невірна конфігурація",
    "Configuration incomplete" : "Конфігурація неповна",
    "Configuration OK" : "Конфігурація OK",
    "Select groups" : "Оберіть групи",
    "Select object classes" : "Виберіть класи об'єктів",
    "{nthServer}. Server" : "{nthServer}. Сервер",
    "Do you really want to delete the current Server Configuration?" : "Ви дійсно бажаєте видалити поточну конфігурацію сервера ?",
    "Confirm Deletion" : "Підтвердіть Видалення",
    "Select attributes" : "Виберіть атрибути",
    "_%s group found_::_%s groups found_" : [" %s група знайдена "," %s груп знайдено ","%s груп знайдено "],
    "_%s user found_::_%s users found_" : ["%s користувача знайдено","%s користувачів знайдено","%s користувачів знайдено"],
    "Could not detect user display name attribute. Please specify it yourself in advanced ldap settings." : "Не вдалося виявити ім'я користувача. Будь ласка, сформулюйте самі в розширених налаштуваннях LDAP.",
    "Could not find the desired feature" : "Не вдалося знайти потрібну функцію",
    "Invalid Host" : "Невірний Host",
    "Server" : "Сервер",
    "Users" : "Користувачі",
    "Groups" : "Групи",
    "Test Configuration" : "Тестове налаштування",
    "Help" : "Допомога",
    "Groups meeting these criteria are available in %s:" : "Групи, що відповідають цим критеріям доступні в %s:",
    "Search groups" : "Пошук груп",
    "Available groups" : "Доступні групи",
    "Selected groups" : "Обрані групи",
    "The filter specifies which LDAP groups shall have access to the %s instance." : "Фільтр визначає, які LDAP групи повинні мати доступ до %s примірника.",
    "Other Attributes:" : "Інші Атрибути:",
    "Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action. Example: \"uid=%%uid\"" : "Визначає фільтр, який слід застосовувати при спробі входу.\n%%uid замінює ім'я користувача при вході в систему. Приклад: \"uid=%%uid\"",
    "1. Server" : "1. Сервер",
    "%s. Server:" : "%s. Сервер:",
    "Host" : "Хост",
    "You can omit the protocol, except you require SSL. Then start with ldaps://" : "Можна не вказувати протокол, якщо вам не потрібен SSL. Тоді почніть з ldaps://",
    "Port" : "Порт",
    "Detect Port" : "Визначити Порт",
    "User DN" : "DN Користувача",
    "The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." : "DN клієнтського користувача для прив'язки, наприклад: uid=agent,dc=example,dc=com. Для анонімного доступу, залиште DN і Пароль порожніми.",
    "Password" : "Пароль",
    "For anonymous access, leave DN and Password empty." : "Для анонімного доступу, залиште DN і Пароль порожніми.",
    "One Base DN per line" : "Один Base DN на рядок",
    "You can specify Base DN for users and groups in the Advanced tab" : "Ви можете задати Базовий DN для користувачів і груп на вкладинці Додатково",
    "Avoids automatic LDAP requests. Better for bigger setups, but requires some LDAP knowledge." : "Уникати автоматичні запити LDAP. Краще для великих установок, але вимагає деякого LDAP знання.",
    "Manually enter LDAP filters (recommended for large directories)" : "Вручну введіть LDAP фільтри (рекомендується для великих каталогів)",
    "Limit %s access to users meeting these criteria:" : "Обмежити %s доступ до користувачів, що відповідають цим критеріям:",
    "The filter specifies which LDAP users shall have access to the %s instance." : "Фільтр визначає, які користувачі LDAP повинні мати доступ до примірника %s.",
    "Saving" : "Збереження",
    "Back" : "Назад",
    "Continue" : "Продовжити",
    "LDAP" : "LDAP",
    "Expert" : "Експерт",
    "Advanced" : "Додатково",
    "<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." : "<b>Попередження:</b> Застосунки user_ldap та user_webdavauth не сумісні. Ви можете зіткнутися з несподіваною поведінкою. Будь ласка, зверніться до системного адміністратора, щоб відключити одну з них.",
    "<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." : "<b>Увага:</ b> Потрібний модуль PHP LDAP не встановлено, базова програма працювати не буде. Будь ласка, зверніться до системного адміністратора, щоб встановити його.",
    "Connection Settings" : "Налаштування З'єднання",
    "Configuration Active" : "Налаштування Активне",
    "When unchecked, this configuration will be skipped." : "Якщо \"галочка\" знята, ця конфігурація буде пропущена.",
    "Backup (Replica) Host" : "Сервер для резервних копій",
    "Give an optional backup host. It must be a replica of the main LDAP/AD server." : "Вкажіть додатковий резервний сервер. Він повинен бути копією головного LDAP/AD сервера.",
    "Backup (Replica) Port" : "Порт сервера для резервних копій",
    "Disable Main Server" : "Вимкнути Головний Сервер",
    "Only connect to the replica server." : "Підключити тільки до сервера реплік.",
    "Case insensitive LDAP server (Windows)" : "Без урахування регістра LDAP сервер (Windows)",
    "Turn off SSL certificate validation." : "Вимкнути перевірку SSL сертифіката.",
    "Not recommended, use it for testing only! If connection only works with this option, import the LDAP server's SSL certificate in your %s server." : "Не рекомендується, використовувати його тільки для тестування!\nЯкщо з'єднання працює лише з цією опцією, імпортуйте SSL сертифікат LDAP сервера у ваший %s сервер.",
    "Cache Time-To-Live" : "Час актуальності Кеша",
    "in seconds. A change empties the cache." : "в секундах. Зміна очищує кеш.",
    "Directory Settings" : "Налаштування Каталогу",
    "User Display Name Field" : "Поле, яке відображає Ім'я Користувача",
    "The LDAP attribute to use to generate the user's display name." : "Атрибут LDAP, який використовується для генерації імен користувачів.",
    "Base User Tree" : "Основне Дерево Користувачів",
    "One User Base DN per line" : "Один Користувач Base DN на рядок",
    "User Search Attributes" : "Пошукові Атрибути Користувача",
    "Optional; one attribute per line" : "Додатково; один атрибут на рядок",
    "Group Display Name Field" : "Поле, яке відображає Ім'я Групи",
    "The LDAP attribute to use to generate the groups's display name." : "Атрибут LDAP, який використовується для генерації імен груп.",
    "Base Group Tree" : "Основне Дерево Груп",
    "One Group Base DN per line" : "Одна Група Base DN на рядок",
    "Group Search Attributes" : "Пошукові Атрибути Групи",
    "Group-Member association" : "Асоціація Група-Член",
    "Nested Groups" : "Вкладені Групи",
    "When switched on, groups that contain groups are supported. (Only works if the group member attribute contains DNs.)" : "При включенні, групи, які містять групи підтримуються. (Працює тільки якщо атрибут члена групи містить DNS.)",
    "Paging chunksize" : "Розмір підкачки",
    "Chunksize used for paged LDAP searches that may return bulky results like user or group enumeration. (Setting it 0 disables paged LDAP searches in those situations.)" : "Підкачка використовується для сторінкових пошуків LDAP, які можуть повертати громіздкі результати кількісті користувачів або груп. (Установка його 0 відключає вивантаженя пошуку LDAP в таких ситуаціях.)",
    "Special Attributes" : "Спеціальні Атрибути",
    "Quota Field" : "Поле Квоти",
    "Quota Default" : "Квота за замовчанням",
    "in bytes" : "в байтах",
    "Email Field" : "Поле E-mail",
    "User Home Folder Naming Rule" : "Правило іменування домашньої теки користувача",
    "Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." : "Залиште порожнім для імені користувача (за замовчанням). Інакше, вкажіть атрибут LDAP/AD.",
    "Internal Username" : "Внутрішня Ім'я користувача",
    "By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder. It is also a part of remote URLs, for instance for all *DAV services. With this setting, the default behavior can be overridden. To achieve a similar behavior as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users." : "За замовчуванням внутрішнє ім'я користувача буде створено з атрибуту UUID. Таким чином ім'я користувача є унікальним і не потребує перетворення символів. Внутрішнє ім'я користувача може складатися лише з наступних символів: [A-Za-z0-9 _ @ -.]. Інші символи заміняються відповідними з таблиці ASCII або пропускаються. При збігу до імені буде додано або збільшено число. Внутрішнє ім'я користувача використовується для внутрішньої ідентифікації користувача. Це також ім'я за замовчуванням для домашньої теки користувача та частина віддалених URL, наприклад, для всіх сервісів *DAV. За допомогою цієї установки можна змінити поведінку за замовчуванням. Для досягнення поведінки, що була до OwnCloud 5, введіть атрибут ім'я користувача, що відображається,  в наступне поле. Залиште порожнім для режиму за замовчуванням. Зміни будуть діяти тільки для нових підключень (доданих) користувачів LDAP.",
    "Internal Username Attribute:" : "Внутрішня Ім'я користувача, Атрибут:",
    "Override UUID detection" : "Перекрити вивід UUID ",
    "By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." : "За замовчуванням ownCloud визначає атрибут UUID автоматично. Цей атрибут використовується для того, щоб достовірно ідентифікувати користувачів і групи LDAP. Також на підставі атрибута UUID створюється внутрішнє ім'я користувача, якщо вище не вказано інакше. Ви можете перевизначити це налаштування та вказати свій атрибут за вибором. Ви повинні упевнитися, що обраний вами атрибут може бути вибраний для користувачів і груп, а також те, що він унікальний. Залиште поле порожнім для поведінки за замовчуванням. Зміни вступлять в силу тільки для нових підключених (доданих) користувачів і груп LDAP.",
    "UUID Attribute for Users:" : "UUID Атрибут для користувачів:",
    "UUID Attribute for Groups:" : "UUID Атрибут для груп:",
    "Username-LDAP User Mapping" : "Картографія Імен користувачів-LDAP ",
    "Usernames are used to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have an internal username. This requires a mapping from username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found. The internal username is used all over. Clearing the mappings will have leftovers everywhere. Clearing the mappings is not configuration sensitive, it affects all LDAP configurations! Never clear the mappings in a production environment, only in a testing or experimental stage." : "ownCloud використовує імена користувачів для зберігання та призначення метаданих. Для точної ідентифікації та розпізнавання користувачів, кожен користувач LDAP буде мати своє внутрішнє ім'я користувача. Це вимагає прив'язки імені користувача ownCloud до користувача LDAP. При створенні ім'я користувача призначається ідентифікатором UUID користувача LDAP. Крім цього кешируєтся доменне ім'я (DN) для зменшення числа звернень до LDAP, однак воно не використовується для ідентифікації. Якщо доменне ім'я було змінено, про це стане відомо ownCloud. Внутрішнє ім'я ownCloud використовується повсюдно в ownCloud. Після скидання прив'язок в базі можуть зберегтися залишки старої інформації. Скидання прив'язок не прив'язане до конфігурації, воно вплине на всі LDAP підключення! Ні в якому разі не рекомендується скидати прив'язки якщо система вже знаходиться в експлуатації, тільки на етапі тестування.",
    "Clear Username-LDAP User Mapping" : "Очистити картографію Імен користувачів-LDAP",
    "Clear Groupname-LDAP Group Mapping" : "Очистити картографію Імен груп-LDAP"
},
"nplurals=3; plural=(n%10==1 && n%100!=11 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2);");
