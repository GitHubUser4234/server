<?php $TRANSLATIONS = array(
"<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behaviour. Please ask your system administrator to disable one of them." => "<b>Varning:</b> Apps user_ldap och user_webdavauth är inkompatibla. Oväntade problem kan uppstå. Be din systemadministratör att inaktivera en av dom.",
"<b>Warning:</b> The PHP LDAP module needs is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>Varning:</b> PHP LDAP-modulen måste vara installerad, serversidan kommer inte att fungera. Be din systemadministratör att installera den.",
"Host" => "Server",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "Du behöver inte ange protokoll förutom om du använder SSL. Starta då med ldaps://",
"Base DN" => "Start DN",
"You can specify Base DN for users and groups in the Advanced tab" => "Du kan ange start DN för användare och grupper under fliken Avancerat",
"User DN" => "Användare DN",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "DN för användaren som skall användas, t.ex. uid=agent, dc=example, dc=com. För anonym åtkomst, lämna DN och lösenord tomt.",
"Password" => "Lösenord",
"For anonymous access, leave DN and Password empty." => "För anonym åtkomst, lämna DN och lösenord tomt.",
"User Login Filter" => "Filter logga in användare",
"Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action." => "Definierar filter att tillämpa vid inloggningsförsök. %% uid ersätter användarnamn i loginåtgärden.",
"use %%uid placeholder, e.g. \"uid=%%uid\"" => "använd platshållare %%uid, t ex \"uid=%%uid\"",
"User List Filter" => "Filter lista användare",
"Defines the filter to apply, when retrieving users." => "Definierar filter att tillämpa vid listning av användare.",
"without any placeholder, e.g. \"objectClass=person\"." => "utan platshållare, t.ex. \"objectClass=person\".",
"Group Filter" => "Gruppfilter",
"Defines the filter to apply, when retrieving groups." => "Definierar filter att tillämpa vid listning av grupper.",
"without any placeholder, e.g. \"objectClass=posixGroup\"." => "utan platshållare, t.ex. \"objectClass=posixGroup\".",
"Port" => "Port",
"Base User Tree" => "Bas för användare i katalogtjänst",
"Base Group Tree" => "Bas för grupper i katalogtjänst",
"Group-Member association" => "Attribut för gruppmedlemmar",
"Use TLS" => "Använd TLS",
"Do not use it for SSL connections, it will fail." => "Använd inte för SSL-anslutningar, det kommer inte att fungera.",
"Case insensitve LDAP server (Windows)" => "LDAP-servern är okänslig för gemener och versaler (Windows)",
"Turn off SSL certificate validation." => "Stäng av verifiering av SSL-certifikat.",
"If connection only works with this option, import the LDAP server's SSL certificate in your ownCloud server." => "Om anslutningen bara fungerar med det här alternativet, importera LDAP-serverns SSL-certifikat i din ownCloud-server.",
"Not recommended, use for testing only." => "Rekommenderas inte, använd bara för test. ",
"User Display Name Field" => "Attribut för användarnamn",
"The LDAP attribute to use to generate the user`s ownCloud name." => "Attribut som används för att generera användarnamn i ownCloud.",
"Group Display Name Field" => "Attribut för gruppnamn",
"The LDAP attribute to use to generate the groups`s ownCloud name." => "Attribut som används för att generera gruppnamn i ownCloud.",
"in bytes" => "i bytes",
"in seconds. A change empties the cache." => "i sekunder. En förändring tömmer cache.",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "Lämnas tomt för användarnamn (standard). Ange annars ett LDAP/AD-attribut.",
"Help" => "Hjälp"
);
