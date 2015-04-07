OC.L10N.register(
    "user_ldap",
    {
    "Failed to clear the mappings." : "Неуспело чишћење мапирања.",
    "Failed to delete the server configuration" : "Неуспело брисање серверске конфугирације",
    "The configuration is valid and the connection could be established!" : "Конфигурација је важећа и веза се може успоставити!",
    "The configuration is valid, but the Bind failed. Please check the server settings and credentials." : "Конфигурација је важећа, али Bind није успео. Проверите подешавања сервера и акредитиве.",
    "The configuration is invalid. Please have a look at the logs for further details." : "Конфигурација није важећа. Погледајте у дневнику записа за додатне детаље.",
    "No action specified" : "Није наведена акција",
    "No configuration specified" : "Није наведена конфигурација",
    "No data specified" : "Нису наведени подаци",
    " Could not set configuration %s" : "Нисам могао да подесим конфигурацију %s",
    "Deletion failed" : "Брисање није успело",
    "Take over settings from recent server configuration?" : "Преузми подешавања са недавних конфигурација сервера?",
    "Keep settings?" : "Задржати поставке?",
    "{nthServer}. Server" : "{nthServer}. Сервер",
    "Cannot add server configuration" : "Не могу да додам конфигурацију сервера",
    "mappings cleared" : "мапирања су очишћена",
    "Success" : "Успешно",
    "Error" : "Грешка",
    "Please specify a Base DN" : "Наведите Base DN",
    "Could not determine Base DN" : "Не могу да одредим Base DN",
    "Please specify the port" : "Наведите порт",
    "Configuration OK" : "Конфигурација је у реду",
    "Configuration incorrect" : "Конфигурација је неисправна",
    "Configuration incomplete" : "Конфигурација није комплетна",
    "Select groups" : "Изаберите групе",
    "Select object classes" : "Изаберите класе објеката",
    "Select attributes" : "Изаберите атрибуте",
    "Connection test succeeded" : "Тест повезивања је успешан",
    "Connection test failed" : "Тест повезивања није успешан",
    "Do you really want to delete the current Server Configuration?" : "Да ли стварно желите да обришете тренутну конфигурацију сервера?",
    "Confirm Deletion" : "Потврдa брисањa",
    "_%s group found_::_%s groups found_" : ["нађена %s група","нађене %s групе","нађено %s група"],
    "_%s user found_::_%s users found_" : ["нађен %s корисник","нађена %s корисника","нађено %s корисника"],
    "Could not detect user display name attribute. Please specify it yourself in advanced ldap settings." : "Немогу да откријем особину приказивања корисниковог имена. Наведите је у напредним поставкама LDAP-a",
    "Could not find the desired feature" : "Не могу да пронађем жељену особину",
    "Invalid Host" : "Неважећи домаћин",
    "Server" : "Сервер",
    "User Filter" : "Филтер корисника",
    "Login Filter" : "Филтер пријављивања",
    "Group Filter" : "Филтер групе",
    "Save" : "Сачувај",
    "Test Configuration" : "Тестирај конфигурацију",
    "Help" : "Помоћ",
    "Groups meeting these criteria are available in %s:" : "Групе које испуњавају ове критеријуме су доступне у %s:",
    "only those object classes:" : "само ове класе објеката:",
    "only from those groups:" : "само из ових група:",
    "Edit raw filter instead" : "Уреди сирови филтер",
    "Raw LDAP filter" : "Сирови LDAP филтер",
    "The filter specifies which LDAP groups shall have access to the %s instance." : "Филтер прецизира које ће LDAP групе требају имати приступ %s случају.",
    "Test Filter" : "Тестни филтер",
    "groups found" : "пронађене групе",
    "Users login with this attribute:" : "Корисници се логују са овим параметром:",
    "LDAP Username:" : "LDAP корисничко име:",
    "LDAP Email Address:" : "LDAP адреса е-поште",
    "Other Attributes:" : "Остали параметри:",
    "Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action. Example: \"uid=%%uid\"" : "Одређује филтер који ће се применити при покушају пријављивања. %%uid замењује корисничко име при пријављивању. Пример: \"uid=%%uid\"",
    "1. Server" : "1. сервер",
    "%s. Server:" : "%s. Сервер:",
    "Add Server Configuration" : "Додај конфигурацију сервера",
    "Delete Configuration" : "Обриши конфигурацију",
    "Host" : "Домаћин",
    "You can omit the protocol, except you require SSL. Then start with ldaps://" : "Можете да изоставите протокол, осим ако захтевате ССЛ. У том случају почните са ldaps://",
    "Port" : "Порт",
    "User DN" : "Корисников DN",
    "The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." : "DN корисника клијента са којим треба да се успостави веза, нпр. uid=agent,dc=example,dc=com. За анониман приступ, оставите поља DN и лозинка празним.",
    "Password" : "Лозинка",
    "For anonymous access, leave DN and Password empty." : "За анониман приступ, оставите поља DN и лозинка празним.",
    "One Base DN per line" : "Једна Base DN по линији",
    "You can specify Base DN for users and groups in the Advanced tab" : "Можете навести Base DN за кориснике и групе у картици Напредно",
    "Avoids automatic LDAP requests. Better for bigger setups, but requires some LDAP knowledge." : "Избегава аутоматске LDAP захтеве. Боље за веће поставке, али тражи мало више познавања LDAP-а.",
    "Manually enter LDAP filters (recommended for large directories)" : "Унесите ручно LDAP филтере (препоручено за велике директоријуме)",
    "Limit %s access to users meeting these criteria:" : "Ограничи %s приступа за кориснике који испуњавају ове критеријуме:",
    "The filter specifies which LDAP users shall have access to the %s instance." : "Филтер одређује који ЛДАП корисници ће имати приступ на %s.",
    "users found" : "пронађених корисника",
    "Saving" : "Чувам",
    "Back" : "Назад",
    "Continue" : "Настави",
    "LDAP" : "LDAP",
    "Expert" : "Стручњак",
    "Advanced" : "Напредно",
    "<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." : "<b>Упозорење:</b> Апликације user_ldap и user_webdavauth нису компатибилне. Можете имати проблема. Питајте систем администратора да искључи једну од њих.",
    "<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." : "<b>Упозорење:</b> ПХП ЛДАП модул није инсталиран и зачеље неће радити. Питајте систем администратора да га инсталира.",
    "Connection Settings" : "Подешавања везе",
    "Configuration Active" : "Конфигурација активна",
    "When unchecked, this configuration will be skipped." : "Када није штриклирано, ова конфигурација ће бити прескочена.",
    "Backup (Replica) Host" : "Домаћин Резервне копије (Реплике)",
    "Give an optional backup host. It must be a replica of the main LDAP/AD server." : "Наведите опционог домаћина за резервне копије. Он мора бити реплика главног ЛДАП/АД сервера.",
    "Backup (Replica) Port" : "Порт Резервне копије (Реплике)",
    "Disable Main Server" : "Онемогући главни сервер",
    "Only connect to the replica server." : "Повезано само на сервер за копирање.",
    "Case insensitive LDAP server (Windows)" : "LDAP сервер неосетљив на велика и мала слова (Windows)",
    "Turn off SSL certificate validation." : "Искључите потврду ССЛ сертификата.",
    "Not recommended, use it for testing only! If connection only works with this option, import the LDAP server's SSL certificate in your %s server." : "Није препоручено, користите само за тестирање! Ако веза ради само са овом опцијом, увезите SSL сертификате LDAP сервера на ваш %s сервер.",
    "Cache Time-To-Live" : "Трајност кеша",
    "in seconds. A change empties the cache." : "у секундама. Промена празни кеш меморију.",
    "Directory Settings" : "Подешавања директоријума",
    "User Display Name Field" : "Име приказа корисника",
    "The LDAP attribute to use to generate the user's display name." : "LDAP особина за стварање имена за приказ корисника.",
    "Base User Tree" : "Основно стабло корисника",
    "One User Base DN per line" : "Један Корисников јединствени назив DN по линији",
    "User Search Attributes" : "Параметри претраге корисника",
    "Optional; one attribute per line" : "Опционо; један параметар по линији",
    "Group Display Name Field" : "Име приказа групе",
    "The LDAP attribute to use to generate the groups's display name." : "LDAP параметар за формирање имена за приказ група.",
    "Base Group Tree" : "Стабло основне групе",
    "One Group Base DN per line" : "Један Групни јединствени назив DN по линији",
    "Group Search Attributes" : "Параметри претраге група",
    "Group-Member association" : "Придруживање чланова у групу",
    "Nested Groups" : "Угнеждене групе",
    "When switched on, groups that contain groups are supported. (Only works if the group member attribute contains DNs.)" : "Када је укључено, подржане су групе унутар групе. (Ради само ако особина члана групе садржи DN-ове.)",
    "Special Attributes" : "Посебни параметри",
    "Quota Field" : "Поље квоте",
    "Quota Default" : "Подразумевана квота",
    "in bytes" : "у бајтовима",
    "Email Field" : "Поље е-поште",
    "User Home Folder Naming Rule" : "Правило именовања корисничке фасцикле",
    "Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." : "Оставите празно за корисничко име (подразумевано). У супротном, наведите особину LDAP/AD.",
    "Internal Username" : "Интерно корисничко име:",
    "By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder. It is also a part of remote URLs, for instance for all *DAV services. With this setting, the default behavior can be overridden. To achieve a similar behavior as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users." : "Интерно корисничко име ће бити креирано од UUID атрибута. То осигурава да је корисничко име јединствено и да карактери не треба да се конвертују. Интерно корисничко име има ограничење да се само ови карактери дозвољени: [ a-zA-Z0-9_.@- ].  Остали карактери се мењају са њиховим ASCII кореспондентима или се једноставно изостављају. У случају сударања биће додат / повећан број. Интерно корисничко име се користи за интерну идентификацију корисника. Такође је подразумевано име за главну корисничку фасциклу. Такође је део удаљених адреса, на пример за све *DAV сервисе. Са овом поставком, подразумевано понашање се може заобићи. Да би се постигло слично понашање као пре ownCloud 5 унесите атрибут за приказ имена корисника у следеће поље. Оставите празно за подразумевано понашање. Промене ће имати дејство само на новомапираним (доданим) LDAP корисницима и групама.",
    "Internal Username Attribute:" : "Интерни параметри корисничког имена:",
    "Override UUID detection" : "Прескочи UUID откривање",
    "By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." : "Подразумевано, атрибут UUID се аутоматски детектује. Атрибут UUID се користи за сигурну идентификацију LDAP корисника и група. Такође, локално корисничко име ће бити креирано на основу UUID-a, ако није другачије назначено. Можете заобићи поставке и проследити други атрибут по вашем избору. Морате бити сигурни да је изабрани атрибут јединствен и да га корисници и групе могу преносити. Оставите празно за подразумевано понашање. Промене ће имати дејство само на новомапираним (доданим) LDAP корисницима и групама.",
    "UUID Attribute for Users:" : "UUID параметри за кориснике:",
    "UUID Attribute for Groups:" : "UUID параметри за групе:",
    "Username-LDAP User Mapping" : "Username-LDAP мапирање корисника",
    "Usernames are used to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have an internal username. This requires a mapping from username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found. The internal username is used all over. Clearing the mappings will have leftovers everywhere. Clearing the mappings is not configuration sensitive, it affects all LDAP configurations! Never clear the mappings in a production environment, only in a testing or experimental stage." : "Корисничка имена се користи за чување и додељивање (мета) података. Да би се прецизно идентификовали и препознавали кориснике, сваки LDAP корисник ће имати локално корисничко име. Ово захтева мапирање од корисничког имена до LDAP корисника. Креирано корисничко име се мапира у UUID LDAP корисника. Поред тога, DN се кешира да смањи LDAP интеракцију, али се не користи за идентификацију. Ако се DN мења, промене се могу наћи. Локално корисничко име се користи свуда. Чишћење мапирања оставља свуда остатке. Чишћење мапирања није осетљиво на конфигурацију, оно утиче на све LDAP конфигурације!  Никада не користит чишћење мапирања у радном окружењу, већ само у тестирању или експерименталној фази.",
    "Clear Username-LDAP User Mapping" : "Очисти Username-LDAP мапирање корисника",
    "Clear Groupname-LDAP Group Mapping" : "Очисти Groupname-LDAP мапирање група"
},
"nplurals=3; plural=(n%10==1 && n%100!=11 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2);");
