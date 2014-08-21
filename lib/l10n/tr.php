<?php
$TRANSLATIONS = array(
"Cannot write into \"config\" directory!" => "\"config\" dizinine yazılamıyor!",
"This can usually be fixed by giving the webserver write access to the config directory" => "Bu genellikle, web sunucusuna config dizinine yazma erişimi verilerek çözülebilir",
"See %s" => "Bakınız: %s",
"This can usually be fixed by %sgiving the webserver write access to the config directory%s." => "Bu genellikle, %sweb sunucusuna config dizinine yazma erişimi verilerek%s çözülebilir",
"Sample configuration detected" => "Örnek yapılandırma tespit edildi",
"It has been detected that the sample configuration has been copied. This can break your installation and is unsupported. Please read the documentation before performing changes on config.php" => "Örnek yapılandırmanın kopyalanmış olabileceği tespit edildi. Bu kurulumunuzu bozabilir ve desteklenmemektedir. Lütfen config.php dosyasında değişiklik yapmadan önce belgelendirmeyi okuyun",
"You are accessing the server from an untrusted domain." => "Sunucuya güvenilmeyen bir alan adından ulaşıyorsunuz.",
"Please contact your administrator. If you are an administrator of this instance, configure the \"trusted_domain\" setting in config/config.php. An example configuration is provided in config/config.sample.php." => "Lütfen yöneticiniz ile iletişime geçin. Eğer bu örneğin bir yöneticisi iseniz, config/config.php dosyası içerisindeki \"trusted_domain\" ayarını yapılandırın. Bu yapılandırmanın bir örneği config/config.sample.php dosyasında verilmiştir.",
"Help" => "Yardım",
"Personal" => "Kişisel",
"Settings" => "Ayarlar",
"Users" => "Kullanıcılar",
"Admin" => "Yönetici",
"App \\\"%s\\\" can't be installed because it is not compatible with this version of ownCloud." => "ownCloud yazılımının bu sürümü ile uyumlu  olmadığı için \\\"%s\\\" uygulaması kurulamaz.",
"No app name specified" => "Uygulama adı belirtilmedi",
"Unknown filetype" => "Bilinmeyen dosya türü",
"Invalid image" => "Geçersiz resim",
"web services under your control" => "denetiminizdeki web hizmetleri",
"App directory already exists" => "Uygulama dizini zaten mevcut",
"Can't create app folder. Please fix permissions. %s" => "Uygulama dizini oluşturulamıyor. Lütfen izinleri düzeltin. %s",
"No source specified when installing app" => "Uygulama kurulurken bir kaynak belirtilmedi",
"No href specified when installing app from http" => "Uygulama http'den kurulurken href belirtilmedi",
"No path specified when installing app from local file" => "Uygulama yerel dosyadan kurulurken dosya yolu belirtilmedi",
"Archives of type %s are not supported" => "%s arşiv türü desteklenmiyor",
"Failed to open archive when installing app" => "Uygulama kurulurken arşiv dosyası açılamadı",
"App does not provide an info.xml file" => "Uygulama info.xml dosyası sağlamıyor",
"App can't be installed because of not allowed code in the App" => "Uygulama, izin verilmeyen kodlar barındırdığından kurulamıyor",
"App can't be installed because it is not compatible with this version of ownCloud" => "ownCloud sürümünüz ile uyumsuz olduğu için uygulama kurulamıyor",
"App can't be installed because it contains the <shipped>true</shipped> tag which is not allowed for non shipped apps" => "Uygulama, birlikte gelmeyen uygulama olmasına rağmen <shipped>true</shipped> etiketi içerdiği için kurulamıyor",
"App can't be installed because the version in info.xml/version is not the same as the version reported from the app store" => "Uygulama info.xml/version ile uygulama marketinde belirtilen sürüm aynı olmadığından kurulamıyor",
"Application is not enabled" => "Uygulama etkin değil",
"Authentication error" => "Kimlik doğrulama hatası",
"Token expired. Please reload page." => "Belirteç süresi geçti. Lütfen sayfayı yenileyin.",
"Unknown user" => "Bilinmeyen kullanıcı",
"%s enter the database username." => "%s veritabanı kullanıcı adını girin.",
"%s enter the database name." => "%s veritabanı adını girin.",
"%s you may not use dots in the database name" => "%s veritabanı adında nokta kullanamayabilirsiniz",
"MS SQL username and/or password not valid: %s" => "MS SQL kullanıcı adı ve/veya parolası geçersiz: %s",
"You need to enter either an existing account or the administrator." => "Mevcut bit hesap ya da yönetici hesabını girmelisiniz.",
"MySQL/MariaDB username and/or password not valid" => "MySQL/MariaDB kullanıcı adı ve/veya parolası geçersiz",
"DB Error: \"%s\"" => "VT Hatası: \"%s\"",
"Offending command was: \"%s\"" => "Saldırgan komut: \"%s\"",
"MySQL/MariaDB user '%s'@'localhost' exists already." => "MySQL/MariaDB kullanıcı '%s'@'localhost' zaten mevcut.",
"Drop this user from MySQL/MariaDB" => "Bu kullanıcıyı MySQL/MariaDB'dan at (drop)",
"MySQL/MariaDB user '%s'@'%%' already exists" => "MySQL/MariaDB kullanıcısı '%s'@'%%' zaten mevcut",
"Drop this user from MySQL/MariaDB." => "Bu kullanıcıyı MySQL/MariaDB'dan at (drop).",
"Oracle connection could not be established" => "Oracle bağlantısı kurulamadı",
"Oracle username and/or password not valid" => "Oracle kullanıcı adı ve/veya parolası geçerli değil",
"Offending command was: \"%s\", name: %s, password: %s" => "Hatalı komut: \"%s\", ad: %s, parola: %s",
"PostgreSQL username and/or password not valid" => "PostgreSQL  kullanıcı adı ve/veya parolası geçerli değil",
"Set an admin username." => "Bir yönetici kullanıcı adı ayarlayın.",
"Set an admin password." => "Bir yönetici kullanıcı parolası ayarlayın.",
"Your web server is not yet properly setup to allow files synchronization because the WebDAV interface seems to be broken." => "Web sunucunuz dosya eşitlemesine izin vermek üzere düzgün bir şekilde yapılandırılmamış. WebDAV arayüzü sorunlu görünüyor.",
"Please double check the <a href='%s'>installation guides</a>." => "Lütfen <a href='%s'>kurulum kılavuzlarını</a> iki kez kontrol edin.",
"%s shared »%s« with you" => "%s sizinle »%s« paylaşımında bulundu",
"Sharing %s failed, because the file does not exist" => "%s paylaşımı, dosya mevcut olmadığından başarısız oldu",
"You are not allowed to share %s" => "%s paylaşımını yapma izniniz yok",
"Sharing %s failed, because the user %s is the item owner" => "%s paylaşımı, %s öge sahibi olduğundan başarısız oldu",
"Sharing %s failed, because the user %s does not exist" => "%s paylaşımı, %s kullanıcısı mevcut olmadığından başarısız oldu",
"Sharing %s failed, because the user %s is not a member of any groups that %s is a member of" => "%s paylaşımı, %s kullanıcısının %s üyeliklerinden birine sahip olmadığından başarısız oldu",
"Sharing %s failed, because this item is already shared with %s" => "%s paylaşımı, %s ile zaten paylaşıldığından dolayı başarısız oldu",
"Sharing %s failed, because the group %s does not exist" => "%s paylaşımı, %s grubu mevcut olmadığından başarısız oldu",
"Sharing %s failed, because %s is not a member of the group %s" => "%s paylaşımı, %s kullanıcısı %s grup üyesi olmadığından başarısız oldu",
"You need to provide a password to create a public link, only protected links are allowed" => "Herkese açık bir bağlantı oluşturmak için bir parola belirtmeniz gerekiyor. Sadece korunmuş bağlantılara izin verilmektedir",
"Sharing %s failed, because sharing with links is not allowed" => "%s paylaşımı, bağlantılar ile paylaşım izin verilmediğinden başarısız oldu",
"Share type %s is not valid for %s" => "%s paylaşım türü %s için geçerli değil",
"Setting permissions for %s failed, because the permissions exceed permissions granted to %s" => "%s için izinler, izinler %s için verilen izinleri aştığından dolayı ayarlanamadı",
"Setting permissions for %s failed, because the item was not found" => "%s için izinler öge bulunamadığından ayarlanamadı",
"Cannot set expiration date. Shares cannot expire later than %s after they have been shared" => "Son kullanma tarihi ayarlanamıyor. Paylaşımlar, paylaşıldıkları süreden %s sonra dolamaz.",
"Cannot set expiration date. Expiration date is in the past" => "Son kullanma tarihi ayarlanamıyor. Son kullanma tarihi geçmişte",
"Sharing backend %s must implement the interface OCP\\Share_Backend" => "Paylaşma arka ucu %s OCP\\Share_Backend arayüzünü desteklemeli",
"Sharing backend %s not found" => "Paylaşım arka ucu %s bulunamadı",
"Sharing backend for %s not found" => "%s için paylaşım arka ucu bulunamadı",
"Sharing %s failed, because the user %s is the original sharer" => "%s paylaşımı, %s kullanıcısı özgün paylaşan kişi olduğundan başarısız oldu",
"Sharing %s failed, because the permissions exceed permissions granted to %s" => "%s paylaşımı, izinler %s için verilen izinleri aştığından dolayı başarısız oldu",
"Sharing %s failed, because resharing is not allowed" => "%s paylaşımı, tekrar paylaşımın izin verilmemesinden dolayı başarısız oldu",
"Sharing %s failed, because the sharing backend for %s could not find its source" => "%s paylaşımı, %s için arka ucun kaynağını bulamamasından dolayı başarısız oldu",
"Sharing %s failed, because the file could not be found in the file cache" => "%s paylaşımı, dosyanın dosya önbelleğinde bulunamamasınndan dolayı başarısız oldu",
"Could not find category \"%s\"" => "\"%s\" kategorisi bulunamadı",
"seconds ago" => "saniyeler önce",
"_%n minute ago_::_%n minutes ago_" => array("","%n dakika önce"),
"_%n hour ago_::_%n hours ago_" => array("","%n saat önce"),
"today" => "bugün",
"yesterday" => "dün",
"_%n day go_::_%n days ago_" => array("","%n gün önce"),
"last month" => "geçen ay",
"_%n month ago_::_%n months ago_" => array("","%n ay önce"),
"last year" => "geçen yıl",
"years ago" => "yıllar önce",
"Only the following characters are allowed in a username: \"a-z\", \"A-Z\", \"0-9\", and \"_.@-\"" => "Kullanıcı adında sadece bu karakterlere izin verilmektedir: \"a-z\", \"A-Z\", \"0-9\", ve \"_.@-\"",
"A valid username must be provided" => "Geçerli bir kullanıcı adı mutlaka sağlanmalı",
"A valid password must be provided" => "Geçerli bir parola mutlaka sağlanmalı",
"The username is already being used" => "Bu kullanıcı adı zaten kullanımda",
"No database drivers (sqlite, mysql, or postgresql) installed." => "Yüklü veritabanı sürücüsü (sqlite, mysql veya postgresql) yok.",
"Permissions can usually be fixed by %sgiving the webserver write access to the root directory%s." => "İzinler genellikle, %sweb sunucusuna kök dizinine yazma erişimi verilerek%s çözülebilir",
"Cannot write into \"config\" directory" => "\"config\" dizinine yazılamıyor",
"Cannot write into \"apps\" directory" => "\"apps\" dizinine yazılamıyor",
"This can usually be fixed by %sgiving the webserver write access to the apps directory%s or disabling the appstore in the config file." => "Bu genellikle, %sweb sunucusuna apps dizinine yazma erişimi verilerek%s veya yapılandırma dosyasında appstore (uygulama mağazası) devre dışı bırakılarak çözülebilir.",
"Cannot create \"data\" directory (%s)" => "\"Veri\" dizini oluşturulamıyor (%s)",
"This can usually be fixed by <a href=\"%s\" target=\"_blank\">giving the webserver write access to the root directory</a>." => "İzinler genellikle, <a href=\"%s\" target=\"_blank\">web sunucusuna kök dizinine yazma erişimi verilerek</a> çözülebilir.",
"Setting locale to %s failed" => "Dili %s olarak ayarlama başarısız",
"Please install one of these locales on your system and restart your webserver." => "Lütfen bu yerellerden birini sisteminize yükleyin ve web sunucunuzu yeniden başlatın.",
"Please ask your server administrator to install the module." => "Lütfen modülün kurulması için sunucu yöneticinize danışın.",
"PHP module %s not installed." => "PHP modülü %s yüklü değil.",
"PHP %s or higher is required." => "PHP %s veya daha üst sürümü gerekli.",
"Please ask your server administrator to update PHP to the latest version. Your PHP version is no longer supported by ownCloud and the PHP community." => "Lütfen PHP'yi en son sürüme güncellemesi için sunucu yönetinize danışın. PHP sürümünüz ownCloud ve PHP topluluğu tarafından artık desteklenmemektedir.",
"PHP Safe Mode is enabled. ownCloud requires that it is disabled to work properly." => "PHP Güvenli Kip (Safe Mode) etkin. ownCloud düzgün çalışabilmesi için bunun devre dışı olmasını gerektirir.",
"PHP Safe Mode is a deprecated and mostly useless setting that should be disabled. Please ask your server administrator to disable it in php.ini or in your webserver config." => "PHP Güvenli Kip (Safe Mode), eskimiş ve devre dışı bırakılması gereken en kullanışsız ayardır. Lütfen php.ini veya web sunucu yapılandırması içerisinde devre dışı bırakması için sunucu yöneticinize danışın.",
"Magic Quotes is enabled. ownCloud requires that it is disabled to work properly." => "Sihirli Tırnaklar (Magic Quotes) etkin. ownCloud çalışabilmesi için bunun devre dışı bırakılması gerekli.",
"Magic Quotes is a deprecated and mostly useless setting that should be disabled. Please ask your server administrator to disable it in php.ini or in your webserver config." => "Sihirli Tırnaklar (Magic Quotes), eskimiş ve devre dışı bırakılması gereken en kullanışsız ayardır. Lütfen php.ini veya web sunucu yapılandırması içerisinde devre dışı bırakması için sunucu yöneticinize danışın.",
"PHP modules have been installed, but they are still listed as missing?" => "PHP modülleri yüklü, ancak hala eksik olarak mı görünüyorlar?",
"Please ask your server administrator to restart the web server." => "Lütfen web sunucusunu yeniden başlatması için sunucu yöneticinize danışın.",
"PostgreSQL >= 9 required" => "PostgreSQL >= 9 gerekli",
"Please upgrade your database version" => "Lütfen veritabanı sürümünüzü yükseltin",
"Error occurred while checking PostgreSQL version" => "PostgreSQL sürümü denetlenirken hata oluştu",
"Please make sure you have PostgreSQL >= 9 or check the logs for more information about the error" => "PostgreSQL >= 9 sürümüne sahip olduğunuzu doğrulayın veya hata hakkında daha fazla bilgi için günlükleri denetleyin",
"Please change the permissions to 0770 so that the directory cannot be listed by other users." => "Lütfen izinleri 0770 ayarlayarak dizinin diğer kullanıcılar tarafından görülememesini sağlayın.",
"Data directory (%s) is readable by other users" => "Veri dizini (%s) diğer kullanıcılar tarafından okunabilir",
"Data directory (%s) is invalid" => "Veri dizini (%s) geçersiz",
"Please check that the data directory contains a file \".ocdata\" in its root." => "Lütfen veri dizininin kökünde \".ocdata\" adlı bir dosyanın bulunduğunu denetleyin.",
"Could not obtain lock type %d on \"%s\"." => "\"%s\" üzerinde %d kilit türü alınamadı."
);
$PLURAL_FORMS = "nplurals=2; plural=(n > 1);";
