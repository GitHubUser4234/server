<?php

/**
 * This configuration file is only provided to document the different
 * configuration options and their usage.
 *
 * DO NOT COMPLETELY BASE YOUR CONFIGURATION FILE ON THIS SAMPLE. THIS MAY BREAK
 * YOUR INSTANCE. Instead, manually copy configuration switches that you
 * consider important for your instance to your working ``config.php``, and
 * apply configuration options that are pertinent for your instance.
 *
 * This file is used to generate the config documentation. Please consider
 * following requirements of the current parser:
 *  * all comments need to start with `/**` and end with ` *\/` - each on their
 *    own line
 *  * add a `@see CONFIG_INDEX` to copy a previously described config option
 *    also to this line
 *  * everything between the ` *\/` and the next `/**` will be treated as the
 *    config option
 *  * use RST syntax
 */

/**
 * Only enable this for local development and not in production environments
 * This will disable the minifier and outputs some additional debug informations
 */
define('DEBUG', true);

$CONFIG = array(


/**
 * Default Parameters
 *
 * These parameters are configured by the ownCloud installer, and are required
 * for your ownCloud server to operate.
 */


/**
 * This is a unique identifier for your ownCloud installation, created
 * automatically by the installer. This example is for documentation only,
 * and you should never use it because it will not work. A valid ``instanceid``
 * is created when you install ownCloud.
 *
 * 'instanceid' => 'd3c944a9a',
 */
'instanceid' => '',

 /**
  * The salt used to hash all passwords, auto-generated by the ownCloud
  * installer. (There are also per-user salts.) If you lose this salt you lose
  * all your passwords. This example is for documentation only, and you should
  * never use it.
  *
  * @deprecated This salt is deprecated and only used for legacy-compatibility,
  * developers should *NOT* use this value for anything nowadays.
  *
  * 'passwordsalt' => 'd3c944a9af095aa08f',
 */
'passwordsalt' => '',

/**
 * The hashing cost used by hashes generated by ownCloud
 * Using a higher value requires more time and CPU power to calculate the hashes
 */
'hashingCost' => 10,

/**
 * Your list of trusted domains that users can log into. Specifying trusted
 * domains prevents host header poisoning. Do not remove this, as it performs
 * necessary security checks.
 */
'trusted_domains' =>
  array (
    'demo.example.org',
    'otherdomain.example.org',
  ),


/**
 * Where user files are stored; this defaults to ``data/`` in the ownCloud
 * directory. The SQLite database is also stored here, when you use SQLite.
 * (SQLite is available only in ownCloud Community Edition)
 */
'datadirectory' => '/var/www/owncloud/data',

/**
 * The current version number of your ownCloud installation. This is set up
 * during installation and update, so you shouldn't need to change it.
 */
'version' => '',

/**
 * Identifies the database used with this installation. See also config option
 * ``supportedDatabases``
 *
 * Available:
 * 	- sqlite (SQLite3 - Community Edition Only)
 * 	- mysql (MySQL/MariaDB)
 * 	- pgsql (PostgreSQL)
 * 	- oci (Oracle - Enterprise Edition Only)
 * 	- mssql (Microsoft SQL Server - Enterprise Edition Only)
 */
'dbtype' => 'sqlite',

/**
 * Your host server name, for example ``localhost``, ``hostname``,
 * ``hostname.example.com``, or the IP address. To specify a port use
 * ``hostname:####``; to specify a Unix socket use
 * ``localhost:/path/to/socket``.
 */
'dbhost' => '',

/**
 * The name of the ownCloud database, which is set during installation. You
 * should not need to change this.
 */
'dbname' => 'owncloud',

/**
 * The user that ownCloud uses to write to the database. This must be unique
 * across ownCloud instances using the same SQL database. This is set up during
 * installation, so you shouldn't need to change it.
 */
'dbuser' => '',

/**
 * The password for the database user. This is set up during installation, so
 * you shouldn't need to change it.
 */
'dbpassword' => '',

/**
 * Prefix for the ownCloud tables in the database.
 */
'dbtableprefix' => '',

/**
 * Additional driver options for the database connection, eg. to enable SSL
 * encryption in MySQL.
 */
'dbdriveroptions' => array(
	PDO::MYSQL_ATTR_SSL_CA => '/file/path/to/ca_cert.pem',
),

/**
 * sqlite3 journal mode can be specified using this config parameter - can be
 * 'WAL' or 'DELETE' see for more details https://www.sqlite.org/wal.html
 */
'sqlite.journal_mode' => 'DELETE',

/**
 * Indicates whether the ownCloud instance was installed successfully; ``true``
 * indicates a successful installation, and ``false`` indicates an unsuccessful
 * installation.
 */
'installed' => false,


/**
 * User Experience
 *
 * These optional parameters control some aspects of the user interface. Default
 * values, where present, are shown.
 */

/**
 * This sets the default language on your ownCloud server, using ISO_639-1
 * language codes such as ``en`` for English, ``de`` for German, and ``fr`` for
 * French. It overrides automatic language detection on public pages like login
 * or shared items. User's language preferences configured under "personal ->
 * language" override this setting after they have logged in.
 */
'default_language' => 'en',

/**
 * Set the default app to open on login. Use the app names as they appear in the
 * URL after clicking them in the Apps menu, such as documents, calendar, and
 * gallery. You can use a comma-separated list of app names, so if the first
 * app is not enabled for a user then ownCloud will try the second one, and so
 * on. If no enabled apps are found it defaults to the Files app.
 */
'defaultapp' => 'files',

/**
 * ``true`` enables the Help menu item in the user menu (top right of the
 * ownCloud Web interface). ``false`` removes the Help item.
 */
'knowledgebaseenabled' => true,

/**
 * ``true`` enables avatars, or user profile photos. These appear on the User
 * page, on user's Personal pages and are used by some apps (contacts, mail,
 * etc). ``false`` disables them.
 */
'enable_avatars' => true,

/**
 * ``true`` allows users to change their display names (on their Personal
 * pages), and ``false`` prevents them from changing their display names.
 */
'allow_user_to_change_display_name' => true,

/**
 * Lifetime of the remember login cookie, which is set when the user clicks the
 * ``remember`` checkbox on the login screen. The default is 15 days, expressed
 * in seconds.
 */
'remember_login_cookie_lifetime' => 60*60*24*15,

/**
 * The lifetime of a session after inactivity; the default is 24 hours,
 * expressed in seconds.
 */
'session_lifetime' => 60 * 60 * 24,

/**
 * Enable or disable session keep-alive when a user is logged in to the Web UI.
 * Enabling this sends a "heartbeat" to the server to keep it from timing out.
 */
'session_keepalive' => true,

/**
 * The directory where the skeleton files are located. These files will be
 * copied to the data directory of new users. Leave empty to not copy any
 * skeleton files.
 */
'skeletondirectory' => '',

/**
 * The ``user_backends`` app (which needs to be enabled first) allows you to
 * configure alternate authentication backends. Supported backends are:
 * IMAP (OC_User_IMAP), SMB (OC_User_SMB), and FTP (OC_User_FTP).
 */
'user_backends' => array(
	array(
		'class' => 'OC_User_IMAP',
		'arguments' => array('{imap.gmail.com:993/imap/ssl}INBOX')
	)
),


/**
 * Mail Parameters
 *
 * These configure the email settings for ownCloud notifications and password
 * resets.
 */

/**
 * The return address that you want to appear on emails sent by the ownCloud
 * server, for example ``oc-admin@example.com``, substituting your own domain,
 * of course.
 */
'mail_domain' => 'example.com',

/**
 * FROM address that overrides the built-in ``sharing-noreply`` and
 * ``lostpassword-noreply`` FROM addresses.
 */
'mail_from_address' => 'owncloud',

/**
 * Enable SMTP class debugging.
 */
'mail_smtpdebug' => false,

/**
 * Which mode to use for sending mail: ``sendmail``, ``smtp``, ``qmail`` or
 * ``php``.
 *
 * If you are using local or remote SMTP, set this to ``smtp``.
 *
 * If you are using PHP mail you must have an installed and working email system
 * on the server. The program used to send email is defined in the ``php.ini``
 * file.
 *
 * For the ``sendmail`` option you need an installed and working email system on
 * the server, with ``/usr/sbin/sendmail`` installed on your Unix system.
 *
 * For ``qmail`` the binary is /var/qmail/bin/sendmail, and it must be installed
 * on your Unix system.
 */
'mail_smtpmode' => 'sendmail',

/**
 * This depends on ``mail_smtpmode``. Specified the IP address of your mail
 * server host. This may contain multiple hosts separated by a semi-colon. If
 * you need to specify the port number append it to the IP address separated by
 * a colon, like this: ``127.0.0.1:24``.
 */
'mail_smtphost' => '127.0.0.1',

/**
 * This depends on ``mail_smtpmode``. Specify the port for sending mail.
 */
'mail_smtpport' => 25,

/**
 * This depends on ``mail_smtpmode``. This set an SMTP server timeout, in
 * seconds. You may need to increase this if you are running an anti-malware or
 * spam scanner.
 */
'mail_smtptimeout' => 10,

/**
 * This depends on ``mail_smtpmode``. Specify when you are using ``ssl`` or
 * ``tls``, or leave empty for no encryption.
 */
'mail_smtpsecure' => '',

/**
 * This depends on ``mail_smtpmode``. Change this to ``true`` if your mail
 * server requires authentication.
 */
'mail_smtpauth' => false,

/**
 * This depends on ``mail_smtpmode``. If SMTP authentication is required, choose
 * the authentication type as ``LOGIN`` (default) or ``PLAIN``.
 */
'mail_smtpauthtype' => 'LOGIN',

/**
 * This depends on ``mail_smtpauth``. Specify the username for authenticating to
 * the SMTP server.
 */
'mail_smtpname' => '',

/**
 * This depends on ``mail_smtpauth``. Specify the password for authenticating to
 * the SMTP server.
 */
'mail_smtppassword' => '',


/**
 * Proxy Configurations
 */

/**
 * The automatic hostname detection of ownCloud can fail in certain reverse
 * proxy and CLI/cron situations. This option allows you to manually override
 * the automatic detection; for example ``www.example.com``, or specify the port
 * ``www.example.com:8080``.
 */
'overwritehost' => '',

/**
 * When generating URLs, ownCloud attempts to detect whether the server is
 * accessed via ``https`` or ``http``. However, if ownCloud is behind a proxy
 * and the proxy handles the ``https`` calls, ownCloud would not know that
 * ``ssl`` is in use, which would result in incorrect URLs being generated.
 * Valid values are ``http`` and ``https``.
 */
'overwriteprotocol' => '',

/**
 * ownCloud attempts to detect the webroot for generating URLs automatically.
 * For example, if ``www.example.com/owncloud`` is the URL pointing to the
 * ownCloud instance, the webroot is ``/owncloud``. When proxies are in use, it
 * may be difficult for ownCloud to detect this parameter, resulting in invalid
 * URLs.
 */
'overwritewebroot' => '',

/**
 * This option allows you to define a manual override condition as a regular
 * expression for the remote IP address. For example, defining a range of IP
 * addresses starting with ``10.0.0.`` and ending with 1 to 3:
 * ``^10\.0\.0\.[1-3]$``
 */
'overwritecondaddr' => '',

/**
 * Use this configuration parameter to specify the base url for any urls which
 * are generated within ownCloud using any kind of command line tools (cron or
 * occ). The value should contain the full base URL:
 * ``https://www.example.com/owncloud``
 */
'overwrite.cli.url' => '',

/**
 * The URL of your proxy server, for example ``proxy.example.com:8081``.
 */
'proxy' => '',

/**
 * The optional authentication for the proxy to use to connect to the internet.
 * The format is: ``username:password``.
 */
'proxyuserpwd' => '',


/**
 * Deleted Items (trash bin)
 *
 * These parameters control the Deleted files app.
 */

/**
 * When the trash bin app is enabled (default), this is the number of days a
 * file will be kept in the trash bin. Default is 30 days.
 */
'trashbin_retention_obligation' => 30,

/**
 * Disable or enable auto-expiration for the trash bin. By default
 * auto-expiration is enabled.
 */
'trashbin_auto_expire' => true,


/**
 * ownCloud Verifications
 *
 * ownCloud performs several verification checks. There are two options,
 * ``true`` and ``false``.
 */

/**
 * Check 3rd party apps to make sure they are using the private API and not the
 * public API. If the app uses the private API it cannot be installed.
 */
'appcodechecker' => true,

/**
 * Check if ownCloud is up-to-date and shows a notification if a new version is
 * available.
 */
'updatechecker' => true,

/**
 * Is ownCloud connected to the Internet or running in a closed network?
 */
'has_internet_connection' => true,

/**
 * Allows ownCloud to verify a working WebDAV connection. This is done by
 * attempting to make a WebDAV request from PHP.
 */
'check_for_working_webdav' => true,

/**
 * This is a crucial security check on Apache servers that should always be set
 * to ``true``. This verifies that the ``.htaccess`` file is writable and works.
 * If it is not, then any options controlled by ``.htaccess``, such as large
 * file uploads, will not work. It also runs checks on the ``data/`` directory,
 * which verifies that it can't be accessed directly through the web server.
 */
'check_for_working_htaccess' => true,

/**
 * In certain environments it is desired to have a read-only config file.
 * When this switch is set to ``true`` ownCloud will not verify whether the
 * configuration is writable. However, it will not be possible to configure
 * all options via the web-interface. Furthermore, when updating ownCloud
 * it is required to make the config file writable again for the update
 * process.
 */
'config_is_read_only' => false,

/**
 * Logging
 */

/**
 * By default the ownCloud logs are sent to the ``owncloud.log`` file in the
 * default ownCloud data directory.
 * If syslogging is desired, set this parameter to ``syslog``.
 * Setting this parameter to ``errorlog`` will use the PHP error_log function
 * for logging.
 */
'log_type' => 'owncloud',

/**
 * Change the ownCloud logfile name from ``owncloud.log`` to something else.
 */
'logfile' => 'owncloud.log',

/**
 * Loglevel to start logging at. Valid values are: 0 = Debug, 1 = Info, 2 =
 * Warning, 3 = Error. The default value is Warning.
 */
'loglevel' => 2,

/**
 * This uses PHP.date formatting; see http://php.net/manual/en/function.date.php
 */
'logdateformat' => 'F d, Y H:i:s',

/**
 * The default timezone for logfiles is UTC. You may change this; see
 * http://php.net/manual/en/timezones.php
 */
'logtimezone' => 'Europe/Berlin',

/**
 * Append all database queries and parameters to the log file. Use this only for
 * debugging, as your logfile will become huge.
 */
'log_query' => false,

/**
 * Log successful cron runs.
 */
'cron_log' => true,

/**
 * Location of the lock file for cron executions can be specified here.
 * Default is within the tmp directory. The file is named in the following way
 *   owncloud-server-$INSTANCEID-cron.lock
 * where $INSTANCEID is the string specified in the instanceid field.
 * Because the cron lock file is accessed in regular intervals, it may prevent
 * enabled disk drives from spinning down. A different location for this file
 * can solve such issues.
 */
'cron.lockfile.location' => '',

/**
 * Enables log rotation and limits the total size of logfiles. The default is 0,
 * or no rotation. Specify a size in bytes, for example 104857600 (100 megabytes
 * = 100 * 1024 * 1024 bytes). A new logfile is created with a new name when the
 * old logfile reaches your limit. The total size of all logfiles is double the
 * ``log_rotate_sizerotation`` value.
 */
'log_rotate_size' => false,


/**
 * Alternate Code Locations
 *
 * Some of the ownCloud code may be stored in alternate locations.
 */

/**
 * ownCloud uses some 3rd party PHP components to provide certain functionality.
 * These components are shipped as part of the software package and reside in
 * ``owncloud/3rdparty``. Use this option to configure a different location.
 */
'3rdpartyroot' => '',

/**
 * If you have an alternate ``3rdpartyroot``, you must also configure the URL as
 * seen by a Web browser.
 */
'3rdpartyurl' => '',

/**
 * This section is for configuring the download links for ownCloud clients, as
 * seen in the first-run wizard and on Personal pages.
 */
'customclient_desktop' =>
	'http://owncloud.org/sync-clients/',
'customclient_android' =>
	'https://play.google.com/store/apps/details?id=com.owncloud.android',
'customclient_ios' =>
	'https://itunes.apple.com/us/app/owncloud/id543672169?mt=8',

/**
 * Apps
 *
 * Options for the Apps folder, Apps store, and App code checker.
 */

/**
 * When enabled, admins may install apps from the ownCloud app store.
 * The app store is disabled by default for ownCloud Enterprise Edition
 */
'appstoreenabled' => true,

/**
 * The URL of the appstore to use.
 */
'appstoreurl' => 'https://api.owncloud.com/v1',

/**
 * Use the ``apps_paths`` parameter to set the location of the Apps directory,
 * which should be scanned for available apps, and where user-specific apps
 * should be installed from the Apps store. The ``path`` defines the absolute
 * file system path to the app folder. The key ``url`` defines the HTTP web path
 * to that folder, starting from the ownCloud web root. The key ``writable``
 * indicates if a web server can write files to that folder.
 */
'apps_paths' => array(
	array(
		'path'=> '/var/www/owncloud/apps',
		'url' => '/apps',
		'writable' => true,
	),
),

/**
 * @see appcodechecker
 */


/**
 * Previews
 *
 * ownCloud supports previews of image files, the covers of MP3 files, and text
 * files. These options control enabling and disabling previews, and thumbnail
 * size.
 */

/**
 * By default, ownCloud can generate previews for the following filetypes:
 *
 * - Images files
 * - Covers of MP3 files
 * - Text documents
 *
 * Valid values are ``true``, to enable previews, or
 * ``false``, to disable previews
 */
'enable_previews' => true,
/**
 * The maximum width, in pixels, of a preview. A value of ``null`` means there
 * is no limit.
 */
'preview_max_x' => null,
/**
 * The maximum height, in pixels, of a preview. A value of ``null`` means there
 * is no limit.
 */
'preview_max_y' => null,
/**
 * If a lot of small pictures are stored on the ownCloud instance and the
 * preview system generates blurry previews, you might want to consider setting
 * a maximum scale factor. By default, pictures are upscaled to 10 times the
 * original size. A value of ``1`` or ``null`` disables scaling.
 */
'preview_max_scale_factor' => 10,

/**
 * max file size for generating image previews with imagegd (default behaviour)
 * If the image is bigger, it'll try other preview generators,
 * but will most likely show the default mimetype icon
 *
 * Value represents the maximum filesize in megabytes
 * Default is 50
 * Set to -1 for no limit
 */
'preview_max_filesize_image' => 50,

/**
 * custom path for LibreOffice/OpenOffice binary
 */
'preview_libreoffice_path' => '/usr/bin/libreoffice',
/**
 * Use this if LibreOffice/OpenOffice requires additional arguments.
 */
'preview_office_cl_parameters' =>
	' --headless --nologo --nofirststartwizard --invisible --norestore '.
	'-convert-to pdf -outdir ',

/**
 * Only register providers that have been explicitly enabled
 *
 * The following providers are enabled by default:
 *
 *  - OC\Preview\Image
 *  - OC\Preview\MarkDown
 *  - OC\Preview\MP3
 *  - OC\Preview\TXT
 *
 * The following providers are disabled by default due to performance or privacy
 * concerns:
 *
 *  - OC\Preview\Illustrator
 *  - OC\Preview\Movie
 *  - OC\Preview\MSOffice2003
 *  - OC\Preview\MSOffice2007
 *  - OC\Preview\MSOfficeDoc
 *  - OC\Preview\OpenDocument
 *  - OC\Preview\PDF
 *  - OC\Preview\Photoshop
 *  - OC\Preview\Postscript
 *  - OC\Preview\StarOffice
 *  - OC\Preview\SVG
 *  - OC\Preview\TIFF
 *
 * .. note:: Troubleshooting steps for the MS Word previews are available
 *    at the :doc:`collaborative_documents_configuration` section
 *    of the Administrators Manual.
 *
 * The following providers are not available in Microsoft Windows:
 *
 *  - OC\Preview\Movie
 *  - OC\Preview\MSOfficeDoc
 *  - OC\Preview\MSOffice2003
 *  - OC\Preview\MSOffice2007
 *  - OC\Preview\OpenDocument
 *  - OC\Preview\StarOffice
 */
'enabledPreviewProviders' => array(
	'OC\Preview\Image',
	'OC\Preview\MP3',
	'OC\Preview\TXT',
	'OC\Preview\MarkDown'
),

/**
 * LDAP
 *
 * Global settings used by LDAP User and Group Backend
 */

/**
 * defines the interval in minutes for the background job that checks user
 * existance and marks them as ready to be cleaned up. The number is always
 * minutes. Setting it to 0 disables the feature.
 * See command line (occ) methods ldap:show-remnants and user:delete
 */
'ldapUserCleanupInterval' => 51,


/**
 * Maintenance
 *
 * These options are for halting user activity when you are performing server
 * maintenance.
 */

/**
 * Enable maintenance mode to disable ownCloud
 *
 * If you want to prevent users to login to ownCloud before you start doing some
 * maintenance work, you need to set the value of the maintenance parameter to
 * true. Please keep in mind that users who are already logged-in are kicked out
 * of ownCloud instantly.
 */
'maintenance' => false,

/**
 * When set to ``true``, the ownCloud instance will be unavailable for all users
 * who are not in the ``admin`` group.
 */
'singleuser' => false,


/**
 * SSL
 */

/**
 * Change this to ``true`` to require HTTPS for all connections, and to reject
 * HTTP requests.
 */
'forcessl' => false,

/**
 * Change this to ``true`` to require HTTPS connections also for all subdomains.
 * Works only together when `forcessl` is set to true.
 */
'forceSSLforSubdomains' => false,

/**
 * Extra SSL options to be used for configuration.
 */
'openssl' => array(
	'config' => '/absolute/location/of/openssl.cnf',
),


/**
 * Miscellaneous
 */

/**
 * Blacklist a specific file or files and disallow the upload of files
 * with this name. ``.htaccess`` is blocked by default.
 * WARNING: USE THIS ONLY IF YOU KNOW WHAT YOU ARE DOING.
 */
'blacklisted_files' => array('.htaccess'),

/**
 * Define a default folder for shared files and folders other than root.
 */
'share_folder' => '/',

/**
 * If you are applying a theme to ownCloud, enter the name of the theme here.
 * The default location for themes is ``owncloud/themes/``.
 */
'theme' => '',

/**
 * X-Frame-Restriction is a header which prevents browsers from showing the site
 * inside an iframe. This is be used to prevent clickjacking. It is risky to
 * disable this, so leave it set at ``true``.
 */
'xframe_restriction' => true,

/**
 * The default cipher for encrypting files. Currently AES-128-CFB and
 * AES-256-CFB are supported.
 */
'cipher' => 'AES-256-CFB',


/**
 * Connection details for redis to use for memory caching.
 * Redis is only used if other memory cache options (xcache, apc, apcu) are
 * not available.
 */
'redis' => array(
	'host' => 'localhost', // can also be a unix domain socket: '/tmp/redis.sock'
	'port' => 6379,
	'timeout' => 0.0
),

/**
 * Server details for one or more memcached servers to use for memory caching.
 * Memcache is only used if other memory cache options (xcache, apc, apcu,
 * redis) are not available.
 */
'memcached_servers' => array(
	// hostname, port and optional weight. Also see:
	// http://www.php.net/manual/en/memcached.addservers.php
	// http://www.php.net/manual/en/memcached.addserver.php
	array('localhost', 11211),
	//array('other.host.local', 11211),
),

/**
 * Location of the cache folder, defaults to ``data/$user/cache`` where
 * ``$user`` is the current user. When specified, the format will change to
 * ``$cache_path/$user`` where ``$cache_path`` is the configured cache directory
 * and ``$user`` is the user.
 */
'cache_path' => '',

/**
 * EXPERIMENTAL: option whether to include external storage in quota
 * calculation, defaults to false.
 */
'quota_include_external_storage' => false,

/**
 * Specifies how often the filesystem is checked for changes made outside
 * ownCloud.
 *
 * 0 -> Never check the filesystem for outside changes, provides a performance
 * increase when it's certain that no changes are made directly to the
 * filesystem
 *
 * 1 -> Check each file or folder at most once per request, recommended for
 * general use if outside changes might happen.
 *
 * 2 -> Check every time the filesystem is used, causes a performance hit when
 * using external storages, not recommended for regular use.
 */
'filesystem_check_changes' => 1,

/**
 * All css and js files will be served by the web server statically in one js
 * file and one css file if this is set to ``true``.
 */
'asset-pipeline.enabled' => false,

/**
 * The parent of the directory where css and js assets will be stored if
 * piplelining is enabled; this defaults to the ownCloud directory. The assets
 * will be stored in a subdirectory of this directory named 'assets'. The
 * server *must* be configured to serve that directory as $WEBROOT/assets.
 * You will only likely need to change this if the main ownCloud directory
 * is not writeable by the web server in your configuration.
 */
'assetdirectory' => '/var/www/owncloud',

/**
 * Where ``mount.json`` file should be stored, defaults to ``data/mount.json``
 */
'mount_file' => 'data/mount.json',

/**
 * When ``true``, prevent ownCloud from changing the cache due to changes in the
 * filesystem for all storage.
 */
'filesystem_cache_readonly' => false,

/**
 * The example below shows how to configure ownCloud to store all files in a
 * swift object storage.
 *
 * It is important to note that ownCloud in object store mode will expect
 * exclusive access to the object store container because it only stores the
 * binary data for each file. The metadata is currently kept in the local
 * database for performance reasons.
 *
 * WARNING: The current implementation is incompatible with any app that uses
 * direct file IO and circumvents our virtual filesystem. That includes
 * Encryption and Gallery. Gallery will store thumbnails directly in the
 * filesystem and encryption will cause severe overhead because key files need
 * to be fetched in addition to any requested file.
 *
 * One way to test is applying for a trystack account at http://trystack.org/
 */
'objectstore' => array(
	'class' => 'OC\\Files\\ObjectStore\\Swift',
	'arguments' => array(
		// trystack will user your facebook id as the user name
		'username' => 'facebook100000123456789',
		// in the trystack dashboard go to user -> settings -> API Password to
		// generate a password
		'password' => 'Secr3tPaSSWoRdt7',
		// must already exist in the objectstore, name can be different
		'container' => 'owncloud',
		// create the container if it does not exist. default is false
		'autocreate' => true,
		// required, dev-/trystack defaults to 'RegionOne'
		'region' => 'RegionOne',
		// The Identity / Keystone endpoint
		'url' => 'http://8.21.28.222:5000/v2.0',
		// required on dev-/trystack
		'tenantName' => 'facebook100000123456789',
		// dev-/trystack uses swift by default, the lib defaults to 'cloudFiles'
		// if omitted
		'serviceName' => 'swift',
	),
),

/**
 * Database types that are supported for installation.
 *
 * Available:
 * 	- sqlite (SQLite3 - Community Edition Only)
 * 	- mysql (MySQL)
 * 	- pgsql (PostgreSQL)
 * 	- oci (Oracle - Enterprise Edition Only)
 * 	- mssql (Microsoft SQL Server - Enterprise Edition Only)
 */
'supportedDatabases' => array(
	'sqlite',
	'mysql',
	'pgsql',
	'oci',
	'mssql'
),

/**
 * All other config options
 */

/**
 * Secret used by ownCloud for various purposes, e.g. to encrypt data. If you
 * lose this string there will be data corruption.
 */
'secret' => '',

/**
 * List of trusted proxy servers
 */
'trusted_proxies' => array('203.0.113.45', '198.51.100.128'),

/**
 * Headers that should be trusted as client IP address in combination with
 * `trusted_proxies`
 */
'forwarded_for_headers' => array('HTTP_X_FORWARDED', 'HTTP_FORWARDED_FOR'),

/**
 * max file size for animating gifs on public-sharing-site.
 * If the gif is bigger, it'll show a static preview
 *
 * Value represents the maximum filesize in megabytes
 * Default is 10
 * Set to -1 for no limit
 */
'max_filesize_animated_gifs_public_sharing' => 10,

/**
 * This entry is just here to show a warning in case somebody copied the sample
 * configuration. DO NOT ADD THIS SWITCH TO YOUR CONFIGURATION!
 *
 * If you, brave person, have read until here be aware that you should not
 * modify *ANY* settings in this file without reading the documentation.
 */
'copied_sample_config' => true,

);
