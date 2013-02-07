<?php $TRANSLATIONS = array(
"Failed to delete the server configuration" => "Échec de la suppression de la configuration du serveur",
"The configuration is valid and the connection could be established!" => "La configuration est valide est la connexion peut être établie !",
"The configuration is valid, but the Bind failed. Please check the server settings and credentials." => "La configuration est valide, mais le lien ne peut être établi. Veuillez vérifier les paramètres du serveur ainsi que vos identifiants de connexion.",
"The configuration is invalid. Please look in the ownCloud log for further details." => "La configuration est invalide. Veuillez vous référer aux fichiers de journaux ownCloud pour plus d'information.",
"Deletion failed" => "La suppression a échoué",
"Take over settings from recent server configuration?" => "Récupérer les paramètres depuis une configuration récente du serveur ?",
"Keep settings?" => "Garder ces paramètres ?",
"Cannot add server configuration" => "Impossible d'ajouter la configuration du serveur.",
"Connection test succeeded" => "Test de connexion réussi",
"Connection test failed" => "Le test de connexion a échoué",
"Do you really want to delete the current Server Configuration?" => "Êtes-vous vraiment sûr de vouloir effacer la configuration actuelle du serveur ?",
"Confirm Deletion" => "Confirmer la suppression",
"<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behaviour. Please ask your system administrator to disable one of them." => "<b>Avertissement:</b> Les applications user_ldap et user_webdavauth sont incompatibles. Des disfonctionnements peuvent survenir. Contactez votre administrateur système pour qu'il désactive l'une d'elles.",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>Attention :</b> Le module php LDAP n'est pas installé, par conséquent cette extension ne pourra fonctionner. Veuillez contacter votre administrateur système afin qu'il l'installe.",
"Server configuration" => "Configuration du serveur",
"Add Server Configuration" => "Ajouter une configuration du serveur",
"Host" => "Hôte",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "Vous pouvez omettre le protocole, sauf si vous avez besoin de SSL. Dans ce cas préfixez avec ldaps://",
"Base DN" => "DN Racine",
"One Base DN per line" => "Un DN racine par ligne",
"You can specify Base DN for users and groups in the Advanced tab" => "Vous pouvez spécifier les DN Racines de vos utilisateurs et groupes via l'onglet Avancé",
"User DN" => "DN Utilisateur (Autorisé à consulter l'annuaire)",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "DN de l'utilisateur client pour lequel la liaison doit se faire, par exemple uid=agent,dc=example,dc=com. Pour un accès anonyme, laisser le DN et le mot de passe vides.",
"Password" => "Mot de passe",
"For anonymous access, leave DN and Password empty." => "Pour un accès anonyme, laisser le DN Utilisateur et le mot de passe vides.",
"User Login Filter" => "Modèle d'authentification utilisateurs",
"Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action." => "Définit le motif à appliquer, lors d'une tentative de connexion. %%uid est remplacé par le nom d'utilisateur lors de la connexion.",
"use %%uid placeholder, e.g. \"uid=%%uid\"" => "veuillez utiliser le champ %%uid , ex.: \"uid=%%uid\"",
"User List Filter" => "Filtre d'utilisateurs",
"Defines the filter to apply, when retrieving users." => "Définit le filtre à appliquer lors de la récupération des utilisateurs.",
"without any placeholder, e.g. \"objectClass=person\"." => "sans élément de substitution, par exemple \"objectClass=person\".",
"Group Filter" => "Filtre de groupes",
"Defines the filter to apply, when retrieving groups." => "Définit le filtre à appliquer lors de la récupération des groupes.",
"without any placeholder, e.g. \"objectClass=posixGroup\"." => "sans élément de substitution, par exemple \"objectClass=posixGroup\".",
"Connection Settings" => "Paramètres de connexion",
"Configuration Active" => "Configuration active",
"When unchecked, this configuration will be skipped." => "Lorsque non cochée, la configuration sera ignorée.",
"Port" => "Port",
"Backup (Replica) Host" => "Serveur de backup (réplique)",
"Give an optional backup host. It must be a replica of the main LDAP/AD server." => "Fournir un serveur de backup optionnel.  Il doit s'agir d'une réplique du serveur LDAP/AD principal.",
"Backup (Replica) Port" => "Port du serveur de backup (réplique)",
"Disable Main Server" => "Désactiver le serveur principal",
"When switched on, ownCloud will only connect to the replica server." => "Lorsqu'activé, ownCloud ne se connectera qu'au serveur répliqué.",
"Use TLS" => "Utiliser TLS",
"Case insensitve LDAP server (Windows)" => "Serveur LDAP insensible à la casse (Windows)",
"Turn off SSL certificate validation." => "Désactiver la validation du certificat SSL.",
"If connection only works with this option, import the LDAP server's SSL certificate in your ownCloud server." => "Si la connexion ne fonctionne qu'avec cette option, importez le certificat SSL du serveur LDAP dans le serveur ownCloud.",
"Not recommended, use for testing only." => "Non recommandé, utilisation pour tests uniquement.",
"in seconds. A change empties the cache." => "en secondes. Tout changement vide le cache.",
"Directory Settings" => "Paramètres du répertoire",
"User Display Name Field" => "Champ \"nom d'affichage\" de l'utilisateur",
"The LDAP attribute to use to generate the user`s ownCloud name." => "L'attribut LDAP utilisé pour générer les noms d'utilisateurs d'ownCloud.",
"Base User Tree" => "DN racine de l'arbre utilisateurs",
"One User Base DN per line" => "Un DN racine utilisateur par ligne",
"User Search Attributes" => "Recherche des attributs utilisateur",
"Optional; one attribute per line" => "Optionnel, un attribut par ligne",
"Group Display Name Field" => "Champ \"nom d'affichage\" du groupe",
"The LDAP attribute to use to generate the groups`s ownCloud name." => "L'attribut LDAP utilisé pour générer les noms de groupes d'ownCloud.",
"Base Group Tree" => "DN racine de l'arbre groupes",
"One Group Base DN per line" => "Un DN racine groupe par ligne",
"Group Search Attributes" => "Recherche des attributs du groupe",
"Group-Member association" => "Association groupe-membre",
"Special Attributes" => "Attributs spéciaux",
"in bytes" => "en octets",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "Laisser vide ",
"Help" => "Aide"
);
