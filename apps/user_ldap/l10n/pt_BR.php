<?php $TRANSLATIONS = array(
"Failed to clear the mappings." => "Falha ao limpar os mapeamentos.",
"Failed to delete the server configuration" => "Falha ao deletar a configuração do servidor",
"The configuration is valid and the connection could be established!" => "A configuração é válida e a conexão foi estabelecida!",
"The configuration is valid, but the Bind failed. Please check the server settings and credentials." => "A configuração é válida, mas o Bind falhou. Confira as configurações do servidor e as credenciais.",
"The configuration is invalid. Please look in the ownCloud log for further details." => "A configuração é inválida. Leia o log do ownCloud para mais detalhes.",
"Deletion failed" => "Remoção falhou",
"Take over settings from recent server configuration?" => "Tomar parámetros de recente configuração de servidor?",
"Keep settings?" => "Manter ajustes?",
"Cannot add server configuration" => "Impossível adicionar a configuração do servidor",
"mappings cleared" => "mapeamentos limpos",
"Success" => "Sucesso",
"Error" => "Erro",
"Connection test succeeded" => "Teste de conexão bem sucedida",
"Connection test failed" => "Teste de conexão falhou",
"Do you really want to delete the current Server Configuration?" => "Você quer realmente deletar as atuais Configurações de Servidor?",
"Confirm Deletion" => "Confirmar Exclusão",
"<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behaviour. Please ask your system administrator to disable one of them." => "<b>Aviso:</b> Os aplicativos user_ldap e user_webdavauth são incompatíveis. Você deverá experienciar comportamento inesperado. Por favor, peça ao seu administrador do sistema para desabilitar um deles.",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>Aviso:</b> O módulo PHP LDAP não está instalado, o backend não funcionará. Por favor, peça ao seu administrador do sistema para instalá-lo.",
"Server configuration" => "Configuração de servidor",
"Add Server Configuration" => "Adicionar Configuração de Servidor",
"Host" => "Servidor",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "Você pode omitir o protocolo, exceto quando requerer SSL. Então inicie com ldaps://",
"Base DN" => "DN Base",
"One Base DN per line" => "Uma base DN por linha",
"You can specify Base DN for users and groups in the Advanced tab" => "Você pode especificar DN Base para usuários e grupos na guia Avançada",
"User DN" => "DN Usuário",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "O DN do cliente usuário com qual a ligação deverá ser feita, ex. uid=agent,dc=example,dc=com. Para acesso anônimo, deixe DN e Senha vazios.",
"Password" => "Senha",
"For anonymous access, leave DN and Password empty." => "Para acesso anônimo, deixe DN e Senha vazios.",
"User Login Filter" => "Filtro de Login de Usuário",
"Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action." => "Define o filtro pra aplicar ao efetuar uma tentativa de login. %%uuid substitui o nome de usuário na ação de login.",
"use %%uid placeholder, e.g. \"uid=%%uid\"" => "use %%uid placeholder, ex. \"uid=%%uid\"",
"User List Filter" => "Filtro de Lista de Usuário",
"Defines the filter to apply, when retrieving users." => "Define filtro a ser aplicado ao obter usuários.",
"without any placeholder, e.g. \"objectClass=person\"." => "sem nenhum espaço reservado, ex. \"objectClass=person\".",
"Group Filter" => "Filtro de Grupo",
"Defines the filter to apply, when retrieving groups." => "Define o filtro a aplicar ao obter grupos.",
"without any placeholder, e.g. \"objectClass=posixGroup\"." => "sem nenhum espaço reservado, ex.  \"objectClass=posixGroup\"",
"Connection Settings" => "Configurações de Conexão",
"Configuration Active" => "Configuração ativa",
"When unchecked, this configuration will be skipped." => "Quando não marcada, esta configuração será ignorada.",
"Port" => "Porta",
"Backup (Replica) Host" => "Servidor de Backup (Réplica)",
"Give an optional backup host. It must be a replica of the main LDAP/AD server." => "Defina um servidor de backup opcional. Ele deverá ser uma réplica do servidor LDAP/AD principal.",
"Backup (Replica) Port" => "Porta do Backup (Réplica)",
"Disable Main Server" => "Desativar Servidor Principal",
"When switched on, ownCloud will only connect to the replica server." => "Quando ativado, ownCloud somente se conectará ao servidor de réplica.",
"Use TLS" => "Usar TLS",
"Do not use it additionally for LDAPS connections, it will fail." => "Não use adicionalmente para conexões LDAPS, pois falhará.",
"Case insensitve LDAP server (Windows)" => "Servidor LDAP sensível à caixa alta (Windows)",
"Turn off SSL certificate validation." => "Desligar validação de certificado SSL.",
"If connection only works with this option, import the LDAP server's SSL certificate in your ownCloud server." => "Se a conexão só funciona com essa opção, importe o certificado SSL do servidor LDAP no seu servidor ownCloud.",
"Not recommended, use for testing only." => "Não recomendado, use somente para testes.",
"Cache Time-To-Live" => "Cache Time-To-Live",
"in seconds. A change empties the cache." => "em segundos. Uma mudança esvaziará o cache.",
"Directory Settings" => "Configurações de Diretório",
"User Display Name Field" => "Campo Nome de Exibição de Usuário",
"The LDAP attribute to use to generate the user`s ownCloud name." => "O atributo LDAP para usar para gerar nome ownCloud do usuário.",
"Base User Tree" => "Árvore de Usuário Base",
"One User Base DN per line" => "Um usuário-base DN por linha",
"User Search Attributes" => "Atributos de Busca de Usuário",
"Optional; one attribute per line" => "Opcional; um atributo por linha",
"Group Display Name Field" => "Campo Nome de Exibição de Grupo",
"The LDAP attribute to use to generate the groups`s ownCloud name." => "O atributo LDAP para usar para gerar nome ownCloud do grupo.",
"Base Group Tree" => "Árvore de Grupo Base",
"One Group Base DN per line" => "Um grupo-base DN por linha",
"Group Search Attributes" => "Atributos de Busca de Grupo",
"Group-Member association" => "Associação Grupo-Membro",
"Special Attributes" => "Atributos Especiais",
"Quota Field" => "Campo de Cota",
"Quota Default" => "Cota Padrão",
"in bytes" => "em bytes",
"Email Field" => "Campo de Email",
"User Home Folder Naming Rule" => "Regra para Nome da Pasta Pessoal do Usuário",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "Deixe vazio para nome de usuário (padrão). Caso contrário, especifique um atributo LDAP/AD.",
"Internal Username" => "Nome de usuário interno",
"By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder in ownCloud. It is also a port of remote URLs, for instance for all *DAV services. With this setting, the default behaviour can be overriden. To achieve a similar behaviour as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behaviour. Changes will have effect only on newly mapped (added) LDAP users." => "Por padrão, o nome de usuário interno será criado a partir do atributo UUID. Ele garante que o nome de usuário é única e personagens não precisam ser convertidos. O nome de usuário interno tem a restrição de que apenas estes caracteres são permitidos: [a-zA-Z0-9_ @ -.]. Outros caracteres são substituídas por seu correspondente ASCII ou simplesmente serão omitidos. Em colisões um número será adicionado/aumentado. O nome de utilizador interna é usada para identificar um utilizador internamente. É também o nome padrão para a pasta home do usuário em ownCloud. É também um porto de URLs remoto, por exemplo, para todos os serviços de *DAV. Com esta definição, o comportamento padrão pode ser anulado. Para conseguir um comportamento semelhante como antes ownCloud 5 entrar na tela atributo nome de usuário no campo seguinte. Deixe-o vazio para o comportamento padrão. As alterações terão efeito apenas no recém mapeados (adicionado) de usuários LDAP. ",
"Internal Username Attribute:" => "Atributo Interno de Nome de Usuário:",
"Override UUID detection" => "Substituir detecção UUID",
"By default, ownCloud autodetects the UUID attribute. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behaviour. Changes will have effect only on newly mapped (added) LDAP users and groups." => "Por padrão, ownCloud detecta automaticamente o atributo UUID. O atributo UUID é usado para identificar, sem dúvida, os usuários e grupos LDAP. Além disso, o nome de usuário interno será criado com base no UUID, se não especificada acima. Você pode substituir a configuração e passar um atributo de sua escolha. Você deve certificar-se de que o atributo de sua escolha pode ser obtida tanto para usuários e grupos e é único. Deixe-o vazio para o comportamento padrão. As alterações terão efeito apenas no recém mapeados (adicionado) de usuários e grupos LDAP.",
"UUID Attribute:" => "Atributo UUID:",
"Username-LDAP User Mapping" => "Usuário-LDAP Mapeamento de Usuário",
"ownCloud uses usernames to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have a internal username. This requires a mapping from ownCloud username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found by ownCloud. The internal ownCloud name is used all over in ownCloud. Clearing the Mappings will have leftovers everywhere. Clearing the Mappings is not configuration sensitive, it affects all LDAP configurations! Do never clear the mappings in a production environment. Only clear mappings in a testing or experimental stage." => "ownCloud usa nomes de usuários para armazenar e atribuir (meta) dados. A fim de identificar com precisão e reconhecer usuários, cada usuário LDAP terá um nome de usuário interno. Isso requer um mapeamento de ownCloud do nome de usuário para usuário LDAP. O nome de usuário criado é mapeado para o UUID do usuário LDAP. Além disso, o DN está em cache, assim como para reduzir a interação LDAP, mas que não é utilizado para a identificação. Se a DN muda, as mudanças serão encontradas pelo ownCloud. O nome ownCloud interno é utilizado em todo ownCloud. Limpando os mapeamentos terá sobras em todos os lugares. Limpeza dos mapeamentos não são sensíveis a configuração, isso afeta todas as configurações LDAP! Nunca limpar os mapeamentos em um ambiente de produção. Somente limpe os mapeamentos em uma fase de testes ou experimental.",
"Clear Username-LDAP User Mapping" => "Limpar Mapeamento de Usuário Nome de Usuário-LDAP",
"Clear Groupname-LDAP Group Mapping" => "Limpar NomedoGrupo-LDAP Mapeamento do Grupo",
"Test Configuration" => "Teste de Configuração",
"Help" => "Ajuda"
);
