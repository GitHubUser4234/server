OC.L10N.register(
    "encryption",
    {
    "Missing recovery key password" : "Отсутствует пароль восстановления ключа",
    "Please repeat the recovery key password" : "Повторите ввод пароля ключа восстановления",
    "Repeated recovery key password does not match the provided recovery key password" : "Пароль ключа восстановления и повтор пароля не совпадают",
    "Recovery key successfully enabled" : "Ключ восстановления успешно установлен",
    "Could not enable recovery key. Please check your recovery key password!" : "Невозможно включить ключ восстановления. Проверьте правильность пароля от ключа!",
    "Recovery key successfully disabled" : "Ключ восстановления успешно отключен",
    "Could not disable recovery key. Please check your recovery key password!" : "Невозможно выключить ключ восстановления. Проверьте правильность пароля от ключа!",
    "Missing parameters" : "Отсутствуют параметры",
    "Please provide the old recovery password" : "Введите старый пароль восстановления",
    "Please provide a new recovery password" : "Введите новый пароль восстановления",
    "Please repeat the new recovery password" : "Повторите новый пароль восстановления",
    "Password successfully changed." : "Пароль успешно изменен.",
    "Could not change the password. Maybe the old password was not correct." : "Невозможно изменить пароль. Возможно, указанный старый пароль не верен.",
    "Recovery Key disabled" : "Ключ Восстановления отключен",
    "Recovery Key enabled" : "Ключ Восстановления включен",
    "Could not enable the recovery key, please try again or contact your administrator" : "Не возможно задействовать ключ восстановления, попробуйте снова или обратитесь к вашему системному администатору",
    "Could not update the private key password." : "Невозможно обновить пароль закрытого ключа.",
    "The old password was not correct, please try again." : "Указан неверный старый пароль, повторите попытку.",
    "The current log-in password was not correct, please try again." : "Текущий пароль для учётной записи введён неверно, пожалуйста повторите попытку.",
    "Private key password successfully updated." : "Пароль закрытого ключа успешно обновлён.",
    "You need to migrate your encryption keys from the old encryption (ownCloud <= 8.0) to the new one. Please run 'occ encryption:migrate' or contact your administrator" : "Вам необходимо произвести конвертацию ключей шифрования из старого формата (ownCloud <= 8.0) в новый. Пожалуйста запустите команду 'occ encryption:migrate' или обратитесь к администратору.",
    "Invalid private key for Encryption App. Please update your private key password in your personal settings to recover access to your encrypted files." : "Закрытый ключ приложения шифрования недействителен. Обновите закрытый ключ в личных настройках, чтобы восстановить доступ к зашифрованным файлам.",
    "Encryption App is enabled but your keys are not initialized, please log-out and log-in again" : "Приложение шифрования активно, но ваши ключи не инициализированы, выйдите из системы и войдите заново",
    "Encryption App is enabled and ready" : "Приложение шифрования включено и готово",
    "one-time password for server-side-encryption" : "одноразовый пароль для шифрования на стороне сервера",
    "Can not decrypt this file, probably this is a shared file. Please ask the file owner to reshare the file with you." : "Не удалось расшифровать файл, возможно это опубликованный файл. Попросите владельца файла повторно открыть к нему доступ.",
    "Can not read this file, probably this is a shared file. Please ask the file owner to reshare the file with you." : "Не удается прочитать файл, возможно это публичный файл. Пожалуйста попросите владельца открыть доступ снова.",
    "Hey there,\n\nthe admin enabled server-side-encryption. Your files were encrypted using the password '%s'.\n\nPlease login to the web interface, go to the section 'ownCloud basic encryption module' of your personal settings and update your encryption password by entering this password into the 'old log-in password' field and your current login-password.\n\n" : "Привет,\n\nадминистратор включил шифрование на стороне сервера. Ваши файлы были зашифрованы с помощью пароля '%s'.\n\nПожалуйста войдите в веб-приложение, в разделе 'ownCloud простой модуль шифрования' в личных настройках вам нужно обновить пароль шифрования.\n\n",
    "The share will expire on %s." : "Доступ будет закрыт %s",
    "Cheers!" : "Всего наилучшего!",
    "Hey there,<br><br>the admin enabled server-side-encryption. Your files were encrypted using the password <strong>%s</strong>.<br><br>Please login to the web interface, go to the section \"ownCloud basic encryption module\" of your personal settings and update your encryption password by entering this password into the \"old log-in password\" field and your current login-password.<br><br>" : "Привет,<br><br>администратор включил шифрование на стороне сервера. Ваши файлы были зашифрованы с помощью пароля <strong>%s</strong>.<br><br>Пожалуйста войдите в веб-приложение, в разделе \"ownCloud простой модуль шифрования\" в личных настройках вам нужно обновить пароль шифрования.<br><br>",
    "Encrypt the home storage" : "Зашифровать домашнюю директорию",
    "Enabling this option encrypts all files stored on the main storage, otherwise only files on external storage will be encrypted" : "Данный параметр позволяет зашифровать все файлы, хранящиеся в главном хранилище, иначе только файлы на внешних хранилищах будут зашифрованы",
    "Enable recovery key" : "Включить ключ восстановления",
    "Disable recovery key" : "Отключить ключ восстановления",
    "The recovery key is an extra encryption key that is used to encrypt files. It allows recovery of a user's files if the user forgets his or her password." : "Ключ восстановления это дополнительный ключ, который используется для шифрования файлов. Он позволяет восстановить пользовательские файлы в случае утери пароля.",
    "Recovery key password" : "Пароль ключа восстановления",
    "Repeat recovery key password" : "Повторите пароль ключа восстановления",
    "Change recovery key password:" : "Смена пароля ключа восстановления:",
    "Old recovery key password" : "Старый пароль ключа восстановления",
    "New recovery key password" : "Новый пароль ключа восстановления",
    "Repeat new recovery key password" : "Повторите новый пароль ключа восстановления",
    "Change Password" : "Изменить пароль",
    "ownCloud basic encryption module" : "Базовый модуль шифрования ownCloud",
    "Your private key password no longer matches your log-in password." : "Пароль закрытого ключа больше не соответствует паролю вашей учетной записи.",
    "Set your old private key password to your current log-in password:" : "Замените старый пароль закрытого ключа на текущий пароль учётной записи.",
    " If you don't remember your old password you can ask your administrator to recover your files." : "Если вы не помните свой старый пароль, вы можете попросить своего администратора восстановить ваши файлы",
    "Old log-in password" : "Старый пароль учётной записи",
    "Current log-in password" : "Текущий пароль учётной записи",
    "Update Private Key Password" : "Обновить пароль закрытого ключа",
    "Enable password recovery:" : "Включить восстановление пароля:",
    "Enabling this option will allow you to reobtain access to your encrypted files in case of password loss" : "Включение этой опции позволит вам получить доступ к своим зашифрованным файлам в случае утери пароля",
    "Enabled" : "Включено",
    "Disabled" : "Отключено"
},
"nplurals=4; plural=(n%10==1 && n%100!=11 ? 0 : n%10>=2 && n%10<=4 && (n%100<12 || n%100>14) ? 1 : n%10==0 || (n%10>=5 && n%10<=9) || (n%100>=11 && n%100<=14)? 2 : 3);");
