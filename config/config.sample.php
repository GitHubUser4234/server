<?php

define("DEBUG", true);

$CONFIG = array(
"installed" => false,
"dbtype" => "sqlite",
"dbname" => "owncloud",
"dbuser" => "",
"dbpassword" => "",
"dbhost" => "",
"dbtableprefix" => "",
"forcessl" => false,
"enablebackup" => false,
"theme" => "",
"3rdpartyroot" => "",
"3rdpartyurl" => "",
"defaultapp" => "files",
"knowledgebaseenabled" => true,
"knowledgebaseurl" => "",
"appstoreenabled" => true,
"appstoreurl" => "",
"mail_smtpmode" => "sendmail",
"mail_smtphost" => "127.0.0.1",
"mail_smtpauth" => false,
"mail_smtpname" => "",
"mail_smtppassword" => "",
"appcodechecker" => "",
"log_type" => "",
"logfile" => "",
"loglevel" => "",
"passwordsalt" => "",
"updatechecker" => true,
/* Set this to false to disable the check for writable apps dir.
 * If the apps dir is not writable, you can't download&install extra apps
 * in the admin apps menu.
 */
"writable_appsdir" => true,
// "datadirectory" => ""
);
?>
