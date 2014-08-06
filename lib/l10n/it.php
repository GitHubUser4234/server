<?php
$TRANSLATIONS = array(
"Cannot write into \"config\" directory!" => "Impossibile scrivere nella cartella \"config\".",
"This can usually be fixed by giving the webserver write access to the config directory" => "Ciò può essere normalmente corretto fornendo al server web accesso in scrittura alla cartella \"config\"",
"See %s" => "Vedere %s",
"This can usually be fixed by %sgiving the webserver write access to the config directory%s." => "Ciò può essere normalmente corretto %sfornendo al server web accesso in scrittura alla cartella \"config\"%s",
"You are accessing the server from an untrusted domain." => "Stai accedendo al server da un dominio non affidabile.",
"Please contact your administrator. If you are an administrator of this instance, configure the \"trusted_domain\" setting in config/config.php. An example configuration is provided in config/config.sample.php." => "Contatta il tuo amministratore di sistema. Se sei un amministratore, configura l'impostazione \"trusted_domain\" in config/config.php. Un esempio di configurazione è disponibile in config/config.sample.php.",
"Help" => "Aiuto",
"Personal" => "Personale",
"Settings" => "Impostazioni",
"Users" => "Utenti",
"Admin" => "Admin",
"Failed to upgrade \"%s\"." => "Aggiornamento non riuscito \"%s\".",
"App \\\"%s\\\" can't be installed because it is not compatible with this version of ownCloud." => "L'applicazione \\\"%s\\\" non può essere installata poiché non è compatibile con questa versione di ownCloud.",
"No app name specified" => "Il nome dell'applicazione non è specificato",
"Unknown filetype" => "Tipo di file sconosciuto",
"Invalid image" => "Immagine non valida",
"web services under your control" => "servizi web nelle tue mani",
"App directory already exists" => "La cartella dell'applicazione esiste già",
"Can't create app folder. Please fix permissions. %s" => "Impossibile creare la cartella dell'applicazione. Correggi i permessi. %s",
"No source specified when installing app" => "Nessuna fonte specificata durante l'installazione dell'applicazione",
"No href specified when installing app from http" => "Nessun href specificato durante l'installazione dell'applicazione da http",
"No path specified when installing app from local file" => "Nessun percorso specificato durante l'installazione dell'applicazione da file locale",
"Archives of type %s are not supported" => "Gli archivi di tipo %s non sono supportati",
"Failed to open archive when installing app" => "Apertura archivio non riuscita durante l'installazione dell'applicazione",
"App does not provide an info.xml file" => "L'applicazione non fornisce un file info.xml",
"App can't be installed because of not allowed code in the App" => "L'applicazione non può essere installata a causa di codice non consentito al suo interno",
"App can't be installed because it is not compatible with this version of ownCloud" => "L'applicazione non può essere installata poiché non è compatibile con questa versione di ownCloud",
"App can't be installed because it contains the <shipped>true</shipped> tag which is not allowed for non shipped apps" => "L'applicazione non può essere installata poiché contiene il tag <shipped>true<shipped> che è consentito per le applicazioni native",
"App can't be installed because the version in info.xml/version is not the same as the version reported from the app store" => "L'applicazione non può essere installata poiché la versione in info.xml/version non è la stessa riportata dall'app store",
"Application is not enabled" => "L'applicazione  non è abilitata",
"Authentication error" => "Errore di autenticazione",
"Token expired. Please reload page." => "Token scaduto. Ricarica la pagina.",
"Unknown user" => "Utente sconosciuto",
"%s enter the database username." => "%s digita il nome utente del database.",
"%s enter the database name." => "%s digita il nome del database.",
"%s you may not use dots in the database name" => "%s non dovresti utilizzare punti nel nome del database",
"MS SQL username and/or password not valid: %s" => "Nome utente e/o password MS SQL non validi: %s",
"You need to enter either an existing account or the administrator." => "È necessario inserire un account esistente o l'amministratore.",
"MySQL/MariaDB username and/or password not valid" => "Nome utente e/o password di MySQL/MariaDB non validi",
"DB Error: \"%s\"" => "Errore DB: \"%s\"",
"Offending command was: \"%s\"" => "Il comando non consentito era: \"%s\"",
"MySQL/MariaDB user '%s'@'localhost' exists already." => "L'utente MySQL/MariaDB '%s'@'localhost' esiste già.",
"Drop this user from MySQL/MariaDB" => "Elimina questo utente da MySQL/MariaDB",
"MySQL/MariaDB user '%s'@'%%' already exists" => "L'utente MySQL/MariaDB '%s'@'%%' esiste già",
"Drop this user from MySQL/MariaDB." => "Elimina questo utente da MySQL/MariaDB.",
"Oracle connection could not be established" => "La connessione a Oracle non può essere stabilita",
"Oracle username and/or password not valid" => "Nome utente e/o password di Oracle non validi",
"Offending command was: \"%s\", name: %s, password: %s" => "Il comando non consentito era: \"%s\", nome: %s, password: %s",
"PostgreSQL username and/or password not valid" => "Nome utente e/o password di PostgreSQL non validi",
"Set an admin username." => "Imposta un nome utente di amministrazione.",
"Set an admin password." => "Imposta una password di amministrazione.",
"Your web server is not yet properly setup to allow files synchronization because the WebDAV interface seems to be broken." => "Il tuo server web non è configurato correttamente per consentire la sincronizzazione dei file poiché l'interfaccia WebDAV sembra essere danneggiata.",
"Please double check the <a href='%s'>installation guides</a>." => "Leggi attentamente le <a href='%s'>guide d'installazione</a>.",
"%s shared »%s« with you" => "%s ha condiviso «%s» con te",
"Sharing %s failed, because the file does not exist" => "Condivisione di %s non riuscita, poiché il file non esiste",
"You are not allowed to share %s" => "Non ti è consentito condividere %s",
"Sharing %s failed, because the user %s is the item owner" => "Condivisione di %s non riuscita, poiché l'utente %s è il proprietario dell'oggetto",
"Sharing %s failed, because the user %s does not exist" => "Condivisione di %s non riuscita, poiché l'utente %s non esiste",
"Sharing %s failed, because the user %s is not a member of any groups that %s is a member of" => "Condivisione di %s non riuscita, poiché l'utente %s non appartiene ad alcun gruppo di cui %s è membro",
"Sharing %s failed, because this item is already shared with %s" => "Condivisione di %s non riuscita, poiché l'oggetto è già condiviso con %s",
"Sharing %s failed, because the group %s does not exist" => "Condivisione di %s non riuscita, poiché il gruppo %s non esiste",
"Sharing %s failed, because %s is not a member of the group %s" => "Condivisione di %s non riuscita, poiché %s non appartiene al gruppo %s",
"You need to provide a password to create a public link, only protected links are allowed" => "Devi fornire una password per creare un collegamento pubblico, sono consentiti solo i collegamenti protetti",
"Sharing %s failed, because sharing with links is not allowed" => "Condivisione di %s non riuscita, poiché i collegamenti non sono consentiti",
"Share type %s is not valid for %s" => "Il tipo di condivisione %s non è valido per %s",
"Setting permissions for %s failed, because the permissions exceed permissions granted to %s" => "Impostazione permessi per %s non riuscita, poiché i permessi superano i permessi accordati a %s",
"Setting permissions for %s failed, because the item was not found" => "Impostazione permessi per %s non riuscita, poiché l'elemento non è stato trovato",
"Cannot set expiration date. Shares cannot expire later than %s after they where shared" => "Impossibile impostare la data di scadenza. Le condivisioni non possono scadere più tardi di %s dalla loro attivazione.",
"Cannot set expiration date. Expiration date is in the past" => "Impossibile impostare la data di scadenza. La data di scadenza è nel passato.",
"Sharing backend %s must implement the interface OCP\\Share_Backend" => "Il motore di condivisione %s deve implementare l'interfaccia OCP\\Share_Backend",
"Sharing backend %s not found" => "Motore di condivisione %s non trovato",
"Sharing backend for %s not found" => "Motore di condivisione di %s non trovato",
"Sharing %s failed, because the user %s is the original sharer" => "Condivisione di %s non riuscita, poiché l'utente %s l'ha condiviso precedentemente",
"Sharing %s failed, because the permissions exceed permissions granted to %s" => "Condivisione di %s non riuscita, poiché i permessi superano quelli accordati a %s",
"Sharing %s failed, because resharing is not allowed" => "Condivisione di %s non riuscita, poiché la ri-condivisione non è consentita",
"Sharing %s failed, because the sharing backend for %s could not find its source" => "Condivisione di %s non riuscita, poiché il motore di condivisione per %s non riesce a trovare la sua fonte",
"Sharing %s failed, because the file could not be found in the file cache" => "Condivisione di %s non riuscita, poiché il file non è stato trovato nella cache",
"Could not find category \"%s\"" => "Impossibile trovare la categoria \"%s\"",
"seconds ago" => "secondi fa",
"_%n minute ago_::_%n minutes ago_" => array("%n minuto fa","%n minuti fa"),
"_%n hour ago_::_%n hours ago_" => array("%n ora fa","%n ore fa"),
"today" => "oggi",
"yesterday" => "ieri",
"_%n day go_::_%n days ago_" => array("%n giorno fa","%n giorni fa"),
"last month" => "mese scorso",
"_%n month ago_::_%n months ago_" => array("%n mese fa","%n mesi fa"),
"last year" => "anno scorso",
"years ago" => "anni fa",
"Only the following characters are allowed in a username: \"a-z\", \"A-Z\", \"0-9\", and \"_.@-\"" => "Solo i seguenti caratteri sono ammessi in un nome utente: \"a-z\", \"A-Z\", \"0-9\", e \"_.@-\"",
"A valid username must be provided" => "Deve essere fornito un nome utente valido",
"A valid password must be provided" => "Deve essere fornita una password valida",
"The username is already being used" => "Il nome utente è già utilizzato",
"No database drivers (sqlite, mysql, or postgresql) installed." => "Nessun driver di database (sqlite, mysql o postgresql) installato",
"Permissions can usually be fixed by %sgiving the webserver write access to the root directory%s." => "I permessi possono essere normalmente corretti %sfornendo al server web accesso in scrittura alla cartella radice%s.",
"Cannot write into \"config\" directory" => "Impossibile scrivere nella cartella \"config\"",
"Cannot write into \"apps\" directory" => "Impossibile scrivere nella cartella \"apps\"",
"This can usually be fixed by %sgiving the webserver write access to the apps directory%s or disabling the appstore in the config file." => "Ciò può essere normalmente corretto %sfornendo al server web accesso in scrittura alla cartella \"apps\"%s o disabilitando il negozio di applicazioni nel file di configurazione.",
"Cannot create \"data\" directory (%s)" => "Impossibile creare la cartella \"data\" (%s)",
"This can usually be fixed by <a href=\"%s\" target=\"_blank\">giving the webserver write access to the root directory</a>." => "Ciò può essere normalmente corretto <a href=\"%s\" target=\"_blank\">fornendo al server web accesso in scrittura alla cartella radice</a>.",
"Setting locale to %s failed" => "L'impostazione della localizzazione a %s non è riuscita",
"Please install one of theses locales on your system and restart your webserver." => "Installa una delle seguenti localizzazioni sul tuo sistema e riavvia il server web.",
"Please ask your server administrator to install the module." => "Chiedi all'amministratore del tuo server di installare il modulo.",
"PHP module %s not installed." => "Il modulo PHP %s non è installato.",
"PHP %s or higher is required." => "Richiesto PHP %s o superiore",
"Please ask your server administrator to update PHP to the latest version. Your PHP version is no longer supported by ownCloud and the PHP community." => "Chiedi al tuo amministratore di aggiornare PHP all'ultima versione. La tua versione di PHP non è più supportata da ownCloud e dalla comunità di PHP.",
"PHP Safe Mode is enabled. ownCloud requires that it is disabled to work properly." => "PHP Safe Mode è abilitato. ownCloud richiede che sia disabilitato per funzionare correttamente.",
"PHP Safe Mode is a deprecated and mostly useless setting that should be disabled. Please ask your server administrator to disable it in php.ini or in your webserver config." => "PHP Safe Mode è un'impostazione sconsigliata e solitamente inutile che dovrebbe essere disabilitata. Chiedi al tuo amministratore di disabilitarlo nel file php.ini o nella configurazione del server web.",
"Magic Quotes is enabled. ownCloud requires that it is disabled to work properly." => "Magic Quotes è abilitato. ownCloud richiede che sia disabilitato per funzionare correttamente.",
"Magic Quotes is a deprecated and mostly useless setting that should be disabled. Please ask your server administrator to disable it in php.ini or in your webserver config." => "Magic Quotes è un'impostazione sconsigliata e solitamente inutile che dovrebbe essere disabilitata. Chiedi al tuo amministratore di disabilitarlo nel file php.ini o nella configurazione del server web.",
"PHP modules have been installed, but they are still listed as missing?" => "Sono stati installati moduli PHP, ma sono elencati ancora come mancanti?",
"Please ask your server administrator to restart the web server." => "Chiedi all'amministratore di riavviare il server web.",
"PostgreSQL >= 9 required" => "Richiesto PostgreSQL >= 9",
"Please upgrade your database version" => "Aggiorna la versione del tuo database",
"Error occurred while checking PostgreSQL version" => "Si è verificato un errore durante il controllo della versione di PostgreSQL",
"Please make sure you have PostgreSQL >= 9 or check the logs for more information about the error" => "Assicurati di avere PostgreSQL  >= 9 o controlla i log per ulteriori informazioni sull'errore",
"Please change the permissions to 0770 so that the directory cannot be listed by other users." => "Modifica i permessi in 0770 in modo tale che la cartella non sia leggibile dagli altri utenti.",
"Data directory (%s) is readable by other users" => "La cartella dei dati (%s) è leggibile dagli altri utenti",
"Data directory (%s) is invalid" => "La cartella dei dati (%s) non è valida",
"Please check that the data directory contains a file \".ocdata\" in its root." => "Verifica che la cartella dei dati contenga un file \".ocdata\" nella sua radice.",
"Could not obtain lock type %d on \"%s\"." => "Impossibile ottenere il blocco di tipo %d su \"%s\"."
);
$PLURAL_FORMS = "nplurals=2; plural=(n != 1);";
