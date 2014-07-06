<?php
$TRANSLATIONS = array(
"Cannot write into \"config\" directory!" => "无法写入“config”目录！",
"See %s" => "查看 %s",
"You are accessing the server from an untrusted domain." => "您正在访问来自不信任域名的服务器。",
"Help" => "帮助",
"Personal" => "个人",
"Settings" => "设置",
"Users" => "用户",
"Admin" => "管理",
"Failed to upgrade \"%s\"." => "\"%s\" 升级失败。",
"No app name specified" => "没有指定的 App 名称",
"Unknown filetype" => "未知的文件类型",
"Invalid image" => "无效的图像",
"web services under your control" => "您控制的网络服务",
"App directory already exists" => "应用程序目录已存在",
"Can't create app folder. Please fix permissions. %s" => "无法创建应用程序文件夹。请修正权限。%s",
"No source specified when installing app" => "安装 App 时未指定来源",
"No href specified when installing app from http" => "从 http 安装 App 时未指定链接",
"No path specified when installing app from local file" => "从本地文件安装 App 时未指定路径",
"Archives of type %s are not supported" => "不支持 %s 的压缩格式",
"Failed to open archive when installing app" => "安装 App 是打开归档失败",
"App does not provide an info.xml file" => "应用未提供 info.xml 文件",
"App can't be installed because of not allowed code in the App" => "App 无法安装，因为 App 中有非法代码 ",
"App can't be installed because it is not compatible with this version of ownCloud" => "App 无法安装，因为和当前 ownCloud 版本不兼容",
"App can't be installed because it contains the <shipped>true</shipped> tag which is not allowed for non shipped apps" => "App 无法安装，因为 App 包含不允许在非内置 App 中使用的 <shipped>true</shipped> 标签",
"App can't be installed because the version in info.xml/version is not the same as the version reported from the app store" => "App 无法安装因为 info.xml/version 中的版本和 App 商店版本不同",
"Application is not enabled" => "应用程序未启用",
"Authentication error" => "认证出错",
"Token expired. Please reload page." => "Token 过期，请刷新页面。",
"Unknown user" => "未知用户",
"%s enter the database username." => "%s 输入数据库用户名。",
"%s enter the database name." => "%s 输入数据库名称。",
"%s you may not use dots in the database name" => "%s 您不能在数据库名称中使用英文句号。",
"MS SQL username and/or password not valid: %s" => "MS SQL 用户名和/或密码无效：%s",
"You need to enter either an existing account or the administrator." => "你需要输入一个数据库中已有的账户或管理员账户。",
"MySQL/MariaDB username and/or password not valid" => "MySQL/MariaDB 数据库用户名和/或密码无效",
"DB Error: \"%s\"" => "数据库错误：\"%s\"",
"Offending command was: \"%s\"" => "冲突命令为：\"%s\"",
"MySQL/MariaDB user '%s'@'localhost' exists already." => "MySQL/MariaDB 用户 '%s'@'localhost' 已存在。",
"Drop this user from MySQL/MariaDB" => "建议从 MySQL/MariaDB 数据库中删除此用户",
"MySQL/MariaDB user '%s'@'%%' already exists" => "MySQL/MariaDB 用户 '%s'@'%%' 已存在",
"Drop this user from MySQL/MariaDB." => "建议从 MySQL/MariaDB 数据库中删除此用户。",
"Oracle connection could not be established" => "不能建立甲骨文连接",
"Oracle username and/or password not valid" => "Oracle 数据库用户名和/或密码无效",
"Offending command was: \"%s\", name: %s, password: %s" => "冲突命令为：\"%s\"，名称：%s，密码：%s",
"PostgreSQL username and/or password not valid" => "PostgreSQL 数据库用户名和/或密码无效",
"Set an admin username." => "请设置一个管理员用户名。",
"Set an admin password." => "请设置一个管理员密码。",
"Your web server is not yet properly setup to allow files synchronization because the WebDAV interface seems to be broken." => "您的Web服务器尚未正确设置以允许文件同步, 因为WebDAV的接口似乎已损坏.",
"Please double check the <a href='%s'>installation guides</a>." => "请认真检查<a href='%s'>安装指南</a>.",
"%s shared »%s« with you" => "%s 向您分享了 »%s«",
"Sharing %s failed, because the file does not exist" => "共享 %s 失败，因为文件不存在。",
"You are not allowed to share %s" => "您无权分享 %s",
"Sharing %s failed, because the user %s is the item owner" => "共享 %s 失败，因为用户 %s 是对象的拥有者",
"Sharing %s failed, because the user %s does not exist" => "共享 %s 失败，因为用户 %s 不存在",
"Sharing %s failed, because the user %s is not a member of any groups that %s is a member of" => "共享 %s 失败，因为用户 %s 不是 %s 所属的任何组的用户",
"Sharing %s failed, because this item is already shared with %s" => "共享 %s 失败，因为它已经共享给 %s",
"Sharing %s failed, because the group %s does not exist" => "共享 %s 失败，因为 %s 组不存在",
"Sharing %s failed, because %s is not a member of the group %s" => "共享 %s 失败，因为 %s 不是 %s 组的成员",
"Sharing %s failed, because sharing with links is not allowed" => "共享 %s 失败，因为不允许用链接共享",
"Share type %s is not valid for %s" => "%s 不是 %s 的合法共享类型",
"Setting permissions for %s failed, because the permissions exceed permissions granted to %s" => "设置 %s 权限失败，因为权限超出了 %s 已有权限。",
"Setting permissions for %s failed, because the item was not found" => "设置 %s 的权限失败，因为未找到到对应项",
"Sharing backend %s must implement the interface OCP\\Share_Backend" => "共享后端 %s 必须实现 OCP\\Share_Backend 接口",
"Sharing backend %s not found" => "未找到共享后端 %s",
"Sharing backend for %s not found" => "%s 的共享后端未找到",
"Sharing %s failed, because the user %s is the original sharer" => "共享 %s 失败，因为用户 %s 不是原始共享者",
"Sharing %s failed, because the permissions exceed permissions granted to %s" => "共享 %s 失败，因为权限超过了 %s 已有权限",
"Sharing %s failed, because resharing is not allowed" => "共享 %s 失败，因为不允许二次共享",
"Sharing %s failed, because the sharing backend for %s could not find its source" => "共享 %s 失败，因为 %s 使用的共享后端未找到它的来源",
"Sharing %s failed, because the file could not be found in the file cache" => "共享 %s 失败，因为未在文件缓存中找到文件。",
"Could not find category \"%s\"" => "无法找到分类 \"%s\"",
"seconds ago" => "秒前",
"_%n minute ago_::_%n minutes ago_" => array("%n 分钟前"),
"_%n hour ago_::_%n hours ago_" => array("%n 小时前"),
"today" => "今天",
"yesterday" => "昨天",
"_%n day go_::_%n days ago_" => array("%n 天前"),
"last month" => "上月",
"_%n month ago_::_%n months ago_" => array("%n 月前"),
"last year" => "去年",
"years ago" => "年前",
"Only the following characters are allowed in a username: \"a-z\", \"A-Z\", \"0-9\", and \"_.@-\"" => "用户名只允许使用以下字符：“a-z”，“A-Z”，“0-9”，和“_.@-”",
"A valid username must be provided" => "必须提供合法的用户名",
"A valid password must be provided" => "必须提供合法的密码",
"The username is already being used" => "用户名已被使用",
"No database drivers (sqlite, mysql, or postgresql) installed." => "没有安装数据库驱动 (SQLite、MySQL 或 PostgreSQL)。",
"Cannot write into \"config\" directory" => "无法写入“config”目录",
"Cannot write into \"apps\" directory" => "无法写入“apps”目录",
"Cannot create \"data\" directory (%s)" => "无法创建“apps”目录 (%s)",
"Setting locale to %s failed" => "设置语言为 %s 失败",
"Please install one of theses locales on your system and restart your webserver." => "请在您的系统中安装这些语言并重新启动您的网页服务器。",
"Please ask your server administrator to install the module." => "请联系服务器管理员安装模块。",
"PHP module %s not installed." => "PHP %s 模块未安装。",
"PHP %s or higher is required." => "要求 PHP 版本 %s 或者更高。",
"Please ask your server administrator to update PHP to the latest version. Your PHP version is no longer supported by ownCloud and the PHP community." => "请联系服务器管理员升级 PHP 到最新的版本。ownCloud 和 PHP 社区已经不再支持此版本的 PHP。",
"PHP Safe Mode is enabled. ownCloud requires that it is disabled to work properly." => "PHP Safe Mode 已经启用，ownCloud 需要 Safe Mode 停用以正常工作。",
"PHP Safe Mode is a deprecated and mostly useless setting that should be disabled. Please ask your server administrator to disable it in php.ini or in your webserver config." => "PHP Safe Mode 已经被废弃并且应当被停用。请联系服务器管理员在 php.ini 或您的服务器设置中停用 Safe Mode。",
"Magic Quotes is enabled. ownCloud requires that it is disabled to work properly." => "Magic Quotes 已经启用，ownCloud 需要 Magic Quotes 停用以正常工作。",
"Magic Quotes is a deprecated and mostly useless setting that should be disabled. Please ask your server administrator to disable it in php.ini or in your webserver config." => "Magic Quotes 已经被废弃并且应当被停用。请联系服务器管理员在 php.ini 或您的服务器设置中停用 Magic Quotes。",
"PHP modules have been installed, but they are still listed as missing?" => "PHP 模块已经安装，但仍然显示未安装？",
"Please ask your server administrator to restart the web server." => "请联系服务器管理员重启网页服务器。",
"PostgreSQL >= 9 required" => "要求 PostgreSQL >= 9",
"Please upgrade your database version" => "请升级您的数据库版本",
"Error occurred while checking PostgreSQL version" => "检查 PostgreSQL 版本时发生了一个错误",
"Please change the permissions to 0770 so that the directory cannot be listed by other users." => "请更改权限为 0770 以避免其他用户查看目录。",
"Data directory (%s) is readable by other users" => "文件目录 (%s) 可以被其他用户读取",
"Data directory (%s) is invalid" => "文件目录 (%s) 无效",
"Please check that the data directory contains a file \".ocdata\" in its root." => "请确保文件根目录下包含有一个名为“.ocdata”的文件。"
);
$PLURAL_FORMS = "nplurals=1; plural=0;";
