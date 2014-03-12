<?php
$TRANSLATIONS = array(
"Failed to clear the mappings." => "Erreur lors de la suppression des associations.",
"Failed to delete the server configuration" => "Échec de la suppression de la configuration du serveur",
"The configuration is valid and the connection could be established!" => "La configuration est valide et la connexion peut être établie !",
"The configuration is valid, but the Bind failed. Please check the server settings and credentials." => "La configuration est valide, mais le lien ne peut être établi. Veuillez vérifier les paramètres du serveur ainsi que vos identifiants de connexion.",
"The configuration is invalid. Please have a look at the logs for further details." => "La configuration est invalide. Veuillez consulter les logs pour plus de détails.",
"No action specified" => "Aucune action spécifiée",
"No configuration specified" => "Aucune configuration spécifiée",
"No data specified" => "Aucune donnée spécifiée",
" Could not set configuration %s" => "Impossible de spécifier la configuration %s",
"Deletion failed" => "La suppression a échoué",
"Take over settings from recent server configuration?" => "Récupérer les paramètres depuis une configuration récente du serveur ?",
"Keep settings?" => "Garder ces paramètres ?",
"Cannot add server configuration" => "Impossible d'ajouter la configuration du serveur",
"mappings cleared" => "associations supprimées",
"Success" => "Succès",
"Error" => "Erreur",
"Configuration OK" => "Configuration OK",
"Configuration incorrect" => "Configuration incorrecte",
"Configuration incomplete" => "Configuration incomplète",
"Select groups" => "Sélectionnez les groupes",
"Select object classes" => "Sélectionner les classes d'objet",
"Select attributes" => "Sélectionner les attributs",
"Connection test succeeded" => "Test de connexion réussi",
"Connection test failed" => "Test de connexion échoué",
"Do you really want to delete the current Server Configuration?" => "Êtes-vous vraiment sûr de vouloir effacer la configuration actuelle du serveur ?",
"Confirm Deletion" => "Confirmer la suppression",
"_%s group found_::_%s groups found_" => array("%s groupe trouvé","%s groupes trouvés"),
"_%s user found_::_%s users found_" => array("%s utilisateur trouvé","%s utilisateurs trouvés"),
"Invalid Host" => "Hôte invalide",
"Could not find the desired feature" => "Impossible de trouver la fonction souhaitée",
"Save" => "Sauvegarder",
"Test Configuration" => "Tester la configuration",
"Help" => "Aide",
"only those object classes:" => "seulement ces classes d'objet :",
"only from those groups:" => "seulement de ces groupes :",
"Edit raw filter instead" => "Éditer le filtre raw à la place",
"Raw LDAP filter" => "Filtre Raw LDAP",
"The filter specifies which LDAP groups shall have access to the %s instance." => "Le filtre spécifie quels groupes LDAP doivent avoir accès à l'instance %s.",
"groups found" => "groupes trouvés",
"LDAP Username:" => "Nom d'utilisateur LDAP :",
"LDAP Email Address:" => "Adresse email LDAP :",
"Other Attributes:" => "Autres attributs :",
"Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action. Example: \"uid=%%uid\"" => "Définit le filtre à appliquer lors d'une tentative de connexion. %%uid remplace le nom d'utilisateur lors de la connexion. Exemple : \"uid=%%uid\"",
"Add Server Configuration" => "Ajouter une configuration du serveur",
"Host" => "Hôte",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "Vous pouvez omettre le protocole, sauf si vous avez besoin de SSL. Dans ce cas préfixez avec ldaps://",
"Port" => "Port",
"User DN" => "DN Utilisateur (Autorisé à consulter l'annuaire)",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "DN de l'utilisateur client pour lequel la liaison doit se faire, par exemple uid=agent,dc=example,dc=com. Pour un accès anonyme, laisser le DN et le mot de passe vides.",
"Password" => "Mot de passe",
"For anonymous access, leave DN and Password empty." => "Pour un accès anonyme, laisser le DN utilisateur et le mot de passe vides.",
"One Base DN per line" => "Un DN racine par ligne",
"You can specify Base DN for users and groups in the Advanced tab" => "Vous pouvez spécifier les DN Racines de vos utilisateurs et groupes via l'onglet Avancé",
"The filter specifies which LDAP users shall have access to the %s instance." => "Le filtre spécifie quels utilisateurs LDAP doivent avoir accès à l'instance %s.",
"users found" => "utilisateurs trouvés",
"Back" => "Retour",
"Continue" => "Poursuivre",
"<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." => "<b>Avertissement :</b> Les applications user_ldap et user_webdavauth sont incompatibles. Des dysfonctionnements peuvent survenir. Contactez votre administrateur système pour qu'il désactive l'une d'elles.",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>Attention :</b> Le module php LDAP n'est pas installé, par conséquent cette extension ne pourra fonctionner. Veuillez contacter votre administrateur système afin qu'il l'installe.",
"Connection Settings" => "Paramètres de connexion",
"Configuration Active" => "Configuration active",
"When unchecked, this configuration will be skipped." => "Lorsque non cochée, la configuration sera ignorée.",
"Backup (Replica) Host" => "Serveur de backup (réplique)",
"Give an optional backup host. It must be a replica of the main LDAP/AD server." => "Fournir un serveur de backup optionnel.  Il doit s'agir d'une réplique du serveur LDAP/AD principal.",
"Backup (Replica) Port" => "Port du serveur de backup (réplique)",
"Disable Main Server" => "Désactiver le serveur principal",
"Only connect to the replica server." => "Se connecter uniquement au serveur de replica.",
"Case insensitve LDAP server (Windows)" => "Serveur LDAP insensible à la casse (Windows)",
"Turn off SSL certificate validation." => "Désactiver la validation du certificat SSL.",
"Not recommended, use it for testing only! If connection only works with this option, import the LDAP server's SSL certificate in your %s server." => "Non recommandé, à utiliser à des fins de tests uniquement. Si la connexion ne fonctionne qu'avec cette option, importez le certificat SSL du serveur LDAP dans le serveur %s.",
"Cache Time-To-Live" => "Durée de vie du cache",
"in seconds. A change empties the cache." => "en secondes. Tout changement vide le cache.",
"Directory Settings" => "Paramètres du répertoire",
"User Display Name Field" => "Champ \"nom d'affichage\" de l'utilisateur",
"The LDAP attribute to use to generate the user's display name." => "L'attribut LDAP utilisé pour générer le nom d'utilisateur affiché.",
"Base User Tree" => "DN racine de l'arbre utilisateurs",
"One User Base DN per line" => "Un DN racine utilisateur par ligne",
"User Search Attributes" => "Recherche des attributs utilisateur",
"Optional; one attribute per line" => "Optionnel, un attribut par ligne",
"Group Display Name Field" => "Champ \"nom d'affichage\" du groupe",
"The LDAP attribute to use to generate the groups's display name." => "L'attribut LDAP utilisé pour générer le nom de groupe affiché.",
"Base Group Tree" => "DN racine de l'arbre groupes",
"One Group Base DN per line" => "Un DN racine groupe par ligne",
"Group Search Attributes" => "Recherche des attributs du groupe",
"Group-Member association" => "Association groupe-membre",
"Special Attributes" => "Attributs spéciaux",
"Quota Field" => "Champ du quota",
"Quota Default" => "Quota par défaut",
"in bytes" => "en bytes",
"Email Field" => "Champ Email",
"User Home Folder Naming Rule" => "Convention de nommage du répertoire utilisateur",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "Laisser vide ",
"Internal Username" => "Nom d'utilisateur interne",
"By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder. It is also a part of remote URLs, for instance for all *DAV services. With this setting, the default behavior can be overridden. To achieve a similar behavior as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users." => "Par défaut le nom d'utilisateur interne sera créé à partir de l'attribut UUID. Ceci permet d'assurer que le nom d'utilisateur est unique et que les caractères ne nécessitent pas de conversion. Le nom d'utilisateur interne doit contenir uniquement les caractères suivants : [ a-zA-Z0-9_.@- ]. Les autres caractères sont remplacés par leur correspondance ASCII ou simplement omis. En cas de collision, un nombre est incrémenté/décrémenté. Le nom d'utilisateur interne est utilisé pour identifier l'utilisateur au sein du système. C'est aussi le nom par défaut du répertoire utilisateur dans ownCloud. C'est aussi le port d'URLs distants, par exemple pour tous les services *DAV. Le comportement par défaut peut être modifié à l'aide de ce paramètre. Pour obtenir un comportement similaire aux versions précédentes à ownCloud 5, saisir le nom d'utilisateur à afficher dans le champ suivant. Laissez à blanc pour le comportement par défaut. Les modifications prendront effet seulement pour les nouveaux (ajoutés) utilisateurs LDAP.",
"Internal Username Attribute:" => "Nom d'utilisateur interne:",
"Override UUID detection" => "Surcharger la détection d'UUID",
"By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." => "Par défaut, l'attribut UUID est automatiquement  détecté. Cet attribut est utilisé pour identifier les utilisateurs et groupes de façon fiable. Un nom d'utilisateur interne basé sur l'UUID sera automatiquement créé, sauf s'il est spécifié autrement ci-dessus. Vous pouvez modifier ce comportement et définir l'attribut de votre choix. Vous devez alors vous assurer que l'attribut de votre choix peut être récupéré pour les utilisateurs ainsi que pour les groupes et qu'il soit unique. Laisser à blanc pour le comportement par défaut. Les modifications seront effectives uniquement pour les nouveaux (ajoutés) utilisateurs et groupes LDAP.",
"UUID Attribute for Users:" => "Attribut UUID pour les utilisateurs :",
"UUID Attribute for Groups:" => "Attribut UUID pour les groupes :",
"Username-LDAP User Mapping" => "Association Nom d'utilisateur-Utilisateur LDAP",
"Usernames are used to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have a internal username. This requires a mapping from username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found. The internal username is used all over. Clearing the mappings will have leftovers everywhere. Clearing the mappings is not configuration sensitive, it affects all LDAP configurations! Never clear the mappings in a production environment, only in a testing or experimental stage." => "Les noms d'utilisateurs sont utilisés pour le stockage et l'assignation de (meta) données. Pour identifier et reconnaitre précisément les utilisateurs, chaque utilisateur LDAP aura un nom interne spécifique. Cela requiert l'association d'un nom d'utilisateur ownCloud à un nom d'utilisateur LDAP. Le nom d'utilisateur créé est associé à l'attribut UUID de l'utilisateur LDAP. Par ailleurs, le DN est mémorisé en cache pour limiter les interactions LDAP mais il n'est pas utilisé pour l'identification. Si le DN est modifié, ces modifications seront retrouvées. Seul le nom interne à ownCloud est utilisé au sein du produit. Supprimer les associations créera des orphelins et l'action affectera toutes les configurations LDAP. NE JAMAIS SUPPRIMER LES ASSOCIATIONS EN ENVIRONNEMENT DE PRODUCTION, mais uniquement sur des environnements de tests et d'expérimentation.",
"Clear Username-LDAP User Mapping" => "Supprimer l'association utilisateur interne-utilisateur LDAP",
"Clear Groupname-LDAP Group Mapping" => "Supprimer l'association nom de groupe-groupe LDAP"
);
$PLURAL_FORMS = "nplurals=2; plural=(n > 1);";
