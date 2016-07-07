OC.L10N.register(
    "user_ldap",
    {
    "Failed to clear the mappings." : "Falhou ao limpar os mapas.",
    "Failed to delete the server configuration" : "Erro ao eliminar a configuração do servidor",
    "The configuration is invalid: anonymous bind is not allowed." : "A configuração é inválida: ligação anónima não é permitida.",
    "The configuration is valid and the connection could be established!" : "A configuração está correcta e foi possível estabelecer a ligação!",
    "The configuration is valid, but the Bind failed. Please check the server settings and credentials." : "A configuração está correcta, mas não foi possível estabelecer a conexão. Por favor, verifique as configurações do servidor e as credenciais.",
    "The configuration is invalid. Please have a look at the logs for further details." : "A configuração é inválida. Por favor, veja o registo (log) do ownCloud para mais detalhes.",
    "No action specified" : "Nenhuma ação especificada",
    "No configuration specified" : "Nenhuma configuração especificada",
    "No data specified" : "Nenhuma data especificada",
    " Could not set configuration %s" : "Não foi possível definir a configuração %s",
    "Action does not exist" : "Não existe esta acção",
    "The Base DN appears to be wrong" : "O ND de base parece estar errado",
    "Testing configuration…" : "A testar a configuração…",
    "Configuration incorrect" : "Configuração incorreta",
    "Configuration incomplete" : "Configuração incompleta",
    "Configuration OK" : "Configuração OK",
    "Select groups" : "Seleccionar grupos",
    "Select object classes" : "Selecionar classes de objetos",
    "Please check the credentials, they seem to be wrong." : "Por favor verifique as credenciais, parecem estar erradas.",
    "Please specify the port, it could not be auto-detected." : "Por favor especifique a porta, não pode ser detetada automaticamente.",
    "Base DN could not be auto-detected, please revise credentials, host and port." : "O ND de base não pode ser detetado automaticamente, por favor verifique as credenciais, host e porta.",
    "Could not detect Base DN, please enter it manually." : "Não foi possível detetar o ND de base, por favor introduza-o manualmente.",
    "{nthServer}. Server" : "{nthServer}. Servidor",
    "No object found in the given Base DN. Please revise." : "Nenhum objecto encontrado na Base DN fornecida. Por favor verifique.",
    "More than 1,000 directory entries available." : "Mais de 1,000 entradas de diretório disponíveis.",
    " entries available within the provided Base DN" : "entradas disponíveis no ND de base fornecido",
    "An error occurred. Please check the Base DN, as well as connection settings and credentials." : "Ocorreu um erro. Por favor verifique o ND de base, bem como as definições de ligação e as credenciais.",
    "Do you really want to delete the current Server Configuration?" : "Deseja realmente apagar as configurações de servidor actuais?",
    "Confirm Deletion" : "Confirmar a operação de apagar",
    "Mappings cleared successfully!" : "Mapas limpos com sucesso!",
    "Error while clearing the mappings." : "Erro a limpar os mapas.",
    "Anonymous bind is not allowed. Please provide a User DN and Password." : "Ligação anónima não permitida. Por favor forneça um ND de utilizador e password.",
    "LDAP Operations error. Anonymous bind might not be allowed." : "Erro de operações LDAP. Ligação anónima pode não ser permitida.",
    "Saving failed. Please make sure the database is in Operation. Reload before continuing." : "Falha na gravação. Por favor verifique que a base de dados está operacional. Recarregar antes de continuar.",
    "Switching the mode will enable automatic LDAP queries. Depending on your LDAP size they may take a while. Do you still want to switch the mode?" : "Trocando o modo vai permitir a busca automática no LDAP. Dependendo do tamanho do seu LDAP poderá demorar um pouco. Ainda pretende trocar o modo?",
    "Mode switch" : "Trocar de modo",
    "Select attributes" : "Selecionar atributos",
    "User not found. Please check your login attributes and username. Effective filter (to copy-and-paste for command line validation): <br/>" : "O utilizador não foi encontrado. Por favor, verifique nome de utilizador e os atributos de permissão. Filtro eficaz (para copiar/colar na linha de comando de validação): <br/>",
    "User found and settings verified." : "Utilizador encontrado e as definilções verificadas",
    "Settings verified, but one user found. Only the first will be able to login. Consider a more narrow filter." : "Definições verificadas, com problemas. Somente o primeiro utilizador encontrado poderá entrar no sistema. Considere criar um filtro mais expecífico.",
    "An unspecified error occurred. Please check the settings and the log." : "ocorreu um erro não especificado. Por favor, verifique as configurações e o registo.",
    "The search filter is invalid, probably due to syntax issues like uneven number of opened and closed brackets. Please revise." : "O filtro de procura é inválido, provavelmente devido a problemas de sintaxe. Verifique se existem números ímpares de parêntisis abertos e/ou fechados. Por favor reveja.",
    "A connection error to LDAP / AD occurred, please check host, port and credentials." : "Ocorreu um erro de conexão ao servidor LDAP / AD. Por favor, reveja as definições de endereço, porto e credenciais.",
    "The %uid placeholder is missing. It will be replaced with the login name when querying LDAP / AD." : "O campo %uid está em falta. Este será substituído pelo utilizador do ownCloud quando for efectuado o pedido ao LDAP / AD.",
    "Please provide a login name to test against" : "Por favor, indique um nome de sessão para testar",
    "The group box was disabled, because the LDAP / AD server does not support memberOf." : "Uma vez que o servidor LDAP / AD não suporta a propriedade \"memberOf\" (grupos) a caixa de grupos foi desactivada.",
    "_%s group found_::_%s groups found_" : ["%s grupo encontrado","%s grupos encontrados"],
    "_%s user found_::_%s users found_" : ["%s utilizador encontrado","%s utilizadores encontrados"],
    "Could not detect user display name attribute. Please specify it yourself in advanced ldap settings." : "Não foi possível detetar o atributo do nome do utilizador. Por favor especifique-o nas configurações ldap avançadas.",
    "Could not find the desired feature" : "Não se encontrou a função desejada",
    "Invalid Host" : "Hospedeiro Inválido",
    "Server" : "Servidor",
    "Users" : "Utilizadores",
    "Login Attributes" : "Atributos de Sessão",
    "Groups" : "Grupos",
    "Test Configuration" : "Testar a configuração",
    "Help" : "Ajuda",
    "Groups meeting these criteria are available in %s:" : "Grupos que satisfazerem estes critérios estão disponíveis em %s:",
    "Only these object classes:" : "Apenas estas classes de objetos:",
    "Only from these groups:" : "Apenas destes grupos:",
    "Search groups" : "Procurar grupos",
    "Available groups" : "Grupos disponiveis",
    "Selected groups" : "Grupos seleccionados",
    "Edit LDAP Query" : "Modificar pedido LDAP",
    "LDAP Filter:" : "Filtro LDAP:",
    "The filter specifies which LDAP groups shall have access to the %s instance." : "O filtro especifica quais grupos LDAP devem ter acesso à instância %s.",
    "Verify settings and count groups" : "Verificar condições e contar grupos",
    "When logging in, %s will find the user based on the following attributes:" : "Quando entrar no sistema, %s irá encontrar o utilizador baseando-se nos seguintes atributos:",
    "LDAP / AD Username:" : "Nome de Utilizador LDAP / AD:",
    "Allows login against the LDAP / AD username, which is either uid or samaccountname and will be detected." : "Permitir entrar no sistema com verificação LDAP / AD, do qual o utilizador poderá ser detectado a partir do \"uid\" ou \"samaccountname\".",
    "LDAP / AD Email Address:" : "Endereço de Correio Eletrónico LDPA / AD",
    "Allows login against an email attribute. Mail and mailPrimaryAddress will be allowed." : "Permtir entrar no sistema a partir do atributo \"email\". Neste caso os campos \"Mail\" e \"mailPrimaryAddress\" serão utilizados para verificação.",
    "Other Attributes:" : "Outros Atributos:",
    "Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action. Example: \"uid=%%uid\"" : "Define o filtro a aplicar, quando se tenta uma sessão. %%uid substitui o nome de utilizador na ação de início de sessão. Exemplo: \"uid=%%uid\"",
    "Test Loginname" : "Testar nome de login",
    "Verify settings" : "Verificar definições",
    "1. Server" : "1. Servidor",
    "%s. Server:" : "%s. Servidor",
    "Add a new and blank configuration" : "Adicione uma nova configuração em branco",
    "Copy current configuration into new directory binding" : "Copiar a configuração actual para um novo registo de conexão",
    "Delete the current configuration" : "Apagar a configuração actual",
    "Host" : "Anfitrião",
    "You can omit the protocol, except you require SSL. Then start with ldaps://" : "Pode omitir o protocolo, excepto se necessitar de SSL. Neste caso, comece com ldaps://",
    "Port" : "Porto",
    "Detect Port" : "Detetar porta",
    "User DN" : "DN do utilizador",
    "The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." : "O DN to cliente ",
    "Password" : "Password",
    "For anonymous access, leave DN and Password empty." : "Para acesso anónimo, deixe DN e a Palavra-passe vazios.",
    "One Base DN per line" : "Uma base DN por linha",
    "You can specify Base DN for users and groups in the Advanced tab" : "Pode especificar o ND Base para utilizadores e grupos no separador Avançado",
    "Detect Base DN" : "Detectar Base DN",
    "Test Base DN" : "Testar Base DN",
    "Avoids automatic LDAP requests. Better for bigger setups, but requires some LDAP knowledge." : "Evita pedidos LDAP automáticos. Melhor para grandes configurações, mas requer conhecimentos LDAP.",
    "Manually enter LDAP filters (recommended for large directories)" : "Introduzir filtros LDAP manualmente (recomendado para directórios grandes)",
    "%s access is limited to users meeting these criteria:" : "O acesso %s está limitado para os utilizadores que reúnam estes critérios:",
    "The most common object classes for users are organizationalPerson, person, user, and inetOrgPerson. If you are not sure which object class to select, please consult your directory admin." : "Os objectos mais comuns para utilizadores são <em>organizationalPerson, person, user, and inetOrgPerson</em>. Se não tem a certeza de que classe de objecto deverá seleccionar, por favor, contacte o administrador do Directório.",
    "The filter specifies which LDAP users shall have access to the %s instance." : "O filtro especifica quais utilizadores do LDAP devem ter acesso  à instância %s.",
    "Verify settings and count users" : "Verificar definições e contar utilizadores",
    "Saving" : "Guardando",
    "Back" : "Voltar",
    "Continue" : "Continuar",
    "LDAP" : "LDAP",
    "Expert" : "Perito",
    "Advanced" : "Avançado",
    "<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." : "<b>Aviso:</b> A aplicação user_ldap e user_webdavauth são incompativeis. A aplicação pode tornar-se instável. Por favor, peça ao seu administrador para desactivar uma das aplicações.",
    "<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." : "<b>Aviso:</b> O módulo PHP LDAP não está instalado, logo não irá funcionar. Por favor peça ao administrador para o instalar.",
    "Connection Settings" : "Definições de ligação",
    "Configuration Active" : "Configuração activa",
    "When unchecked, this configuration will be skipped." : "Se não estiver marcada, esta definição não será tida em conta.",
    "Backup (Replica) Host" : "Servidor de Backup (Réplica)",
    "Give an optional backup host. It must be a replica of the main LDAP/AD server." : "Forneça um servidor (anfitrião) de backup. Deve ser uma réplica do servidor principal de LDAP/AD ",
    "Backup (Replica) Port" : "Porta do servidor de backup (Replica)",
    "Disable Main Server" : "Desactivar servidor principal",
    "Only connect to the replica server." : "Ligar apenas ao servidor de réplicas.",
    "Turn off SSL certificate validation." : "Desligar a validação de certificado SSL.",
    "Not recommended, use it for testing only! If connection only works with this option, import the LDAP server's SSL certificate in your %s server." : "Não recomendado, use-o somente para teste! ligação só funciona com esta opção, importar o certificado SSL do servidor LDAP para o seu servidor %s.",
    "Cache Time-To-Live" : "Cache do tempo de vida dos objetos no servidor",
    "in seconds. A change empties the cache." : "em segundos. Uma alteração esvazia a cache.",
    "Directory Settings" : "Definições de directorias",
    "User Display Name Field" : "Mostrador do nome de utilizador.",
    "The LDAP attribute to use to generate the user's display name." : "Atributo LDAP para gerar o nome de utilizador do ownCloud.",
    "2nd User Display Name Field" : "2.º Mostrador do Nome de Utilizador.",
    "Optional. An LDAP attribute to be added to the display name in brackets. Results in e.g. »John Doe (john.doe@example.org)«." : "Opcional. Atributo LDAP a ser adicionado ao nome de utilizador entre parênteses. Resultados em e.g. »John Doe (john.doe@example.org)«.",
    "Base User Tree" : "Base da árvore de utilizadores.",
    "One User Base DN per line" : "Uma base de utilizador DN por linha",
    "User Search Attributes" : "Utilizar atributos de pesquisa",
    "Optional; one attribute per line" : "Opcional; Um atributo por linha",
    "Group Display Name Field" : "Mostrador do nome do grupo.",
    "The LDAP attribute to use to generate the groups's display name." : "Atributo LDAP para gerar o nome do grupo do ownCloud.",
    "Base Group Tree" : "Base da árvore de grupos.",
    "One Group Base DN per line" : "Uma base de grupo DN por linha",
    "Group Search Attributes" : "Atributos de pesquisa de grupo",
    "Group-Member association" : "Associar utilizador ao grupo.",
    "Dynamic Group Member URL" : "URL Dinâmica de Membro do Grupo",
    "The LDAP attribute that on group objects contains an LDAP search URL that determines what objects belong to the group. (An empty setting disables dynamic group membership functionality.)" : "O atributo LDAP que em objetos de grupo contém um URL de pesquisa LDAP que determina que objetos pertencem ao grupo. (Uma definição vazia desativa a funcionalidade de membros de grupo dinâmico.)",
    "Nested Groups" : "Grupos agrupados",
    "When switched on, groups that contain groups are supported. (Only works if the group member attribute contains DNs.)" : "Quando habilitado os grupos, os grupos são suportados. (Só funciona se o atributo de membro de grupo contém DNs.)",
    "Paging chunksize" : "Bloco de paginação",
    "Chunksize used for paged LDAP searches that may return bulky results like user or group enumeration. (Setting it 0 disables paged LDAP searches in those situations.)" : "Tamanho do bloco usado para pesquisas LDAP paginados que podem retornar resultados volumosos como utilizador ou grupo de enumeração. (Defini-lo 0 desactiva paginada das pesquisas LDAP nessas situações.)",
    "Special Attributes" : "Atributos especiais",
    "Quota Field" : "Quota",
    "Quota Default" : "Quota padrão",
    "in bytes" : "em bytes",
    "Email Field" : "Campo de email",
    "User Home Folder Naming Rule" : "Regra da pasta inicial do utilizador",
    "Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." : "Deixe vazio para nome de utilizador (padrão). De outro modo, especifique um atributo LDAP/AD.",
    "Internal Username" : "Nome de utilizador interno",
    "By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder. It is also a part of remote URLs, for instance for all *DAV services. With this setting, the default behavior can be overridden. To achieve a similar behavior as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users." : "Por padrão o nome de utilizador interno vai ser criado através do atributo UUID. Desta forma é assegurado que o nome é único e os caracteres não necessitam de serem convertidos. O nome interno tem a restrição de que apenas estes caracteres são permitidos: [ a-zA-Z0-9_.@- ]. Outros caracteres são substituídos pela sua correspondência ASCII ou simplesmente omitidos. Mesmo assim, quando for detetado uma colisão irá ser acrescentado um número. O nome interno é usado para identificar o utilizador internamente. É também o nome utilizado para a pasta inicial no ownCloud. É também parte de URLs remotos, como por exemplo os serviços *DAV. Com esta definição, o comportamento padrão é pode ser sobreposto. Para obter o mesmo comportamento antes do ownCloud 5 introduza o atributo do nome no campo seguinte. Deixe vazio para obter o comportamento padrão. As alterações apenas serão feitas para utilizadores mapeados (adicionados) LDAP.",
    "Internal Username Attribute:" : "Atributo do nome de utilizador interno",
    "Override UUID detection" : "Passar a detecção do UUID",
    "By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." : "Por defeito, o ownCloud detecta automaticamente o atributo UUID. Este atributo é usado para identificar inequivocamente grupos e utilizadores LDAP. Igualmente, o nome de utilizador interno é criado com base no UUID, se o contrário não for especificado. Pode sobrepor esta definição colocando um atributo à sua escolha. Tenha em atenção que esse atributo deve ser válido tanto para grupos como para utilizadores, e que é único. Deixe em branco para optar pelo comportamento por defeito. Estas alteração apenas terão efeito em novos utilizadores e grupos mapeados (adicionados).",
    "UUID Attribute for Users:" : "Atributo UUID para utilizadores:",
    "UUID Attribute for Groups:" : "Atributo UUID para grupos:",
    "Username-LDAP User Mapping" : "Mapeamento do utilizador LDAP",
    "Usernames are used to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have an internal username. This requires a mapping from username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found. The internal username is used all over. Clearing the mappings will have leftovers everywhere. Clearing the mappings is not configuration sensitive, it affects all LDAP configurations! Never clear the mappings in a production environment, only in a testing or experimental stage." : "O ownCloud usa nomes de utilizadores para guardar e atribuir (meta) dados. Para identificar com precisão os utilizadores, cada utilizador de LDAP tem um nome de utilizador interno. Isto requer um mapeamento entre o utilizador LDAP e o utilizador ownCloud. Adicionalmente, o DN é colocado em cache para reduzir a interação com LDAP, porém não é usado para identificação. Se o DN muda, essas alterações serão vistas pelo ownCloud. O nome interno do ownCloud é usado em todo o lado, no ownCloud. Limpar os mapeamentos deixará vestígios em todo o lado. A limpeza dos mapeamentos não é sensível à configuração, pois afeta todas as configurações de LDAP! Nunca limpe os mapeamentos num ambiente de produção, apenas o faça numa fase de testes ou experimental.",
    "Clear Username-LDAP User Mapping" : "Limpar mapeamento do utilizador-LDAP",
    "Clear Groupname-LDAP Group Mapping" : "Limpar o mapeamento do nome de grupo LDAP"
},
"nplurals=2; plural=(n != 1);");
