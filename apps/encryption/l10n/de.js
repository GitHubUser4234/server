OC.L10N.register(
    "encryption",
    {
    "Missing recovery key password" : "Schlüsselpasswort zur Wiederherstellung fehlt",
    "Please repeat the recovery key password" : "Schlüsselpasswort zur Wiederherstellung bitte wiederholen",
    "Repeated recovery key password does not match the provided recovery key password" : "Das wiederholte Schlüsselpasswort zur Wiederherstellung stimmt nicht mit dem geforderten Schlüsselpasswort zur Wiederherstellung überein",
    "Recovery key successfully enabled" : "Wiederherstellungsschlüssel wurde erfolgreich aktiviert",
    "Could not enable recovery key. Please check your recovery key password!" : "Der Wiederherstellungsschlüssel konnte nicht aktiviert werden. Überprüfe Dein Wiederherstellungspasswort!",
    "Recovery key successfully disabled" : "Wiederherstellungsschlüssel deaktiviert.",
    "Could not disable recovery key. Please check your recovery key password!" : "Der Wiederherstellungsschlüssel konnte nicht deaktiviert werden. Überprüfe Dein Wiederherstellungspasswort!",
    "Missing parameters" : "Fehlende Parameter",
    "Please provide the old recovery password" : "Bitte das alte Passwort zur Wiederherstellung eingeben",
    "Please provide a new recovery password" : "Bitte das alte Passwort zur Wiederherstellung eingeben",
    "Please repeat the new recovery password" : "Bitte das neue Passwort zur Wiederherstellung wiederholen",
    "Password successfully changed." : "Dein Passwort wurde geändert.",
    "Could not change the password. Maybe the old password was not correct." : "Das Passwort konnte nicht geändert werden. Vielleicht war das alte Passwort falsch.",
    "Recovery Key disabled" : "Wiederherstellungsschlüssel deaktiviert",
    "Recovery Key enabled" : "Wiederherstellungsschlüssel aktiviert",
    "Could not enable the recovery key, please try again or contact your administrator" : "Der Wiederherstellungsschlüssel konnte nicht aktiviert werden, bitte versuche es noch einmal oder kontaktiere Deinen Administrator",
    "Could not update the private key password." : "Das Passwort des privaten Schlüssels konnte nicht aktualisiert werden.",
    "The old password was not correct, please try again." : "Das alte Passwort war nicht korrekt, bitte versuche es noch einmal.",
    "The current log-in password was not correct, please try again." : "Das aktuelle Anmeldepasswort war nicht korrekt, bitte versuche es noch einmal.",
    "Private key password successfully updated." : "Passwort des privaten Schlüssels erfolgreich aktualisiert",
    "You need to migrate your encryption keys from the old encryption (ownCloud <= 8.0) to the new one. Please run 'occ encryption:migrate' or contact your administrator" : "Du musst Deine Verschlüsselungsschlüssel von der alten Verschlüsselung (ownCloud <= 8.0) zur neuen migrieren. Bitte führe 'occ encryption:migrate' aus oder kontaktiere Deinen Administrator.",
    "Invalid private key for Encryption App. Please update your private key password in your personal settings to recover access to your encrypted files." : "Ungültiger privater Schlüssel für die Verschlüsselung-App. Bitte aktualisiere Dein privates Schlüssel-Passwort, um den Zugriff auf Deine verschlüsselten Dateien wiederherzustellen.",
    "Encryption App is enabled but your keys are not initialized, please log-out and log-in again" : "Die Verschlüsselung-App ist aktiviert, aber Deine Schlüssel sind nicht initialisiert. Bitte melde Dich nochmals ab und wieder an.",
    "Encryption App is enabled and ready" : "Verschlüsselungs-App ist aktiviert und bereit",
    "Bad Signature" : "ungültige Signatur",
    "Missing Signature" : "fehlende Signatur",
    "one-time password for server-side-encryption" : "Einmal-Passwort für serverseitige Verschlüsselung",
    "Can not decrypt this file, probably this is a shared file. Please ask the file owner to reshare the file with you." : "Diese Datei kann nicht entschlüsselt werden, es handelt sich wahrscheinlich um eine geteilte Datei. Bitte kontaktiere den Eigentümer der Datei und bitte darum, die Datei noch einmal mit Dir zu teilen.",
    "Can not read this file, probably this is a shared file. Please ask the file owner to reshare the file with you." : "Diese Datei kann nicht gelesen werden, es handelt sich wahrscheinlich um eine geteilte Datei. Bitte kontaktiere den Eigentümer der Datei und bitte darum, die Datei noch einmal mit Dir zu teilen.",
    "Hey there,\n\nthe admin enabled server-side-encryption. Your files were encrypted using the password '%s'.\n\nPlease login to the web interface, go to the section 'ownCloud basic encryption module' of your personal settings and update your encryption password by entering this password into the 'old log-in password' field and your current login-password.\n\n" : "Hey,\n\nder Administrator hat die servereitige Verschlüsselung aktiviert. Die Dateien wurden mit dem Kennwort '%s' verschlüsselt.\n\nBitte melde dich im Web-Interface an, gehe in deine persönlichen Einstellungen. Dort findest du die Option 'ownCloud-Basisverschlüsselungsmodul' und aktualisiere dort dein Verschlüsselungspasswort indem du das Passwort in das 'alte Log - in Passwort' und in das 'aktuellen Login - Passwort' Feld eingibst.\n\n",
    "The share will expire on %s." : "Die Freigabe wird am %s ablaufen.",
    "Cheers!" : "Noch einen schönen Tag!",
    "Hey there,<br><br>the admin enabled server-side-encryption. Your files were encrypted using the password <strong>%s</strong>.<br><br>Please login to the web interface, go to the section \"ownCloud basic encryption module\" of your personal settings and update your encryption password by entering this password into the \"old log-in password\" field and your current login-password.<br><br>" : "Hey,<br><br>der Administrator hat die servereitige Verschlüsselung aktiviert. Die Dateien wurden mit dem Kennwort <strong>%s</strong> verschlüsselt.<br><br>Bitte melde dich im Web-Interface an, gehe in deine persönlichen Einstellungen. Dort findest du die Option 'ownCloud-Basisverschlüsselungsmodul' und aktualisiere dort dein Verschlüsselungspasswort indem du das Passwort in das 'alte Log - in Passwort' und in das 'aktuellen Login - Passwort' Feld eingibst.<br><br>",
    "Encrypt the home storage" : "Verschlüssle den Speicher",
    "Enabling this option encrypts all files stored on the main storage, otherwise only files on external storage will be encrypted" : "Die Aktivierung dieser Option verschlüsselt alle Dateien die auf dem Hauptspeicher gespeichert sind, ansonsten werden nur Dateien auf dem externen Speicher verschlüsselt",
    "Enable recovery key" : "Wiederherstellungsschlüssel aktivieren",
    "Disable recovery key" : "Wiederherstellungsschlüssel deaktivieren",
    "The recovery key is an extra encryption key that is used to encrypt files. It allows recovery of a user's files if the user forgets his or her password." : "Der Wiederherstellungsschlüssel ist ein zusätzlicher Verschlüsselungsschlüssel, der zum Verschlüsseln von Dateien benutzt wird. Er erlaubt die Wiederherstellung von Benutzerdateien auch dann, wenn der Benutzer sein oder ihr Passwort vergessen hat.",
    "Recovery key password" : "Wiederherstellungsschlüssel-Passwort",
    "Repeat recovery key password" : "Passwort für den Wiederherstellungsschlüssel wiederholen",
    "Change recovery key password:" : "Wiederherstellungsschlüssel-Passwort ändern:",
    "Old recovery key password" : "Altes Passwort für den Wiederherstellungsschlüssel",
    "New recovery key password" : "Neues Passwort für den Wiederherstellungsschlüssel",
    "Repeat new recovery key password" : "Neues Passwort für den Wiederherstellungsschlüssel wiederholen",
    "Change Password" : "Passwort ändern",
    "ownCloud basic encryption module" : "ownCloud-Basisverschlüsselungsmodul",
    "Your private key password no longer matches your log-in password." : "Dein Passwort für Deinen privaten Schlüssel stimmt nicht mehr mit Deinem Loginpasswort überein.",
    "Set your old private key password to your current log-in password:" : "Dein altes Passwort für Deinen privaten Schlüssel auf Dein aktuelles Anmeldepasswort einstellen:",
    " If you don't remember your old password you can ask your administrator to recover your files." : "Wenn Du Dein altes Passwort vergessen hast, könntest Du Deinen Administrator bitten, Deine Daten wiederherzustellen.",
    "Old log-in password" : "Altes Login Passwort",
    "Current log-in password" : "Aktuelles Passwort",
    "Update Private Key Password" : "Passwort für den privaten Schlüssel aktualisieren",
    "Enable password recovery:" : "Passwortwiederherstellung aktivieren:",
    "Enabling this option will allow you to reobtain access to your encrypted files in case of password loss" : "Wenn Du diese Option aktivierst, kannst Du Deine verschlüsselten Dateien wiederherstellen, falls Du Dein Passwort vergisst",
    "Enabled" : "Aktiviert",
    "Disabled" : "Deaktiviert"
},
"nplurals=2; plural=(n != 1);");
