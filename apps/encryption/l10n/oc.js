OC.L10N.register(
    "encryption",
    {
    "Missing recovery key password" : "Senhal de la clau de recuperacion mancant",
    "Please repeat the recovery key password" : "Repetètz lo senhal de la clau de recuperacion",
    "Repeated recovery key password does not match the provided recovery key password" : "Lo senhal de la clau de recuperacion e sa repeticion son pas identics.",
    "Recovery key successfully enabled" : "Clau de recuperacion activada amb succès",
    "Could not enable recovery key. Please check your recovery key password!" : "Impossible d'activar la clau de recuperacion. Verificatz lo senhal de vòstra clau de recuperacion !",
    "Recovery key successfully disabled" : "Clau de recuperacion desactivada amb succès",
    "Could not disable recovery key. Please check your recovery key password!" : "Impossible de desactivar la clau de recuperacion. Verificatz lo senhal de vòstra clau de recuperacion !",
    "Missing parameters" : "Paramètres mancants",
    "Please provide the old recovery password" : "Entratz l'ancian senhal de recuperacion",
    "Please provide a new recovery password" : "Entratz un novèl senhal de recuperacion",
    "Please repeat the new recovery password" : "Repetissètz lo novèl senhal de recuperacion",
    "Password successfully changed." : "Senhal cambiat amb succès.",
    "Could not change the password. Maybe the old password was not correct." : "Error al moment del cambiament de senhal. Benlèu que l'ancian senhal es incorrècte.",
    "Recovery Key disabled" : "Clau de recuperacion desactivada",
    "Recovery Key enabled" : "Clau de recuperacion activada",
    "Could not enable the recovery key, please try again or contact your administrator" : "Impossible d'activar la clau de recuperacion. Ensajatz tornamai o contactatz vòstre administrator",
    "Could not update the private key password." : "Impossible de metre a jorn lo senhal de la clau privada.",
    "The old password was not correct, please try again." : "L'ancian senhal es incorrècte. Ensajatz tornamai.",
    "The current log-in password was not correct, please try again." : "Lo senhal de connexion actual es pas corrècte, ensajatz tornamai.",
    "Private key password successfully updated." : "Senhal de la clau privada mes a jorn amb succès.",
    "You need to migrate your encryption keys from the old encryption (ownCloud <= 8.0) to the new one. Please run 'occ encryption:migrate' or contact your administrator" : "Vos cal migrar vòstras claus de chiframent de l'anciana version (ownCloud <= 8.0) cap a la novèla. Executatz 'occ encryption:migrate' o contactatz vòstre administrator",
    "Invalid private key for Encryption App. Please update your private key password in your personal settings to recover access to your encrypted files." : "Vòstra clau privada pel chiframent es pas valida ! Metètz a jorn lo senhal de vòstra clau privada dins vòstres paramètres personals per recuperar l'accès a vòstres fichièrs chifrats.",
    "Encryption App is enabled but your keys are not initialized, please log-out and log-in again" : "L'aplicacion de chiframent es activada mas vòstras claus son pas inicializadas. Desconnectatz-vos e puèi reconnectatz-vos.",
    "Encryption App is enabled and ready" : "L'aplicacion de chiframent es activada e prèsta",
    "one-time password for server-side-encryption" : "Senhal d'usatge unic pel chiframent costat servidor",
    "Can not decrypt this file, probably this is a shared file. Please ask the file owner to reshare the file with you." : "Impossible de deschifrar aqueste fichièr : s'agís probablament d'un fichièr partejat. Demandatz al proprietari del fichièr de lo partejar tornamai amb vos.",
    "Can not read this file, probably this is a shared file. Please ask the file owner to reshare the file with you." : "Impossible de legir aqueste fichièr, s'agís probablament d'un fichièr partejat. Demandatz al proprietari del fichièr de lo repartejar amb vos.  ",
    "Hey there,\n\nthe admin enabled server-side-encryption. Your files were encrypted using the password '%s'.\n\nPlease login to the web interface, go to the section 'ownCloud basic encryption module' of your personal settings and update your encryption password by entering this password into the 'old log-in password' field and your current login-password.\n\n" : "Bonjorn,\n\nL'administrator a activat lo chiframent sul servidor. Vòstres fichièrs son estats chifrats amb lo senhal seguent :\n\n%s\n\nSeguissètz aquelas instruccions :\n\n1. Connectatz-vos a l'interfàcia web e trobatz la seccion \"Modul de chiframent de basa d'ownCloud\" dins vòstres paramètres personals ;\n\n2. Entratz lo senhal provesit çaisús dins lo camp \"Ancian senhal de connexion\";\n\n3. Entratz lo senhal qu'utilizatz actualament per vos connectar dins lo camp \"Senhal de connexion actual\" ;\n\n4. Validatz en clicant sul boton \"Metre a jorn lo senhal de vòstra clau privada\".\n",
    "The share will expire on %s." : "Lo partiment expirarà lo %s.",
    "Cheers!" : "A lèu !",
    "Hey there,<br><br>the admin enabled server-side-encryption. Your files were encrypted using the password <strong>%s</strong>.<br><br>Please login to the web interface, go to the section \"ownCloud basic encryption module\" of your personal settings and update your encryption password by entering this password into the \"old log-in password\" field and your current login-password.<br><br>" : "Bonjorn,\n<br><br>\nL'administrator a activat lo chiframent sul servidor. Vòstres fichièrs son estats chifrats amb lo senhal seguent :\n\n<p style=\"font-family: monospace;\"><b>%s</b></p>\n\n<p>\nSeguissètz aquelas instruccions :\n<ol>\n<li>Connectatz-vos a l'interfàcia web e trobatz la seccion <em>\"Modul de chiframent de basa d'ownCloud\"</em> dins vòstres paramètres personals;</li>\n<li>Entratz lo senhal provesit çaisús dins lo camp <em>\"Ancian senhal de connexion\"</em>;</li>\n<li>Entratz lo senhal qu'utilizatz actualament per vos connectar dins lo camp <em>\"Senhal de connexion actual\"</em>;</li>\n<li>Validatz en clicant sul boton <em>\"Metre a jorn lo senhal de vòstra clau privada\"</em>.</li>\n</ol>\n</p>",
    "Encrypt the home storage" : "Chifrar l'espaci d'emmagazinatge principal",
    "Enabling this option encrypts all files stored on the main storage, otherwise only files on external storage will be encrypted" : "L'activacion d'aquesta opcion chifra totes los fichièrs de l'emmagazinatge principal, siquenon sols los espacis d'emmagazinatge extèrnes seràn chifrats",
    "Enable recovery key" : "Activar la clau de recuperacion",
    "Disable recovery key" : "Desactivar la clau de recuperacion",
    "The recovery key is an extra encryption key that is used to encrypt files. It allows recovery of a user's files if the user forgets his or her password." : "La clau de recuperacion es una clau suplementària utilizada per chifrar los fichièrs. Permet de recuperar los fichièrs dels utilizaires se doblidan lor senhal.",
    "Recovery key password" : "Senhal de la clau de recuperacion",
    "Repeat recovery key password" : "Repetissètz lo senhal de la clau de recuperacion",
    "Change recovery key password:" : "Modificar lo senhal de la clau de recuperacion :",
    "Old recovery key password" : "Ancian senhal de la clau de recuperacion",
    "New recovery key password" : "Novèl senhal de la clau de recuperacion",
    "Repeat new recovery key password" : "Repetissètz lo novèl senhal de la clau de recuperacion",
    "Change Password" : "Cambiar de senhal",
    "ownCloud basic encryption module" : "Modul de chiframent de basa d'ownCloud",
    "Your private key password no longer matches your log-in password." : "Lo senhal de vòstra clau privada correspond pas mai a vòstre senhal de connexion.",
    "Set your old private key password to your current log-in password:" : "Fasètz de vòstre senhal de connexion lo senhal de vòstra clau privada :",
    " If you don't remember your old password you can ask your administrator to recover your files." : "Se vos remembratz pas mai de vòstre ancian senhal, podètz demandar a vòstre administrator de recuperar vòstres fichièrs.",
    "Old log-in password" : "Ancian senhal de connexion",
    "Current log-in password" : "Actual senhal de connexion",
    "Update Private Key Password" : "Metre a jorn lo senhal de vòstra clau privada",
    "Enable password recovery:" : "Activar la recuperacion del senhal :",
    "Enabling this option will allow you to reobtain access to your encrypted files in case of password loss" : "Activar aquesta opcion vos permetrà d'obténer tornamai l'accès a vòstres fichièrs chifrats en cas de pèrda de senhal",
    "Enabled" : "Activat",
    "Disabled" : "Desactivat"
},
"nplurals=2; plural=(n > 1);");
