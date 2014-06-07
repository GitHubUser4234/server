<?php
$TRANSLATIONS = array(
"You are accessing the server from an untrusted domain." => "Dostajesz się do serwera z niezaufanej domeny.",
"Please contact your administrator. If you are an administrator of this instance, configure the \"trusted_domain\" setting in config/config.php. An example configuration is provided in config/config.sample.php." => "Proszę skontaktuj się z administratorem. Jeśli jesteś administratorem tej instancji, skonfiguruj parametr \"trusted_domain\" w pliku config/config.php. Przykładowa konfiguracja jest dostępna w pliku config/config.sample.php.",
"App \"%s\" can't be installed because it is not compatible with this version of ownCloud." => "Aplikacja \"%s\" nie może zostać zainstalowana, ponieważ nie jest zgodna z tą wersją ownCloud.",
"No app name specified" => "Nie określono nazwy aplikacji",
"Help" => "Pomoc",
"Personal" => "Osobiste",
"Settings" => "Ustawienia",
"Users" => "Użytkownicy",
"Admin" => "Administrator",
"Failed to upgrade \"%s\"." => "Błąd przy aktualizacji \"%s\".",
"Unknown filetype" => "Nieznany typ pliku",
"Invalid image" => "Błędne zdjęcie",
"web services under your control" => "Kontrolowane serwisy",
"No source specified when installing app" => "Nie określono źródła  podczas instalacji aplikacji",
"No href specified when installing app from http" => "Nie określono linku skąd aplikacja ma być zainstalowana",
"No path specified when installing app from local file" => "Nie określono lokalnego pliku z którego miała być instalowana aplikacja",
"Archives of type %s are not supported" => "Typ archiwum %s nie jest obsługiwany",
"Failed to open archive when installing app" => "Nie udało się otworzyć archiwum podczas instalacji aplikacji",
"App does not provide an info.xml file" => "Aplikacja nie posiada pliku info.xml",
"App can't be installed because of not allowed code in the App" => "Aplikacja nie może być zainstalowany ponieważ nie dopuszcza kod w aplikacji",
"App can't be installed because it is not compatible with this version of ownCloud" => "Aplikacja nie może zostać zainstalowana ponieważ jest niekompatybilna z tą wersja ownCloud",
"App can't be installed because it contains the <shipped>true</shipped> tag which is not allowed for non shipped apps" => "Aplikacja nie może być zainstalowana ponieważ true tag nie jest <shipped>true</shipped> , co nie jest dozwolone dla aplikacji nie wysłanych",
"App can't be installed because the version in info.xml/version is not the same as the version reported from the app store" => "Nie można zainstalować aplikacji, ponieważ w wersji info.xml/version nie jest taka sama, jak wersja z app store",
"App directory already exists" => "Katalog aplikacji już isnieje",
"Can't create app folder. Please fix permissions. %s" => "Nie mogę utworzyć katalogu aplikacji. Proszę popraw uprawnienia. %s",
"Application is not enabled" => "Aplikacja nie jest włączona",
"Authentication error" => "Błąd uwierzytelniania",
"Token expired. Please reload page." => "Token wygasł. Proszę ponownie załadować stronę.",
"Unknown user" => "Nieznany użytkownik",
"%s enter the database username." => "%s wpisz nazwę użytkownika do  bazy",
"%s enter the database name." => "%s wpisz nazwę bazy.",
"%s you may not use dots in the database name" => "%s nie można używać kropki w nazwie bazy danych",
"MS SQL username and/or password not valid: %s" => "Nazwa i/lub hasło serwera MS SQL jest niepoprawne: %s.",
"You need to enter either an existing account or the administrator." => "Należy wprowadzić istniejące konto użytkownika lub  administratora.",
"MySQL/MariaDB username and/or password not valid" => "Użytkownik i/lub hasło do MySQL/MariaDB są niepoprawne",
"DB Error: \"%s\"" => "Błąd DB: \"%s\"",
"Offending command was: \"%s\"" => "Niepoprawna komenda: \"%s\"",
"MySQL/MariaDB user '%s'@'localhost' exists already." => "Użytkownik '%s'@'localhost' MySQL/MariaDB już istnieje.",
"Drop this user from MySQL/MariaDB" => "Usuń tego użytkownika z MySQL/MariaDB",
"MySQL/MariaDB user '%s'@'%%' already exists" => "Użytkownik  '%s'@'%%' MySQL/MariaDB już istnieje.",
"Drop this user from MySQL/MariaDB." => "Usuń tego użytkownika z MySQL/MariaDB",
"Oracle connection could not be established" => "Nie można ustanowić połączenia z bazą Oracle",
"Oracle username and/or password not valid" => "Oracle: Nazwa użytkownika i/lub hasło jest niepoprawne",
"Offending command was: \"%s\", name: %s, password: %s" => "Niepoprawne polecania:  \"%s\", nazwa: %s, hasło: %s",
"PostgreSQL username and/or password not valid" => "PostgreSQL: Nazwa użytkownika i/lub hasło jest niepoprawne",
"Set an admin username." => "Ustaw nazwę administratora.",
"Set an admin password." => "Ustaw hasło administratora.",
"Your web server is not yet properly setup to allow files synchronization because the WebDAV interface seems to be broken." => "Serwer internetowy nie jest jeszcze poprawnie skonfigurowany, aby umożliwić synchronizację plików, ponieważ interfejs WebDAV wydaje się być uszkodzony.",
"Please double check the <a href='%s'>installation guides</a>." => "Sprawdź ponownie <a href='%s'>przewodniki instalacji</a>.",
"%s shared »%s« with you" => "%s Współdzielone »%s« z tobą",
"Sharing %s failed, because the file does not exist" => "Wspóldzielenie %s nie powiodło się. ponieważ plik nie istnieje",
"You are not allowed to share %s" => "Nie masz uprawnień aby udostępnić %s",
"Sharing %s failed, because the user %s is the item owner" => "Współdzielenie %s nie powiodło się, ponieważ użytkownik %s jest właścicielem elementu",
"Sharing %s failed, because the user %s does not exist" => "Współdzielenie %s nie powiodło się, ponieważ użytkownik %s nie istnieje",
"Sharing %s failed, because the user %s is not a member of any groups that %s is a member of" => "Współdzielenie %s nie powiodło się, ponieważ użytkownik %s nie jest członkiem żadnej grupy której członkiem jest %s",
"Sharing %s failed, because this item is already shared with %s" => "Współdzielenie %s nie powiodło się, ponieważ element jest już współdzielony z %s",
"Sharing %s failed, because the group %s does not exist" => "Współdzielenie %s nie powiodło się, ponieważ grupa %s nie istnieje",
"Sharing %s failed, because %s is not a member of the group %s" => "Współdzielenie %s nie powiodło się, ponieważ %s nie jest członkiem grupy %s",
"You need to provide a password to create a public link, only protected links are allowed" => "Musisz zapewnić hasło aby utworzyć link publiczny, dozwolone są tylko linki chronione",
"Sharing %s failed, because sharing with links is not allowed" => "Współdzielenie %s nie powiodło się, ponieważ współdzielenie z linkami nie jest dozwolone",
"Share type %s is not valid for %s" => "Typ udziału %s nie jest właściwy dla %s",
"Setting permissions for %s failed, because the permissions exceed permissions granted to %s" => "Ustawienie uprawnień dla %s nie powiodło się, ponieważ uprawnienia wykraczają poza przydzielone %s",
"Setting permissions for %s failed, because the item was not found" => "Ustawienie uprawnień dla %s nie powiodło się, ponieważ element nie został znaleziony",
"Sharing backend %s must implement the interface OCP\\Share_Backend" => "Zaplecze do współdzielenia %s musi implementować interfejs OCP\\Share_Backend",
"Sharing backend %s not found" => "Zaplecze %s do współdzielenia nie zostało znalezione",
"Sharing backend for %s not found" => "Zaplecze do współdzielenia %s nie zostało znalezione",
"Sharing %s failed, because the user %s is the original sharer" => "Współdzielenie %s nie powiodło się, ponieważ użytkownik %s jest udostępniającym",
"Sharing %s failed, because the permissions exceed permissions granted to %s" => "Współdzielenie %s nie powiodło się, ponieważ uprawnienia przekraczają te udzielone %s",
"Sharing %s failed, because resharing is not allowed" => "Współdzielenie %s nie powiodło się, ponieważ ponowne współdzielenie nie jest dozwolone",
"Sharing %s failed, because the sharing backend for %s could not find its source" => "Współdzielenie %s nie powiodło się, ponieważ zaplecze współdzielenia dla %s nie mogło znaleźć jego źródła",
"Sharing %s failed, because the file could not be found in the file cache" => "Współdzielenie %s nie powiodło się, ponieważ plik nie może zostać odnaleziony w buforze plików",
"Could not find category \"%s\"" => "Nie można odnaleźć kategorii \"%s\"",
"seconds ago" => "sekund temu",
"_%n minute ago_::_%n minutes ago_" => array("%n minute temu","%n minut temu","%n minut temu"),
"_%n hour ago_::_%n hours ago_" => array("%n godzinę temu","%n godzin temu","%n godzin temu"),
"today" => "dziś",
"yesterday" => "wczoraj",
"_%n day go_::_%n days ago_" => array("%n dzień temu","%n dni temu","%n dni temu"),
"last month" => "w zeszłym miesiącu",
"_%n month ago_::_%n months ago_" => array("%n miesiąc temu","%n miesięcy temu","%n miesięcy temu"),
"last year" => "w zeszłym roku",
"years ago" => "lat temu",
"Only the following characters are allowed in a username: \"a-z\", \"A-Z\", \"0-9\", and \"_.@-\"" => "W nazwach użytkowników dozwolone są wyłącznie następujące znaki: \"a-z\", \"A-Z\", \"0-9\", oraz \"_.@-\"",
"A valid username must be provided" => "Należy podać prawidłową nazwę użytkownika",
"A valid password must be provided" => "Należy podać prawidłowe hasło",
"The username is already being used" => "Ta nazwa użytkownika jest już używana"
);
$PLURAL_FORMS = "nplurals=3; plural=(n==1 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2);";
