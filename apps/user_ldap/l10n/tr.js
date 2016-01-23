OC.L10N.register(
    "user_ldap",
    {
    "Failed to clear the mappings." : "Eşleştirmeler temizlenirken hata oluştu.",
    "Failed to delete the server configuration" : "Sunucu yapılandırmasını silme başarısız oldu",
    "The configuration is invalid: anonymous bind is not allowed." : "Yapılandırma geçersiz: anonim atamaya izin verilmiyor.",
    "The configuration is valid and the connection could be established!" : "Yapılandırma geçerli ve bağlantı kuruldu!",
    "The configuration is valid, but the Bind failed. Please check the server settings and credentials." : "Yapılandırma geçerli fakat bağlama (bind) başarısız. Lütfen sunucu ayarları ve kimlik bilgilerini kontrol edin.",
    "The configuration is invalid. Please have a look at the logs for further details." : "Yapılandırma geçersiz. Lütfen ayrıntılar için günlüklere bakın.",
    "No action specified" : "Eylem belirtilmedi",
    "No configuration specified" : "Yapılandırma belirtilmemiş",
    "No data specified" : "Veri belirtilmemiş",
    " Could not set configuration %s" : "%s yapılandırması ayarlanamadı",
    "Action does not exist" : "Eylem mevcut değil",
    "The Base DN appears to be wrong" : "Base DN yanlış gibi görünüyor",
    "Configuration incorrect" : "Yapılandırma geçersiz",
    "Configuration incomplete" : "Yapılandırma tamamlanmamış",
    "Configuration OK" : "Yapılandırma tamam",
    "Select groups" : "Grupları seç",
    "Select object classes" : "Nesne sınıflarını seç",
    "Please check the credentials, they seem to be wrong." : "Lütfen kimlik bilgilerini kontrol edin, yanlış görünüyorlar.",
    "Please specify the port, it could not be auto-detected." : "Lütfen bağlantı noktası belirtin, otomatik olarak algılanamadı.",
    "Base DN could not be auto-detected, please revise credentials, host and port." : "Base DN otomatik olarak tespit edilemedi, lütfen kimlik bilgilerini, sunucuyu ve bağlantı noktasını gözden geçirin.",
    "Could not detect Base DN, please enter it manually." : "Base DN tespit edilemedi, lütfen elle girin.",
    "{nthServer}. Server" : "{nthServer}. Sunucu",
    "No object found in the given Base DN. Please revise." : "Girilen Base DN içerisinde nesne bulunamadı. Lütfen gözden geçirin.",
    "More than 1,000 directory entries available." : "1000'den fazla dizin şu an müsait durumdadır.",
    " entries available within the provided Base DN" : " girdi sağlanan Base DN içerisinde mevcut",
    "An error occurred. Please check the Base DN, as well as connection settings and credentials." : "Bir hata oluştu. Lütfen Base DN ile birlikte bağlantı ayarlarını ve kimlik bilgilerini denetleyin.",
    "Do you really want to delete the current Server Configuration?" : "Şu anki sunucu yapılandırmasını silmek istediğinizden emin misiniz?",
    "Confirm Deletion" : "Silmeyi onayla",
    "Mappings cleared successfully!" : "Eşleştirmeler başarıyla temizlendi!",
    "Error while clearing the mappings." : "Eşleşmeler temizlenirken hata.",
    "Anonymous bind is not allowed. Please provide a User DN and Password." : "Anonim atamaya izin verilmiyor. Lütfen bir Kullanıcı DN ve Parola sağlayın.",
    "LDAP Operations error. Anonymous bind might not be allowed." : "LDAP İşlem hatası. Anonim bağlamaya izin verilmiyor.",
    "Saving failed. Please make sure the database is in Operation. Reload before continuing." : "Kaydetme başarısız oldu. Veritabanının işlemde olduğundan emin olun. Devam etmeden yeniden yükleyin.",
    "Switching the mode will enable automatic LDAP queries. Depending on your LDAP size they may take a while. Do you still want to switch the mode?" : "Kipi değiştirmek otomatik LDAP sorgularını etkinleştirecektir. LDAP'ınızın boyutlarına göre bu bir süre alacaktır. Kipi yine de değiştirmek istiyor musunuz?",
    "Mode switch" : "Kip değişimi",
    "Select attributes" : "Nitelikleri seç",
    "User not found. Please check your login attributes and username. Effective filter (to copy-and-paste for command line validation): <br/>" : "Kullanıcı bulunamadı. Lütfen oturum açtığınız nitelikleri ve kullanıcı adını kontrol edin. Etkili filtre (komut satırı doğrulaması için kopyala-yapıştır için): <br/>",
    "User found and settings verified." : "Kullanıcı bulundu ve ayarlar doğrulandı.",
    "Settings verified, but one user found. Only the first will be able to login. Consider a more narrow filter." : "Ayarlar doğrulandı ancak tek kullanıcı bulundu. Sadece ilk kullanıcı oturum açabilecek. Lütfen daha dar bir filtre seçin.",
    "An unspecified error occurred. Please check the settings and the log." : "Belirtilmeyen bir hata oluştu. Lütfen ayarları ve günlüğü denetleyin.",
    "The search filter is invalid, probably due to syntax issues like uneven number of opened and closed brackets. Please revise." : "Arama filtresi, eşleşmeyen parantez sayısı sebebiyle oluşabilen sözdizimi sorunlarından dolayı geçersiz. Lütfen gözden geçirin.",
    "A connection error to LDAP / AD occurred, please check host, port and credentials." : "LDAP / AD için bir bağlantı hatası oluştu, lütfen istemci, port ve kimlik bilgilerini kontrol edin.",
    "The %uid placeholder is missing. It will be replaced with the login name when querying LDAP / AD." : "%uid yer tutucusu eksik. LDAP / AD sorgularında kullanıcı adı ile değiştirilecek.",
    "Please provide a login name to test against" : "Lütfen deneme için kullanılacak bir kullanıcı adı girin",
    "The group box was disabled, because the LDAP / AD server does not support memberOf." : "LDAP / AD sunucusu memberOf desteklemediğinden grup kutusu kapatıldı.",
    "_%s group found_::_%s groups found_" : ["%s grup bulundu","%s grup bulundu"],
    "_%s user found_::_%s users found_" : ["%s kullanıcı bulundu","%s kullanıcı bulundu"],
    "Could not detect user display name attribute. Please specify it yourself in advanced ldap settings." : "Görüntülenecek kullanıcı adı özelliği algılanamadı. Lütfen gelişmiş ldap ayarlarına girerek kendiniz belirleyin.",
    "Could not find the desired feature" : "İstenen özellik bulunamadı",
    "Invalid Host" : "Geçersiz Makine",
    "Server" : "Sunucu",
    "Users" : "Kullanıcılar",
    "Login Attributes" : "Oturum Açma Öznitelikleri",
    "Groups" : "Gruplar",
    "Test Configuration" : "Yapılandırmayı Sına",
    "Help" : "Yardım",
    "Groups meeting these criteria are available in %s:" : "Bu kriterlerle eşleşen gruplar %s içinde mevcut:",
    "Only these object classes:" : "Sadece bu nesne sınıflarına:",
    "Only from these groups:" : "Sadece bu gruplardan:",
    "Search groups" : "Grupları ara",
    "Available groups" : "Kullanılabilir gruplar",
    "Selected groups" : "Seçili gruplar",
    "Edit LDAP Query" : "LDAP Sorgusunu Düzenle",
    "LDAP Filter:" : "LDAP Filtresi:",
    "The filter specifies which LDAP groups shall have access to the %s instance." : "Filtre, %s örneğine erişmesi gereken LDAP gruplarını belirtir.",
    "Verify settings and count groups" : "Ayarları doğrula ve grupları say",
    "When logging in, %s will find the user based on the following attributes:" : "Oturum açılırken, %s, aşağıdaki özniteliklere bağlı kullanıcıyı bulacak:",
    "LDAP / AD Username:" : "LDAP / AD Kullanıcı Adı:",
    "Allows login against the LDAP / AD username, which is either uid or samaccountname and will be detected." : "LDAP / AD kullanıcı adı ile oturum açmaya izin verir.",
    "LDAP / AD Email Address:" : "LDAP / AD Eposta Adresi:",
    "Allows login against an email attribute. Mail and mailPrimaryAddress will be allowed." : "Bir eposta kimliği ile oturum açmaya izin verir. Mail ve mailPrimaryAddress'e izin verilir.",
    "Other Attributes:" : "Diğer Nitelikler:",
    "Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action. Example: \"uid=%%uid\"" : "Oturum açma girişimi olduğunda uygulanacak filtreyi tanımlar. %%uid, oturum işleminde kullanıcı adı ile değiştirilir. Örneğin: \"uid=%%uid\"",
    "Test Loginname" : "Oturum açma adını sına",
    "Verify settings" : "Ayarları doğrula",
    "1. Server" : "1. Sunucu",
    "%s. Server:" : "%s. Sunucu:",
    "Add a new and blank configuration" : "Yeni ve boş bir yapılandırma ekle",
    "Copy current configuration into new directory binding" : "Geçerli yapılandırmayı yeni dizin bağlamasına kopyala",
    "Delete the current configuration" : "Geçerli yapılandırmayı sil",
    "Host" : "Sunucu",
    "You can omit the protocol, except you require SSL. Then start with ldaps://" : "SSL gerekmediği takdirde protokol belirtmeyebilirsiniz. Gerekiyorsa ldaps:// ile başlayın",
    "Port" : "Port",
    "Detect Port" : "Bağl. Noktasını Tespit Et",
    "User DN" : "Kullanıcı DN",
    "The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." : "İstemci kullanıcısının yapılacağı atamanın DN'si. Örn. uid=agent,dc=örnek,dc=com. Anonim erişim için DN ve Parolayı boş bırakın.",
    "Password" : "Parola",
    "For anonymous access, leave DN and Password empty." : "Anonim erişim için DN ve Parola alanlarını boş bırakın.",
    "One Base DN per line" : "Her satırda tek bir Base DN",
    "You can specify Base DN for users and groups in the Advanced tab" : "Gelişmiş sekmesinde, kullanıcılar ve gruplar için Base DN belirtebilirsiniz",
    "Detect Base DN" : "Base DN'i Tespit Et",
    "Test Base DN" : "Base DN'i Sına",
    "Avoids automatic LDAP requests. Better for bigger setups, but requires some LDAP knowledge." : "Otomatik LDAP isteklerinden kaçın. Büyük kurulumlar için daha iyi ancak LDAP bilgisi gerektirir.",
    "Manually enter LDAP filters (recommended for large directories)" : "LDAP filtrelerini el ile girin (büyük dizinler için önerilir)",
    "Limit %s access to users meeting these criteria:" : "%s erişimini, şu kriterlerle eşleşen kullanıcılara sınırla:",
    "The most common object classes for users are organizationalPerson, person, user, and inetOrgPerson. If you are not sure which object class to select, please consult your directory admin." : "Kullanıcılar için en çok ortak nesne sınıfları organizationalPerson, person, user ve inetOrgPerson sınıflarıdır. Hangi nesne sınıfını seçeceğinizden emin değilseniz lütfen dizin yöneticinize danışın.",
    "The filter specifies which LDAP users shall have access to the %s instance." : "Filtre, %s örneğine erişmesi gereken LDAP kullanıcılarını belirtir.",
    "Verify settings and count users" : "Ayarları doğrula ve kullanıcıları say",
    "Saving" : "Kaydediliyor",
    "Back" : "Geri",
    "Continue" : "Devam et",
    "LDAP" : "LDAP",
    "Expert" : "Uzman",
    "Advanced" : "Gelişmiş",
    "<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." : "<b>Uyarı:</b> user_ldap ve user_webdavauth uygulamaları uyumlu değil. Beklenmedik bir davranışla karşılaşabilirsiniz. Lütfen ikisinden birini devre dışı bırakmak için sistem yöneticinizle iletişime geçin.",
    "<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." : "<b>Uyarı:</b> PHP LDAP modülü kurulu değil, arka uç çalışmayacak. Lütfen kurulumu için sistem yöneticinizle iletişime geçin.",
    "Connection Settings" : "Bağlantı Ayarları",
    "Configuration Active" : "Yapılandırma Etkin",
    "When unchecked, this configuration will be skipped." : "İşaretli değilse, bu yapılandırma atlanacaktır.",
    "Backup (Replica) Host" : "Yedek (Replica) Sunucu",
    "Give an optional backup host. It must be a replica of the main LDAP/AD server." : "İsteğe bağlı bir yedek sunucusu belirtin. Ana LDAP/AD sunucusunun bir kopyası olmalıdır.",
    "Backup (Replica) Port" : "Yedek (Replica) Bağlantı Noktası",
    "Disable Main Server" : "Ana Sunucuyu Devre Dışı Bırak",
    "Only connect to the replica server." : "Sadece yedek sunucuya bağlan.",
    "Turn off SSL certificate validation." : "SSL sertifika doğrulamasını kapat.",
    "Not recommended, use it for testing only! If connection only works with this option, import the LDAP server's SSL certificate in your %s server." : "Önerilmez, sadece test için kullanın! Eğer bağlantı sadece bu seçenekle çalışıyorsa %s sunucunuza LDAP sunucusunun SSL sertifikasını ekleyin.",
    "Cache Time-To-Live" : "Önbellek Time-To-Live Değeri",
    "in seconds. A change empties the cache." : "saniye cinsinden. Bir değişiklik önbelleği temizleyecektir.",
    "Directory Settings" : "Dizin Ayarları",
    "User Display Name Field" : "Kullanıcı Görünen Ad Alanı",
    "The LDAP attribute to use to generate the user's display name." : "Kullanıcının görünen adını oluşturmak için kullanılacak LDAP niteliği.",
    "Base User Tree" : "Temel Kullanıcı Ağacı",
    "One User Base DN per line" : "Her satırda Tek Kullanıcı Base DN'si",
    "User Search Attributes" : "Kullanıcı Arama Nitelikleri",
    "Optional; one attribute per line" : "Tercihe bağlı; her bir satırda bir öznitelik",
    "Group Display Name Field" : "Grup Görünen Ad Alanı",
    "The LDAP attribute to use to generate the groups's display name." : "Grubun görünen adını oluşturmak için kullanılacak LDAP niteliği.",
    "Base Group Tree" : "Temel Grup Ağacı",
    "One Group Base DN per line" : "Her satırda Tek Grup Base DN'si",
    "Group Search Attributes" : "Grup Arama Nitelikleri",
    "Group-Member association" : "Grup-Üye işbirliği",
    "Nested Groups" : "İç İçe Gruplar",
    "When switched on, groups that contain groups are supported. (Only works if the group member attribute contains DNs.)" : "Etkinleştirildiğinde, grup içeren gruplar desteklenir (Sadece grup üyesi DN niteliği içeriyorsa çalışır).",
    "Paging chunksize" : "Sayfalama yığın boyutu",
    "Chunksize used for paged LDAP searches that may return bulky results like user or group enumeration. (Setting it 0 disables paged LDAP searches in those situations.)" : "Yığın boyutu, kullanıcı veya grup numaralandırması benzeri hantal sonuçlar döndürebilen sayfalandırılmış LDAP aramaları için kullanılır. (0 yapmak bu durumlarda sayfalandırılmış LDAP aramalarını devre dışı bırakır.)",
    "Special Attributes" : "Özel Öznitelikler",
    "Quota Field" : "Kota Alanı",
    "Quota Default" : "Öntanımlı Kota",
    "in bytes" : "byte cinsinden",
    "Email Field" : "E-posta Alanı",
    "User Home Folder Naming Rule" : "Kullanıcı Ana Dizini İsimlendirme Kuralı",
    "Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." : "Kullanıcı adı bölümünü boş bırakın (öntanımlı). Aksi halde bir LDAP/AD özniteliği belirtin.",
    "Internal Username" : "Dahili Kullanıcı Adı",
    "By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder. It is also a part of remote URLs, for instance for all *DAV services. With this setting, the default behavior can be overridden. To achieve a similar behavior as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users." : "Öntanımlı olarak UUID niteliğinden dahili bir kullanıcı adı oluşturulacak. Bu, kullanıcı adının benzersiz ve karakterlerinin dönüştürme gereksinimini ortadan kaldırır. Dahili kullanıcı adı, sadece bu karakterlerin izin verildiği kısıtlamaya sahip: [ a-zA-Z0-9_.@- ]. Diğer karakterler ise ASCII karşılıkları ile yer değiştirilir veya basitçe yoksayılır. Çakışmalar olduğunda ise bir numara eklenir veya arttırılır. Dahili kullanıcı adı, bir kullanıcıyı dahili olarak tanımlamak için kullanılır. Ayrıca kullanıcı ev klasörü için öntanımlı bir isimdir. Bu ayrıca uzak adreslerin (örneğin tüm *DAV hizmetleri) bir parçasıdır. Bu ayar ise, öntanımlı davranışın üzerine yazılabilir. ownCloud 5'ten önce benzer davranışı yapabilmek için aşağıdaki alana bir kullanıcı görünen adı niteliği girin. Öntanımlı davranış için boş bırakın. Değişiklikler, sadece yeni eşleştirilen (eklenen) LDAP kullanıcılarında etkili olacaktır.",
    "Internal Username Attribute:" : "Dahili Kullanıcı Adı Özniteliği:",
    "Override UUID detection" : "UUID tespitinin üzerine yaz",
    "By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." : "Öntanımlı olarak, UUID niteliği otomatik olarak tespit edilmez. UUID niteliği LDAP kullanıcılarını ve gruplarını şüphesiz biçimde tanımlamak için kullanılır. Ayrıca yukarıda belirtilmemişse, bu UUID'ye bağlı olarak dahili bir kullanıcı adı oluşturulacaktır. Bu ayarın üzerine yazabilir ve istediğiniz bir nitelik belirtebilirsiniz. Ancak istediğiniz niteliğin benzersiz olduğundan ve hem kullanıcı hem de gruplar tarafından getirilebileceğinden emin olmalısınız. Öntanımlı davranış için boş bırakın. Değişiklikler sadece yeni eşleştirilen (eklenen) LDAP kullanıcı ve gruplarında etkili olacaktır.",
    "UUID Attribute for Users:" : "Kullanıcılar için UUID Özniteliği:",
    "UUID Attribute for Groups:" : "Gruplar için UUID Özniteliği:",
    "Username-LDAP User Mapping" : "Kullanıcı Adı-LDAP Kullanıcısı Eşleştirme",
    "Usernames are used to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have an internal username. This requires a mapping from username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found. The internal username is used all over. Clearing the mappings will have leftovers everywhere. Clearing the mappings is not configuration sensitive, it affects all LDAP configurations! Never clear the mappings in a production environment, only in a testing or experimental stage." : "Kullanıcı adları, (üst) veri depolaması ve ataması için kullanılır. Kullanıcıları kesin olarak tanımlamak ve algılamak için, her LDAP kullanıcısı bir dahili kullanıcı adına sahip olacak. Bu kullanıcı adı ile LDAP kullanıcısı arasında bir eşleşme gerektirir. Oluşturulan kullanıcı adı LDAP kullanıcısının UUID'si ile eşleştirilir. Ek olarak LDAP etkileşimini azaltmak için DN de önbelleğe alınır ancak bu kimlik tanıma için kullanılmaz. Eğer DN değişirse, değişiklikler tespit edilir. Dahili kullanıcı her yerde kullanılır. Eşleştirmeleri temizlemek, her yerde kalıntılar bırakacaktır. Eşleştirmeleri temizlemek yapılandırmaya hassas bir şekilde bağlı değildir, tüm LDAP yapılandırmalarını etkiler! Üretim ortamında eşleştirmeleri asla temizlemeyin, sadece sınama veya deneysel aşamada kullanın.",
    "Clear Username-LDAP User Mapping" : "Kullanıcı Adı-LDAP Kullanıcısı Eşleştirmesini Temizle",
    "Clear Groupname-LDAP Group Mapping" : "Grup Adı-LDAP Grubu Eşleştirmesini Temizle"
},
"nplurals=2; plural=(n > 1);");
