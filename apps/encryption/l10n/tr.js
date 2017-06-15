OC.L10N.register(
    "encryption",
    {
    "Missing recovery key password" : "Geri yükleme anahtarı parolası eksik",
    "Please repeat the recovery key password" : "Geri yükleme anahtarı parolasını yeniden yazın",
    "Repeated recovery key password does not match the provided recovery key password" : "Geri yükleme anahtarı parolası ile onayı aynı değil",
    "Recovery key successfully enabled" : "Geri yükleme anahtarı etkinleştirildi",
    "Could not enable recovery key. Please check your recovery key password!" : "Geri yükleme anahtarı etkinleştirilemedi. Lütfen geri yükleme anahtarı parolanızı denetleyin!",
    "Recovery key successfully disabled" : "Geri yükleme anahtarı devre dışı bırakıldı",
    "Could not disable recovery key. Please check your recovery key password!" : "Geri yükleme anahtarı devre dışı bırakılamadı. Lütfen geri yükleme anahtarı parolanızı denetleyin!",
    "Missing parameters" : "Parametreler eksik",
    "Please provide the old recovery password" : "Lütfen eski geri yükleme parolasını yazın",
    "Please provide a new recovery password" : "Lütfen yeni geri yükleme parolasını yazın",
    "Please repeat the new recovery password" : "Lütfen yeni geri yükleme parolasını yeniden yazın",
    "Password successfully changed." : "Parola değiştirildi.",
    "Could not change the password. Maybe the old password was not correct." : "Parola değiştirilemedi. Eski parolanızı doğru yazmamış olabilirsiniz.",
    "Recovery Key disabled" : "Geri Yükleme Anahtarı devre dışı",
    "Recovery Key enabled" : "Geri Yükleme Anahtarı etkin",
    "Could not enable the recovery key, please try again or contact your administrator" : "Geri yükleme anahtarı etkinleştirilemedi, yeniden deneyin ya da sistem yöneticisi ile görüşün",
    "Could not update the private key password." : "Özel anahtar parolası güncellenemedi",
    "The old password was not correct, please try again." : "Eski parola doğru değil, lütfen yeniden deneyin.",
    "The current log-in password was not correct, please try again." : "Geçerli oturum açma parolası doğru değil, lütfen yeniden deneyin.",
    "Private key password successfully updated." : "Özel anahtar parolası güncellendi.",
    "You need to migrate your encryption keys from the old encryption (ownCloud <= 8.0) to the new one. Please run 'occ encryption:migrate' or contact your administrator" : "Eski şifreleme anahtarlarınızın eski şifrelemeden (ownCloud <= 8.0) yenisine aktarılması gerekiyor. Lütfen 'occ encryption:migrate' komutunu çalıştırın ya da sistem yöneticiniz ile görüşün",
    "Invalid private key for encryption app. Please update your private key password in your personal settings to recover access to your encrypted files." : "Şifreleme uygulaması özel anahtarı geçersiz. Şifrelenmiş dosyalarınıza erişebilmek için kişisel ayarlarınızdaki özel anahtar parolanızı güncelleyin.",
    "Encryption App is enabled, but your keys are not initialized. Please log-out and log-in again." : "Şifreleme Uygulaması etkin ancak anahtarlarınız hazırlanmamış. Lütfen oturumunuzu kapatıp yeniden açın",
    "Encryption app is enabled and ready" : "Şifreleme uygulaması etkinleştirilmiş ve hazır",
    "Bad Signature" : "İmza Kötü",
    "Missing Signature" : "İmza Eksik",
    "one-time password for server-side-encryption" : "sunucu tarafında şifreleme için tek kullanımlık parola",
    "Can not decrypt this file, probably this is a shared file. Please ask the file owner to reshare the file with you." : "Bu dosya büyük olasılıkla paylaşılıyor olduğundan şifresi çözülemiyor. Lütfen dosya sahibi ile görüşerek sizinle yeniden paylaşmasını isteyin.",
    "Can not read this file, probably this is a shared file. Please ask the file owner to reshare the file with you." : "Bu dosya büyük olasılıkla paylaşılıyor olduğundan okunamıyor. Lütfen dosya sahibi ile görüşerek sizinle yeniden paylaşmasını isteyin.",
    "Default encryption module" : "Varsayılan şifreleme modülü",
    "Hey there,\n\nthe admin enabled server-side-encryption. Your files were encrypted using the password '%s'.\n\nPlease login to the web interface, go to the section 'basic encryption module' of your personal settings and update your encryption password by entering this password into the 'old log-in password' field and your current login-password.\n\n" : "Selam,\n\nSistem yöneticisi sunucu tarafında şifrelemeyi etkinleştirdi. Dosyalarınız '%s' parolası kullanılarak şifrelendi.\n\nLütfen web arayüzünde oturum açın ve kişisel ayarlarınızdan 'temel şifreleme modülü'ne giderek 'eski oturum açma parolası' alanına bu parolayı ve geçerli oturum açma parolanızı yazarak şifreleme parolanızı güncelleyin.\n\n",
    "The share will expire on %s." : "Bu paylaşım %s tarihinde sona erecek.",
    "Cheers!" : "Hoşçakalın!",
    "Hey there,<br><br>the admin enabled server-side-encryption. Your files were encrypted using the password <strong>%s</strong>.<br><br>Please login to the web interface, go to the section \"basic encryption module\" of your personal settings and update your encryption password by entering this password into the \"old log-in password\" field and your current login-password.<br><br>" : "Selam,<br><br>Sistem yöneticisi sunucu tarafında şifrelemeyi etkinleştirdi. Dosyalarınız <strong>%s</strong> parolası kullanılarak şifrelendi.<br><br>Lütfen web arayüzünde oturum açın ve kişisel ayarlarınızdan 'temel şifreleme modülü'ne giderek 'eski oturum açma parolası' alanına bu parolayı ve geçerli oturum açma parolanızı yazarak şifreleme parolanızı güncelleyin.<br><br>",
    "Encryption app is enabled but your keys are not initialized, please log-out and log-in again" : "Şifreleme uygulaması etkin ancak anahtarlarınız hazırlanmamış. Lütfen oturumunuzu kapatıp yeniden açın.",
    "Encrypt the home storage" : "Ana depolama şifrelensin",
    "Enabling this option encrypts all files stored on the main storage, otherwise only files on external storage will be encrypted" : "Bu seçenek etkinleştirildiğinde, ana depolama alanındaki tüm dosyalar şifrelenir. Devre dışı bırakıldığında yalnız dış depolama alanındaki dosyalar şifrelenir",
    "Enable recovery key" : "Kurtarma anahtarını etkinleştir",
    "Disable recovery key" : "Kurtarma anahtarını devre dışı bırak",
    "The recovery key is an extra encryption key that is used to encrypt files. It allows recovery of a user's files if the user forgets his or her password." : "Kurtarma anahtarı, dosyaların şifrelenmesi için ek bir güvenlik sağlar. Böylece kullanıcı unutursa dosyalarının parolasını sıfırlayabilir.",
    "Recovery key password" : "Kurtarma anahtarı parolası",
    "Repeat recovery key password" : "Kurtarma anahtarı parolası onayı",
    "Change recovery key password:" : "Kurtarma anahtarı parolasını değiştir:",
    "Old recovery key password" : "Eski kurtarma anahtarı parolası",
    "New recovery key password" : "Yeni kurtarma anahtarı parolası",
    "Repeat new recovery key password" : "Yeni kurtarma anahtarı parolası onayı",
    "Change Password" : "Parolayı Değiştir",
    "Basic encryption module" : "Temel şifreleme modülü",
    "Your private key password no longer matches your log-in password." : "Özel anahtar parolanız artık oturum açma parolanız ile eşleşmiyor.",
    "Set your old private key password to your current log-in password:" : "Eski özel anahtar parolanızı, geçerli oturum açma parolanız olarak ayarlayın:",
    " If you don't remember your old password you can ask your administrator to recover your files." : "Eski parolanızı hatırlamıyorsanız, yöneticinizden dosyalarınızı kurtarmasını isteyebilirsiniz.",
    "Old log-in password" : "Eski oturum açma parolası",
    "Current log-in password" : "Geçerli oturum açma parolası",
    "Update Private Key Password" : "Özel Anahtar Parolasını Güncelle",
    "Enable password recovery:" : "Parola kurtarmayı etkinleştir:",
    "Enabling this option will allow you to reobtain access to your encrypted files in case of password loss" : "Bu seçenek etkinleştirildiğinde, parolayı unutursanız şifrelenmiş dosyalarınıza yeniden erişim izni elde edebilirsiniz",
    "Enabled" : "Etkin",
    "Disabled" : "Devre Dışı",
    "Encryption App is enabled but your keys are not initialized, please log-out and log-in again" : "Şifreleme Uygulaması etkin ancak anahtarlarınız hazırlanmamış. Lütfen oturumunuzu kapatıp yeniden açın"
},
"nplurals=2; plural=(n > 1);");
