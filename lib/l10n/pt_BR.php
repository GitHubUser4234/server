<?php
$TRANSLATIONS = array(
"Cannot write into \"config\" directory!" => "Não é possível gravar no diretório \"config\"!",
"This can usually be fixed by giving the webserver write access to the config directory" => "Isso geralmente pode ser corrigido dando o acesso de gravação ao webserver para o diretório de configuração",
"See %s" => "Ver %s",
"This can usually be fixed by %sgiving the webserver write access to the config directory%s." => "Isso geralmente pode ser corrigido dando permissão de gravação %sgiving ao webserver para o directory%s de configuração.",
"You are accessing the server from an untrusted domain." => "Você está acessando o servidor a partir de um domínio não confiável.",
"Please contact your administrator. If you are an administrator of this instance, configure the \"trusted_domain\" setting in config/config.php. An example configuration is provided in config/config.sample.php." => "Por favor, contate o administrador. Se você é um administrador desta instância, configurre o \"trusted_domain\" em config/config.php. Um exemplo de configuração é fornecido em config/config.sample.php.",
"Help" => "Ajuda",
"Personal" => "Pessoal",
"Settings" => "Configurações",
"Users" => "Usuários",
"Admin" => "Admin",
"Failed to upgrade \"%s\"." => "Falha na atualização de \"%s\".",
"App \\\"%s\\\" can't be installed because it is not compatible with this version of ownCloud." => "Aplicação \\\"%s\\\" não pode ser instalada porque não é compatível com esta versão do ownCloud.",
"No app name specified" => "O nome do aplicativo não foi especificado.",
"Unknown filetype" => "Tipo de arquivo desconhecido",
"Invalid image" => "Imagem inválida",
"web services under your control" => "serviços web sob seu controle",
"App directory already exists" => "Diretório App  já existe",
"Can't create app folder. Please fix permissions. %s" => "Não é possível criar pasta app. Corrija as permissões. %s",
"No source specified when installing app" => "Nenhuma fonte foi especificada enquanto instalava o aplicativo",
"No href specified when installing app from http" => "Nenhuma href foi especificada enquanto instalava o aplicativo de http",
"No path specified when installing app from local file" => "Nenhum caminho foi especificado enquanto instalava o aplicativo do arquivo local",
"Archives of type %s are not supported" => "Arquivos do tipo %s não são suportados",
"Failed to open archive when installing app" => "Falha para abrir o arquivo enquanto instalava o aplicativo",
"App does not provide an info.xml file" => "O aplicativo não fornece um arquivo info.xml",
"App can't be installed because of not allowed code in the App" => "O aplicativo não pode ser instalado por causa do código não permitido no Aplivativo",
"App can't be installed because it is not compatible with this version of ownCloud" => "O aplicativo não pode ser instalado porque não é compatível com esta versão do ownCloud",
"App can't be installed because it contains the <shipped>true</shipped> tag which is not allowed for non shipped apps" => "O aplicativo não pode ser instalado porque ele contém a marca <shipped>verdadeiro</shipped> que não é permitido para aplicações não embarcadas",
"App can't be installed because the version in info.xml/version is not the same as the version reported from the app store" => "O aplicativo não pode ser instalado porque a versão em info.xml/versão não é a mesma que a versão relatada na App Store",
"Application is not enabled" => "Aplicação não está habilitada",
"Authentication error" => "Erro de autenticação",
"Token expired. Please reload page." => "Token expirou. Por favor recarregue a página.",
"Unknown user" => "Usuário desconhecido",
"%s enter the database username." => "%s insira o nome de usuário do banco de dados.",
"%s enter the database name." => "%s insira o nome do banco de dados.",
"%s you may not use dots in the database name" => "%s você não pode usar pontos no nome do banco de dados",
"MS SQL username and/or password not valid: %s" => "Nome de usuário e/ou senha MS SQL inválido(s): %s",
"You need to enter either an existing account or the administrator." => "Você precisa inserir uma conta existente ou a do administrador.",
"MySQL/MariaDB username and/or password not valid" => "MySQL/MariaDB nome de usuário e/ou senha não é válida",
"DB Error: \"%s\"" => "Erro no BD: \"%s\"",
"Offending command was: \"%s\"" => "Comando ofensivo era: \"%s\"",
"MySQL/MariaDB user '%s'@'localhost' exists already." => "MySQL/MariaDB usuário '%s'@'localhost' já existe.",
"Drop this user from MySQL/MariaDB" => "Eliminar esse usuário de MySQL/MariaDB",
"MySQL/MariaDB user '%s'@'%%' already exists" => "MySQL/MariaDB usuário '%s'@'%%' já existe",
"Drop this user from MySQL/MariaDB." => "Eliminar esse usuário de MySQL/MariaDB",
"Oracle connection could not be established" => "Conexão Oracle não pode ser estabelecida",
"Oracle username and/or password not valid" => "Nome de usuário e/ou senha Oracle inválido(s)",
"Offending command was: \"%s\", name: %s, password: %s" => "Comando ofensivo era: \"%s\", nome: %s, senha: %s",
"PostgreSQL username and/or password not valid" => "Nome de usuário e/ou senha PostgreSQL inválido(s)",
"Set an admin username." => "Defina um nome do usuário administrador.",
"Set an admin password." => "Defina uma senha de administrador.",
"Your web server is not yet properly setup to allow files synchronization because the WebDAV interface seems to be broken." => "Seu servidor web não está configurado corretamente para permitir sincronização de arquivos porque a interface WebDAV parece não estar funcionando.",
"Please double check the <a href='%s'>installation guides</a>." => "Por favor, confira os <a href='%s'>guias de instalação</a>.",
"%s shared »%s« with you" => "%s compartilhou »%s« com você",
"Sharing %s failed, because the file does not exist" => "Compartilhamento %s falhou, porque o arquivo não existe",
"You are not allowed to share %s" => "Você não tem permissão para compartilhar %s",
"Sharing %s failed, because the user %s is the item owner" => "Compartilhamento %s falhou, porque o usuário %s é o proprietário do item",
"Sharing %s failed, because the user %s does not exist" => "Compartilhamento %s falhou, porque o usuário %s não existe",
"Sharing %s failed, because the user %s is not a member of any groups that %s is a member of" => "Compartilhamento %s falhou, porque o usuário %s não é membro de nenhum grupo que o usuário %s pertença",
"Sharing %s failed, because this item is already shared with %s" => "Compartilhamento %s falhou, porque este ítem já está compartilhado com %s",
"Sharing %s failed, because the group %s does not exist" => "Compartilhamento %s falhou, porque o grupo %s não existe",
"Sharing %s failed, because %s is not a member of the group %s" => "Compartilhamento %s falhou, porque  %s não é membro do grupo %s",
"You need to provide a password to create a public link, only protected links are allowed" => "Você precisa fornecer uma senha para criar um link público, apenas links protegidos são permitidos",
"Sharing %s failed, because sharing with links is not allowed" => "Compartilhamento %s falhou, porque compartilhamento com links não é permitido",
"Share type %s is not valid for %s" => "Tipo de compartilhamento %s não é válido para %s",
"Setting permissions for %s failed, because the permissions exceed permissions granted to %s" => "Definir permissões para %s falhou, porque as permissões excedem as permissões concedidas a %s",
"Setting permissions for %s failed, because the item was not found" => "Definir permissões para %s falhou, porque o item não foi encontrado",
"Can not set expire date. Shares can not expire later then %s after they where shared" => "Não pode ser definida data de expiração. Compartilhamentos não podem ter data de expiração %s após serem compartilhados",
"Can not set expire date. Expire date is in the past" => "Não pode ser definida data de expiração. Data de expiração já passou",
"Sharing backend %s must implement the interface OCP\\Share_Backend" => "Compartilhando backend %s deve implementar a interface OCP\\Share_Backend",
"Sharing backend %s not found" => "Compartilhamento backend %s não encontrado",
"Sharing backend for %s not found" => "Compartilhamento backend para %s não encontrado",
"Sharing %s failed, because the user %s is the original sharer" => "Compartilhando %s falhou, porque o usuário %s é o compartilhador original",
"Sharing %s failed, because the permissions exceed permissions granted to %s" => "Compartilhamento %s falhou, porque as permissões excedem as permissões concedidas a %s",
"Sharing %s failed, because resharing is not allowed" => "Compartilhamento %s falhou, porque recompartilhamentos não são permitidos",
"Sharing %s failed, because the sharing backend for %s could not find its source" => "Compartilhamento %s falhou, porque a infra-estrutura de compartilhamento para %s não conseguiu encontrar a sua fonte",
"Sharing %s failed, because the file could not be found in the file cache" => "Compartilhamento %s falhou, porque o arquivo não pôde ser encontrado no cache de arquivos",
"Could not find category \"%s\"" => "Impossível localizar categoria \"%s\"",
"seconds ago" => "segundos atrás",
"_%n minute ago_::_%n minutes ago_" => array("","ha %n minutos"),
"_%n hour ago_::_%n hours ago_" => array("","ha %n horas"),
"today" => "hoje",
"yesterday" => "ontem",
"_%n day go_::_%n days ago_" => array("","ha %n dias"),
"last month" => "último mês",
"_%n month ago_::_%n months ago_" => array("","ha %n meses"),
"last year" => "último ano",
"years ago" => "anos atrás",
"Only the following characters are allowed in a username: \"a-z\", \"A-Z\", \"0-9\", and \"_.@-\"" => "Somente os seguintes caracteres são permitidos no nome do usuário: \"a-z\", \"A-Z\", \"0-9\", e \"_.@-\"",
"A valid username must be provided" => "Forneça um nome de usuário válido",
"A valid password must be provided" => "Forneça uma senha válida",
"The username is already being used" => "Este nome de usuário já está sendo usado",
"No database drivers (sqlite, mysql, or postgresql) installed." => "Nenhum driver  de banco de dados (sqlite, mysql, or postgresql) instalado.",
"Permissions can usually be fixed by %sgiving the webserver write access to the root directory%s." => "Permissões podem ser corrigidas dando permissão de escita %sgiving ao webserver para o diretório raiz directory%s",
"Cannot write into \"config\" directory" => "Não é possível gravar no diretório \"config\"",
"Cannot write into \"apps\" directory" => "Não é possível gravar no diretório \"apps\"",
"This can usually be fixed by %sgiving the webserver write access to the apps directory%s or disabling the appstore in the config file." => "Isto pode ser corrigido dando ao webserver permissão de escrita %sgiving para o diretório apps directory%s ou desabilitando o appstore no arquivo de configuração.",
"Cannot create \"data\" directory (%s)" => "Não pode ser criado \"dados\" no diretório (%s)",
"This can usually be fixed by <a href=\"%s\" target=\"_blank\">giving the webserver write access to the root directory</a>." => "Isto pode ser corrigido por <a href=\"%s\" target=\"_blank\">dando ao webserver permissão de escrita ao diretório raiz</a>.",
"Setting locale to %s failed" => "Falha ao configurar localidade para %s",
"Please install one of theses locales on your system and restart your webserver." => "Por favor, instale um dessas localidades em seu sistema e reinicie seu servidor web.",
"Please ask your server administrator to install the module." => "Por favor, peça ao seu administrador do servidor para instalar o módulo.",
"PHP module %s not installed." => "Módulo PHP %s não instalado.",
"PHP %s or higher is required." => "É requerido PHP %s ou superior.",
"Please ask your server administrator to update PHP to the latest version. Your PHP version is no longer supported by ownCloud and the PHP community." => "Por favor, peça ao seu administrador do servidor para atualizar o PHP para a versão mais recente. A sua versão do PHP não é mais suportado pelo ownCloud e a comunidade PHP.",
"PHP Safe Mode is enabled. ownCloud requires that it is disabled to work properly." => "PHP Safe Mode está habilitado. ownCloud exige que ele esteja desativado para funcionar corretamente.",
"PHP Safe Mode is a deprecated and mostly useless setting that should be disabled. Please ask your server administrator to disable it in php.ini or in your webserver config." => "PHP Safe Mode é um cenário obsoleto e praticamente inútil que deve ser desativado. Por favor, peça ao seu administrador do servidor para desativá-lo no php.ini ou na sua configuração webserver.",
"Magic Quotes is enabled. ownCloud requires that it is disabled to work properly." => "Magic Quotes está habilitado. ownCloud exige que ele esteja desativado para funcionar corretamente.",
"Magic Quotes is a deprecated and mostly useless setting that should be disabled. Please ask your server administrator to disable it in php.ini or in your webserver config." => "Magic Quotes é um cenário obsoleto e praticamente inútil que deve ser desativado. Por favor, peça ao seu administrador do servidor para desativá-lo no php.ini ou na sua configuração webserver.",
"PHP modules have been installed, but they are still listed as missing?" => "Módulos do PHP foram instalados, mas eles ainda estão listados como desaparecidos?",
"Please ask your server administrator to restart the web server." => "Por favor, peça ao seu administrador do servidor para reiniciar o servidor web.",
"PostgreSQL >= 9 required" => "PostgreSQL >= 9 requirido",
"Please upgrade your database version" => "Por favor, atualize sua versão do banco de dados",
"Error occurred while checking PostgreSQL version" => "Erro ao verificar a versão do PostgreSQL",
"Please make sure you have PostgreSQL >= 9 or check the logs for more information about the error" => "Por favor, verifique se você tem PostgreSQL> = 9 ou verificar os logs para obter mais informações sobre o erro",
"Please change the permissions to 0770 so that the directory cannot be listed by other users." => "Por favor, altere as permissões para 0770 para que o diretório não possa ser listado por outros usuários.",
"Data directory (%s) is readable by other users" => "Diretório de dados (%s) pode ser lido por outros usuários",
"Data directory (%s) is invalid" => "Diretório de dados (%s) é inválido",
"Please check that the data directory contains a file \".ocdata\" in its root." => "Por favor, verifique se o diretório de dados contém um arquivo \".ocdata\" em sua raiz.",
"Could not obtain lock type %d on \"%s\"." => "Não foi possível obter tipo de bloqueio %d em \"%s\"."
);
$PLURAL_FORMS = "nplurals=2; plural=(n > 1);";
