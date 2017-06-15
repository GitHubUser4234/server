OC.L10N.register(
    "encryption",
    {
    "Missing recovery key password" : "Falta contraseña de recuperación",
    "Please repeat the recovery key password" : "Por favor, repita la contraseña de recuperación",
    "Repeated recovery key password does not match the provided recovery key password" : "La contraseña de recuperación reintroducida no coincide con la contraseña de recuperación proporcionada",
    "Recovery key successfully enabled" : "Se ha habilitado la recuperación de archivos",
    "Could not enable recovery key. Please check your recovery key password!" : "No se pudo habilitar la contraseña de recuperación. Por favor, ¡compruebe su contraseña de recuperación!",
    "Recovery key successfully disabled" : "Clave de recuperación deshabilitada",
    "Could not disable recovery key. Please check your recovery key password!" : "No se pudo deshabilitar la clave de recuperación. Por favor, ¡compruebe su contraseña!",
    "Missing parameters" : "Faltan parámetros",
    "Please provide the old recovery password" : "Por favor, ingrese su antigua contraseña de recuperación",
    "Please provide a new recovery password" : "Por favor, provea una nueva contraseña de recuperación",
    "Please repeat the new recovery password" : "Por favor, repita su nueva contraseña de recuperación",
    "Password successfully changed." : "Su contraseña ha sido cambiada",
    "Could not change the password. Maybe the old password was not correct." : "No se pudo cambiar la contraseña. Compruebe que la contraseña actual sea correcta.",
    "Recovery Key disabled" : "Desactivada la clave de recuperación",
    "Recovery Key enabled" : "Recuperación de clave habilitada",
    "Could not enable the recovery key, please try again or contact your administrator" : "No se pudo habilitar la clave de recuperación, por favor vuelva a intentarlo o póngase en contacto con su administrador",
    "Could not update the private key password." : "No se pudo actualizar la contraseña de la clave privada.",
    "The old password was not correct, please try again." : "La antigua contraseña no es correcta, por favor inténtelo de nuevo.",
    "The current log-in password was not correct, please try again." : "La contraseña de inicio de sesión actual no es correcta, por favor inténtelo de nuevo.",
    "Private key password successfully updated." : "Contraseña de clave privada actualizada con éxito.",
    "You need to migrate your encryption keys from the old encryption (ownCloud <= 8.0) to the new one. Please run 'occ encryption:migrate' or contact your administrator" : "Necesita migrar sus claves de cifrado desde el antiguo modelo de cifrado (ownCloud <= 8.0) al nuevo. Por favor ejecute 'occ encryption:migrate'  o contáctese con su administrador.",
    "Invalid private key for encryption app. Please update your private key password in your personal settings to recover access to your encrypted files." : "La clave privada no es válida para la app de cifrado. Por favor, actualice la contraseña de su clave privada en sus ajustes personales para recuperar el acceso a sus archivos cifrados.",
    "Encryption App is enabled, but your keys are not initialized. Please log-out and log-in again." : "La aplicación de cifrado esta activada, pero sus credenciales no han sido iniciadas. Por favor cierre sesión e inicie sesión nuevamente.",
    "Encryption app is enabled and ready" : "La app de cifrado esta habilitada y preparada",
    "Bad Signature" : "Firma errónea",
    "Missing Signature" : "No se encuentra la firma",
    "one-time password for server-side-encryption" : "Contraseña de un solo uso para el cifrado en el lado servidor",
    "Can not decrypt this file, probably this is a shared file. Please ask the file owner to reshare the file with you." : "No fue posible descifrar este archivo, probablemente se trate de un archivo compartido. Solicite al propietario del mismo que vuelva a compartirlo con usted.",
    "Can not read this file, probably this is a shared file. Please ask the file owner to reshare the file with you." : "No se puede leer este archivo, probablemente sea un archivo compartido. Consulte con el propietario del mismo y que lo vuelva a compartir con usted.",
    "Default encryption module" : "Módulo de cifrado por defecto",
    "Hey there,\n\nthe admin enabled server-side-encryption. Your files were encrypted using the password '%s'.\n\nPlease login to the web interface, go to the section 'basic encryption module' of your personal settings and update your encryption password by entering this password into the 'old log-in password' field and your current login-password.\n\n" : "Hola,\n\nel administrador ha activado el cifrado de datos en servidor. Tus archivos han sido cifrados usando la contraseña '%s'.\n\nPor favor, inicia tu sesión desde la interfaz web, ves a la sección 'módulo de cifrado básico' de tu área de ajustes personales y actualiza la contraseña de cifrado. Para ello, deberás introducir esta contraseña en el campo 'contraseña de acceso antigua' junto con tu actual contraseña de acceso.\n\n",
    "The share will expire on %s." : "El objeto dejará de ser compartido el %s.",
    "Cheers!" : "¡Saludos!",
    "Hey there,<br><br>the admin enabled server-side-encryption. Your files were encrypted using the password <strong>%s</strong>.<br><br>Please login to the web interface, go to the section \"basic encryption module\" of your personal settings and update your encryption password by entering this password into the \"old log-in password\" field and your current login-password.<br><br>" : "Hola,<br><br>el administrador ha activado el cifrado de datos en servidor. Tus archivos han sido cifrados usando la contraseña <strong>%s</strong>.<br><br>Por favor, inicia tu sesión desde la interfaz web, ves a la sección 'módulo de cifrado básico' de tu área de ajustes personales y actualiza la contraseña de cifrado. Para ello, deberás introducir esta contraseña en el campo 'contraseña de acceso antigua' junto con tu actual contraseña de acceso.<br><br>",
    "Encryption app is enabled but your keys are not initialized, please log-out and log-in again" : "La app de cifrado está habilitada pero sus claves no se han inicializado, por favor, cierre la sesión y vuelva a iniciarla de nuevo.",
    "Encrypt the home storage" : "Encriptar el almacenamiento personal",
    "Enabling this option encrypts all files stored on the main storage, otherwise only files on external storage will be encrypted" : "Al activar esta opción se encriptarán todos los archivos almacenados en la memoria principal, de lo contrario serán cifrados sólo los archivos de almacenamiento externo",
    "Enable recovery key" : "Activa la clave de recuperación",
    "Disable recovery key" : "Desactiva la clave de recuperación",
    "The recovery key is an extra encryption key that is used to encrypt files. It allows recovery of a user's files if the user forgets his or her password." : "La clave de recuperación es una clave de cifrado extra que se usa para cifrar archivos . Permite la recuperación de los archivos de un usuario si él o ella olvida su contraseña.",
    "Recovery key password" : "Contraseña de clave de recuperación",
    "Repeat recovery key password" : "Repita la contraseña de recuperación",
    "Change recovery key password:" : "Cambiar la contraseña de la clave de recuperación",
    "Old recovery key password" : "Antigua contraseña de recuperación",
    "New recovery key password" : "Nueva contraseña de recuperación",
    "Repeat new recovery key password" : "Repita la nueva contraseña de recuperación",
    "Change Password" : "Cambiar contraseña",
    "Basic encryption module" : "Módulo básico de cifrado",
    "Your private key password no longer matches your log-in password." : "Su contraseña de clave privada ya no coincide con su contraseña de acceso.",
    "Set your old private key password to your current log-in password:" : "Establezca la contraseña de clave privada antigua para su contraseña de inicio de sesión actual:",
    " If you don't remember your old password you can ask your administrator to recover your files." : "Si no recuerda su antigua contraseña puede pedir a su administrador que le recupere sus archivos.",
    "Old log-in password" : "Contraseña de acceso antigua",
    "Current log-in password" : "Contraseña de acceso actual",
    "Update Private Key Password" : "Actualizar contraseña de clave privada",
    "Enable password recovery:" : "Habilitar la recuperación de contraseña:",
    "Enabling this option will allow you to reobtain access to your encrypted files in case of password loss" : "Habilitar esta opción le permitirá volver a tener acceso a sus archivos cifrados en caso de pérdida de contraseña",
    "Enabled" : "Habilitar",
    "Disabled" : "Deshabilitado",
    "Encryption App is enabled but your keys are not initialized, please log-out and log-in again" : "La app de cifrado está habilitada pero sus claves no se han inicializado, por favor, cierre la sesión y vuelva a iniciarla de nuevo."
},
"nplurals=2; plural=(n != 1);");
