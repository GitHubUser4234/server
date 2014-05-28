<?php
$TRANSLATIONS = array(
"Failed to clear the mappings." => "Nie udało się wyczyścić mapowania.",
"Failed to delete the server configuration" => "Nie można usunąć konfiguracji serwera",
"The configuration is valid and the connection could be established!" => "Konfiguracja jest prawidłowa i można ustanowić połączenie!",
"The configuration is valid, but the Bind failed. Please check the server settings and credentials." => "Konfiguracja jest prawidłowa, ale Bind nie. Sprawdź ustawienia serwera i poświadczenia.",
"The configuration is invalid. Please have a look at the logs for further details." => "Konfiguracja jest nieprawidłowa. Proszę rzucić okiem na dzienniki dalszych szczegółów.",
"No action specified" => "Nie określono akcji",
"No configuration specified" => "Nie określono konfiguracji",
"No data specified" => "Nie określono danych",
" Could not set configuration %s" => "Nie można ustawić konfiguracji %s",
"Deletion failed" => "Usunięcie nie powiodło się",
"Take over settings from recent server configuration?" => "Przejmij ustawienia z ostatnich konfiguracji serwera?",
"Keep settings?" => "Zachować ustawienia?",
"{nbServer}. Server" => "{nbServer}. Serwer",
"Cannot add server configuration" => "Nie można dodać konfiguracji serwera",
"mappings cleared" => "Mapoanie wyczyszczone",
"Success" => "Sukces",
"Error" => "Błąd",
"Configuration OK" => "Konfiguracja poprawna",
"Configuration incorrect" => "Konfiguracja niepoprawna",
"Configuration incomplete" => "Konfiguracja niekompletna",
"Select groups" => "Wybierz grupy",
"Select object classes" => "Wybierz obiekty klas",
"Select attributes" => "Wybierz atrybuty",
"Connection test succeeded" => "Test połączenia udany",
"Connection test failed" => "Test połączenia nie udany",
"Do you really want to delete the current Server Configuration?" => "Czy chcesz usunąć bieżącą konfigurację serwera?",
"Confirm Deletion" => "Potwierdź usunięcie",
"_%s group found_::_%s groups found_" => array("%s znaleziona grupa","%s znalezionych grup","%s znalezionych grup"),
"_%s user found_::_%s users found_" => array("%s znaleziony użytkownik","%s znalezionych użytkowników","%s znalezionych użytkowników"),
"Invalid Host" => "Niepoprawny Host",
"Could not find the desired feature" => "Nie można znaleźć żądanej funkcji",
"Server" => "Serwer",
"User Filter" => "Filtr użytkownika",
"Login Filter" => "Filtr logowania",
"Group Filter" => "Grupa filtrów",
"Save" => "Zapisz",
"Test Configuration" => "Konfiguracja testowa",
"Help" => "Pomoc",
"Groups meeting these criteria are available in %s:" => "Przyłączenie do grupy z tymi ustawieniami dostępne jest w %s:",
"only those object classes:" => "tylko te klasy obiektów:",
"only from those groups:" => "tylko z tych grup:",
"Edit raw filter instead" => "Edytuj zamiast tego czysty filtr",
"Raw LDAP filter" => "Czysty filtr LDAP",
"The filter specifies which LDAP groups shall have access to the %s instance." => "Filtr określa, które grupy LDAP powinny mieć dostęp do instancji %s.",
"groups found" => "grup znaleziono",
"Users login with this attribute:" => "Użytkownicy zalogowani z tymi ustawieniami:",
"LDAP Username:" => "Nazwa użytkownika LDAP:",
"LDAP Email Address:" => "LDAP Adres Email:",
"Other Attributes:" => "Inne atrybuty:",
"Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action. Example: \"uid=%%uid\"" => "Określa jakiego filtru użyć podczas próby zalogowania. %%uid zastępuje nazwę użytkownika w procesie logowania. Przykład: \"uid=%%uid\"",
"1. Server" => "1. Serwer",
"%s. Server:" => "%s. Serwer:",
"Add Server Configuration" => "Dodaj konfigurację servera",
"Delete Configuration" => "Usuń konfigurację",
"Host" => "Host",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "Można pominąć protokół, z wyjątkiem wymaganego protokołu SSL. Następnie uruchom z ldaps://",
"Port" => "Port",
"User DN" => "Użytkownik DN",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "DN użytkownika klienta, z którym powiązanie wykonuje się, np. uid=agent,dc=example,dc=com. Dla dostępu anonimowego pozostawić DN i hasło puste",
"Password" => "Hasło",
"For anonymous access, leave DN and Password empty." => "Dla dostępu anonimowego pozostawić DN i hasło puste.",
"One Base DN per line" => "Jedna baza DN na linię",
"You can specify Base DN for users and groups in the Advanced tab" => "Bazę DN można określić dla użytkowników i grup w karcie Zaawansowane",
"Limit %s access to users meeting these criteria:" => "Limit %s dostępu do podłączania użytkowników z tymi ustawieniami:",
"The filter specifies which LDAP users shall have access to the %s instance." => "Filtr określa, którzy użytkownicy LDAP powinni mieć dostęp do instancji %s.",
"users found" => "użytkownicy znalezieni",
"Back" => "Wróć",
"Continue" => "Kontynuuj ",
"Expert" => "Ekspert",
"Advanced" => "Zaawansowane",
"<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." => "<b>Ostrzeżenie:</b> Aplikacje user_ldap i user_webdavauth nie są  kompatybilne. Mogą powodować nieoczekiwane zachowanie. Poproś administratora o wyłączenie jednej z nich.",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>Ostrzeżenie:</b>  Moduł PHP LDAP nie jest zainstalowany i nie będzie działał. Poproś administratora o włączenie go.",
"Connection Settings" => "Konfiguracja połączeń",
"Configuration Active" => "Konfiguracja archiwum",
"When unchecked, this configuration will be skipped." => "Gdy niezaznaczone, ta konfiguracja zostanie pominięta.",
"Backup (Replica) Host" => "Kopia zapasowa (repliki) host",
"Give an optional backup host. It must be a replica of the main LDAP/AD server." => "Dać opcjonalnie  hosta kopii zapasowej . To musi być repliką głównego serwera LDAP/AD.",
"Backup (Replica) Port" => "Kopia zapasowa (repliki) Port",
"Disable Main Server" => "Wyłącz serwer główny",
"Only connect to the replica server." => "Połącz tylko do repliki serwera.",
"Case insensitive LDAP server (Windows)" => "Serwer LDAP nie rozróżniający wielkości liter (Windows)",
"Turn off SSL certificate validation." => "Wyłączyć sprawdzanie poprawności certyfikatu SSL.",
"Not recommended, use it for testing only! If connection only works with this option, import the LDAP server's SSL certificate in your %s server." => "Nie polecane, używać tylko w celu testowania! Jeśli połączenie działa tylko z tą opcją, zaimportuj certyfikat SSL serwera LDAP na swój %s.",
"Cache Time-To-Live" => "Przechowuj czas życia",
"in seconds. A change empties the cache." => "w sekundach. Zmiana opróżnia pamięć podręczną.",
"Directory Settings" => "Ustawienia katalogów",
"User Display Name Field" => "Pole wyświetlanej nazwy użytkownika",
"The LDAP attribute to use to generate the user's display name." => "Atrybut LDAP służący do generowania wyświetlanej nazwy użytkownika ownCloud.",
"Base User Tree" => "Drzewo bazy użytkowników",
"One User Base DN per line" => "Jeden użytkownik Bazy DN na linię",
"User Search Attributes" => "Szukaj atrybutów",
"Optional; one attribute per line" => "Opcjonalnie; jeden atrybut w wierszu",
"Group Display Name Field" => "Pole wyświetlanej nazwy grupy",
"The LDAP attribute to use to generate the groups's display name." => "Atrybut LDAP służący do generowania wyświetlanej nazwy grupy ownCloud.",
"Base Group Tree" => "Drzewo bazy grup",
"One Group Base DN per line" => "Jedna grupa bazy DN na linię",
"Group Search Attributes" => "Grupa atrybutów wyszukaj",
"Group-Member association" => "Członek grupy stowarzyszenia",
"Nested Groups" => "Grupy zagnieżdżone",
"When switched on, groups that contain groups are supported. (Only works if the group member attribute contains DNs.)" => "Kiedy włączone, grupy, które zawierają grupy, są wspierane. (Działa tylko, jeśli członek grupy ma ustawienie DNs)",
"Paging chunksize" => "Wielkość stronicowania",
"Chunksize used for paged LDAP searches that may return bulky results like user or group enumeration. (Setting it 0 disables paged LDAP searches in those situations.)" => "Długość łańcucha jest używana do stronicowanych wyszukiwań LDAP, które mogą zwracać duże zbiory jak lista grup, czy użytkowników. (Ustawienie na 0 wyłącza stronicowane wyszukiwania w takich sytuacjach.)",
"Special Attributes" => "Specjalne atrybuty",
"Quota Field" => "Pole przydziału",
"Quota Default" => "Przydział domyślny",
"in bytes" => "w bajtach",
"Email Field" => "Pole email",
"User Home Folder Naming Rule" => "Reguły nazewnictwa folderu domowego użytkownika",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "Pozostaw puste dla user name (domyślnie). W przeciwnym razie podaj atrybut LDAP/AD.",
"Internal Username" => "Wewnętrzna nazwa użytkownika",
"By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder. It is also a part of remote URLs, for instance for all *DAV services. With this setting, the default behavior can be overridden. To achieve a similar behavior as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users." => "Domyślnie, wewnętrzna nazwa użytkownika zostanie utworzona z atrybutu UUID, ang. Universally unique identifier - Unikalny identyfikator użytkownika. To daje pewność, że nazwa użytkownika jest niepowtarzalna, a znaki nie muszą być konwertowane. Wewnętrzna nazwa użytkownika dopuszcza jedynie znaki: [ a-zA-Z0-9_.@- ]. Pozostałe znaki zamieniane są na ich odpowiedniki ASCII lub po prostu pomijane. W przypadku, gdy nazwa się powtarza na końcu jest dodawana / zwiększana cyfra. Wewnętrzna nazwa użytkownika służy do wewnętrznej identyfikacji użytkownika. Jest to również domyślna nazwa folderu domowego użytkownika. Jest to również część zdalnego adresu URL, na przykład dla wszystkich usług *DAV. Dzięki temu ustawieniu można nadpisywać domyślne zachowanie aplikacji. Aby osiągnąć podobny efekt jak przed ownCloud 5 wpisz atrybut nazwy użytkownika w poniższym polu. Pozostaw puste dla domyślnego zachowania. Zmiany będą miały wpływ tylko na nowo przypisanych (dodanych) użytkowników LDAP.",
"Internal Username Attribute:" => "Wewnętrzny atrybut nazwy uzżytkownika:",
"Override UUID detection" => "Zastąp wykrywanie UUID",
"By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." => "Domyślnie, atrybut UUID jest wykrywany automatycznie. Atrybut UUID jest używany do niepodważalnej identyfikacji użytkowników i grup LDAP. Również wewnętrzna nazwa użytkownika zostanie stworzona na bazie UUID, jeśli nie zostanie podana powyżej. Możesz nadpisać to ustawienie i użyć atrybutu wedle uznania. Musisz się jednak upewnić, że atrybut ten może zostać pobrany zarówno dla użytkowników, jak i grup i jest unikalny. Pozostaw puste dla domyślnego zachowania. Zmiany będą miały wpływ tylko na nowo przypisanych (dodanych) użytkowników i grupy LDAP.",
"UUID Attribute for Users:" => "Atrybuty UUID dla użytkowników:",
"UUID Attribute for Groups:" => "Atrybuty UUID dla grup:",
"Username-LDAP User Mapping" => "Mapowanie użytkownika LDAP",
"Usernames are used to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have a internal username. This requires a mapping from username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found. The internal username is used all over. Clearing the mappings will have leftovers everywhere. Clearing the mappings is not configuration sensitive, it affects all LDAP configurations! Never clear the mappings in a production environment, only in a testing or experimental stage." => "Nazwy użytkowników są używane w celu przechowywania i przypisywania (meta) danych. Aby dokładnie zidentyfikować i rozpoznać użytkowników, każdy użytkownik LDAP będzie miał wewnętrzną nazwę. To wymaga utworzenia przypisania nazwy użytkownika do użytkownika LDAP. Utworzona nazwa użytkownika jet przypisywana do UUID użytkownika LDAP. Dodatkowo DN jest również buforowany aby zmniejszyć interakcję z LDAP, ale nie jest używany do identyfikacji. Jeśli DN się zmieni, zmiany zostaną odnalezione. Wewnętrzny użytkownik jest używany we wszystkich przypadkach. Wyczyszczenie mapowań spowoduje pozostawienie wszędzie resztek informacji. Wyczyszczenie mapowań nie jest wrażliwe na konfigurację, wpływa ono na wszystkie konfiguracje LDAP! Nigdy nie czyść mapowań w środowisku produkcyjnym, tylko podczas testów lub w fazie eksperymentalnej. ",
"Clear Username-LDAP User Mapping" => "Czyść Mapowanie użytkownika LDAP",
"Clear Groupname-LDAP Group Mapping" => "Czyść Mapowanie nazwy grupy LDAP"
);
$PLURAL_FORMS = "nplurals=3; plural=(n==1 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2);";
