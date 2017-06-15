OC.L10N.register(
    "encryption",
    {
    "Missing recovery key password" : "Palautusavaimen salasana puuttuu",
    "Please repeat the recovery key password" : "Toista palautusavaimen salasana",
    "Repeated recovery key password does not match the provided recovery key password" : "Toistamiseen annettu palautusavaimen salasana ei täsmää annettua palautusavaimen salasanaa",
    "Recovery key successfully enabled" : "Palautusavain kytketty päälle onnistuneesti",
    "Could not enable recovery key. Please check your recovery key password!" : "Palautusavaimen käyttöönotto epäonnistui. Tarkista palautusavaimesi salasana!",
    "Recovery key successfully disabled" : "Palautusavain poistettu onnistuneesti käytöstä",
    "Could not disable recovery key. Please check your recovery key password!" : "Palautusavaimen poistaminen käytöstä ei onnistunut. Tarkista palautusavaimesi salasana!",
    "Missing parameters" : "Puuttuvat parametrit",
    "Please provide the old recovery password" : "Anna vanha palautussalasana",
    "Please provide a new recovery password" : "Anna uusi palautussalasana",
    "Please repeat the new recovery password" : "Toista uusi palautussalasana",
    "Password successfully changed." : "Salasana vaihdettiin onnistuneesti.",
    "Could not change the password. Maybe the old password was not correct." : "Salasanan vaihto epäonnistui. Kenties vanha salasana oli väärin.",
    "Recovery Key disabled" : "Palautusavain poistettu käytöstä",
    "Recovery Key enabled" : "Palautusavain käytössä",
    "Could not enable the recovery key, please try again or contact your administrator" : "Palautusavaimen käyttöönotto epäonnistui, yritä myöhemmin uudelleen tai ota yhteys ylläpitäjään",
    "Could not update the private key password." : "Yksityisen avaimen salasanaa ei voitu päivittää.",
    "The old password was not correct, please try again." : "Vanha salasana oli väärin, yritä uudelleen.",
    "The current log-in password was not correct, please try again." : "Nykyinen kirjautumiseen käytettävä salasana oli väärin, yritä uudelleen.",
    "Private key password successfully updated." : "Yksityisen avaimen salasana päivitettiin onnistuneesti.",
    "You need to migrate your encryption keys from the old encryption (ownCloud <= 8.0) to the new one. Please run 'occ encryption:migrate' or contact your administrator" : "Salausavaimet tulee siirtää vanhasta salaustavasta (ownCloud <= 8.0) uuteen salaustapaan. Suorita 'occ encryption:migrate' tai ota yhteys ylläpitoon",
    "Invalid private key for encryption app. Please update your private key password in your personal settings to recover access to your encrypted files." : "Salaussovelluksen salausavain on virheellinen. Ole hyvä ja päivitä salausavain henkilökohtaisissa asetuksissasi jotta voit taas avata salauskirjoitetut tiedostosi.",
    "Encryption App is enabled, but your keys are not initialized. Please log-out and log-in again." : "Salaussovellus on käytössä, mutta salausavaimia ei ole alustettu. Ole hyvä ja kirjaudu sisään uudelleen.",
    "Encryption app is enabled and ready" : "Salaussovellus on aktivoitu ja valmis",
    "Bad Signature" : "Virheellinen allekirjoitus",
    "Missing Signature" : "Puuttuva allekirjoitus",
    "one-time password for server-side-encryption" : "kertakäyttöinen salasana palvelinpään salausta varten",
    "Can not decrypt this file, probably this is a shared file. Please ask the file owner to reshare the file with you." : "Tämän tiedoston salauksen purkaminen ei onnistu. Kyseessä on luultavasti jaettu tiedosto. Pyydä tiedoston omistajaa jakamaan tiedosto kanssasi uudelleen.",
    "Can not read this file, probably this is a shared file. Please ask the file owner to reshare the file with you." : "Tiedostoa ei voi lukea, se on luultavasti jaettu tiedosto. Pyydä tiedoston omistajaa jakamaan tiedosto uudelleen kanssasi.",
    "Default encryption module" : "Oletus salausmoduuli",
    "Hey there,\n\nthe admin enabled server-side-encryption. Your files were encrypted using the password '%s'.\n\nPlease login to the web interface, go to the section 'basic encryption module' of your personal settings and update your encryption password by entering this password into the 'old log-in password' field and your current login-password.\n\n" : "Hei,\n\nYlläpiäjä on ottanut käyttöön palvelimen salauksen. Tiedostosi salattiin salasanalla '%s'.\n\nOle hyvä ja kirjaudu palveluun verkkokäyttöliittymän kautta, siirry henkilökohtaisten asetustesi kohtaan \"perussalausmoduuli\" ja päivitä salaukseen käytettävä salasanasi syöttämällä yllä mainittu salasana \"vanha kirjautumissalasana\"-kenttään ja nykyinen kirjautumissalasanasi.\n\n",
    "The share will expire on %s." : "Jakaminen päättyy %s.",
    "Cheers!" : "Kiitos!",
    "Hey there,<br><br>the admin enabled server-side-encryption. Your files were encrypted using the password <strong>%s</strong>.<br><br>Please login to the web interface, go to the section \"basic encryption module\" of your personal settings and update your encryption password by entering this password into the \"old log-in password\" field and your current login-password.<br><br>" : "Hei,<br><br>Ylläpiäjä on ottanut käyttöön palvelimen salauksen. Tiedostosi salattiin salasanalla <strong>%s</srong>.<br><br>Ole hyvä ja kirjaudu palveluun verkkokäyttöliittymän kautta, siirry henkilökohtaisten asetustesi kohtaan \"perussalausmoduuli\" ja päivitä salaukseen käytettävä salasanasi syöttämällä yllä mainittu salasana \"vanha kirjautumissalasana\"-kenttään ja nykyinen kirjautumissalasanasi.<br><br>",
    "Encryption app is enabled but your keys are not initialized, please log-out and log-in again" : "Salaussovellus on aktivoitu, mutta avaimia ei ole alustettu, kirjaudu uudelleen sisään",
    "Encrypt the home storage" : "Salaa oma kotitila",
    "Enabling this option encrypts all files stored on the main storage, otherwise only files on external storage will be encrypted" : "Tämän valinnan ollessa valittuna salataan kaikki päätallennustilaan tallennetut tiedostot. Muussa tapauksessa ainoastaan ulkoisessa tallennustilassa sijaitsevat tiedostot salataan.",
    "Enable recovery key" : "Ota palautusavain käyttöön",
    "Disable recovery key" : "Poista palautusavain käytöstä",
    "The recovery key is an extra encryption key that is used to encrypt files. It allows recovery of a user's files if the user forgets his or her password." : "Palautusavain on ylimääräinen salausavain, jota käytetään tiedostojen salaamiseen. Sen avulla on mahdollista palauttaa käyttäjien tiedostot, vaikka käyttäjä unohtaisi oman salasanansa.",
    "Recovery key password" : "Palautusavaimen salasana",
    "Repeat recovery key password" : "Toista salausavaimen salasana",
    "Change recovery key password:" : "Vaihda palautusavaimen salasana:",
    "Old recovery key password" : "Vanha salausavaimen salasana",
    "New recovery key password" : "Uusi salausavaimen salasana",
    "Repeat new recovery key password" : "Toista uusi salausavaimen salasana",
    "Change Password" : "Vaihda salasana",
    "Basic encryption module" : "Perus salausmoduuli",
    "Your private key password no longer matches your log-in password." : "Salaisen avaimesi salasana ei enää vastaa kirjautumissalasanaasi.",
    "Set your old private key password to your current log-in password:" : "Aseta yksityisen avaimen vanha salasana vastaamaan nykyistä kirjautumissalasanaasi:",
    " If you don't remember your old password you can ask your administrator to recover your files." : "Jos et muista vanhaa salasanaasi, voit pyytää ylläpitäjää palauttamaan tiedostosi.",
    "Old log-in password" : "Vanha kirjautumissalasana",
    "Current log-in password" : "Nykyinen kirjautumissalasana",
    "Update Private Key Password" : "Päivitä yksityisen avaimen salasana",
    "Enable password recovery:" : "Ota salasanan palautus käyttöön:",
    "Enabling this option will allow you to reobtain access to your encrypted files in case of password loss" : "Tämän valinnan käyttäminen mahdollistaa pääsyn salattuihin tiedostoihisi, jos salasana unohtuu",
    "Enabled" : "Käytössä",
    "Disabled" : "Ei käytössä",
    "Encryption App is enabled but your keys are not initialized, please log-out and log-in again" : "Salaussovellus on käytössä, mutta salausavaimia ei ole alustettu. Ole hyvä ja kirjaudu sisään uudelleen."
},
"nplurals=2; plural=(n != 1);");
