<?php
$TRANSLATIONS = array(
"Failed to clear the mappings." => "清除映射失败。",
"Failed to delete the server configuration" => "未能删除服务器配置",
"The configuration is valid and the connection could be established!" => "配置有效，能够建立连接！",
"The configuration is valid, but the Bind failed. Please check the server settings and credentials." => "配置有效但绑定失败。请检查服务器设置和认证信息。",
"Deletion failed" => "删除失败",
"Take over settings from recent server configuration?" => "从近期的服务器配置中导入设置？",
"Keep settings?" => "保留设置吗？",
"Cannot add server configuration" => "无法增加服务器配置",
"mappings cleared" => "清除映射",
"Success" => "成功",
"Error" => "错误",
"Select groups" => "选择分组",
"Connection test succeeded" => "连接测试成功",
"Connection test failed" => "连接测试失败",
"Do you really want to delete the current Server Configuration?" => "您真的想要删除当前服务器配置吗？",
"Confirm Deletion" => "确认删除",
"_%s group found_::_%s groups found_" => array(""),
"_%s user found_::_%s users found_" => array(""),
"Invalid Host" => "无效的主机",
"Group Filter" => "组过滤",
"Save" => "保存",
"Test Configuration" => "测试配置",
"Help" => "帮助",
"groups found" => "找到组",
"Add Server Configuration" => "增加服务器配置",
"Host" => "主机",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "可以忽略协议，但如要使用SSL，则需以ldaps://开头",
"Port" => "端口",
"User DN" => "User DN",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "客户端使用的DN必须与绑定的相同，比如uid=agent,dc=example,dc=com\n如需匿名访问，将DN和密码保留为空",
"Password" => "密码",
"For anonymous access, leave DN and Password empty." => "启用匿名访问，将DN和密码保留为空",
"One Base DN per line" => "每行一个基本判别名",
"You can specify Base DN for users and groups in the Advanced tab" => "您可以在高级选项卡里为用户和组指定Base DN",
"users found" => "找到用户",
"Back" => "返回",
"Continue" => "继续",
"Advanced" => "高级",
"<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." => "<b>警告：</b> 应用 user_ldap 和 user_webdavauth 之间不兼容。您可能遭遇未预料的行为。请让系统管理员禁用其中一个。",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>警告：</b> PHP LDAP 模块未安装，后端将无法工作。请请求您的系统管理员安装该模块。",
"Connection Settings" => "连接设置",
"Configuration Active" => "现行配置",
"When unchecked, this configuration will be skipped." => "当反选后，此配置将被忽略。",
"Backup (Replica) Host" => "备份 (镜像) 主机",
"Give an optional backup host. It must be a replica of the main LDAP/AD server." => "给出一个可选的备份主机。它必须为主 LDAP/AD 服务器的一个镜像。",
"Backup (Replica) Port" => "备份 (镜像) 端口",
"Disable Main Server" => "禁用主服务器",
"Only connect to the replica server." => "只能连接到复制服务器",
"Turn off SSL certificate validation." => "关闭SSL证书验证",
"Cache Time-To-Live" => "缓存存活时间",
"in seconds. A change empties the cache." => "以秒计。修改将清空缓存。",
"Directory Settings" => "目录设置",
"User Display Name Field" => "用户显示名称字段",
"The LDAP attribute to use to generate the user's display name." => "用来生成用户的显示名称的 LDAP 属性。",
"Base User Tree" => "基础用户树",
"One User Base DN per line" => "每行一个用户基准判别名",
"User Search Attributes" => "用户搜索属性",
"Optional; one attribute per line" => "可选;每行一个属性",
"Group Display Name Field" => "组显示名称字段",
"The LDAP attribute to use to generate the groups's display name." => "用来生成组的显示名称的 LDAP 属性。",
"Base Group Tree" => "基础组树",
"One Group Base DN per line" => "每行一个群组基准判别名",
"Group Search Attributes" => "群组搜索属性",
"Group-Member association" => "组成员关联",
"Special Attributes" => "特殊属性",
"Quota Field" => "配额字段",
"Quota Default" => "默认配额",
"in bytes" => "字节数",
"Email Field" => "电邮字段",
"User Home Folder Naming Rule" => "用户主目录命名规则",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "指定一个 LDAP/AD 属性。留空，则使用用户名称（默认）。",
"Internal Username" => "内部用户名",
"By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder. It is also a part of remote URLs, for instance for all *DAV services. With this setting, the default behavior can be overridden. To achieve a similar behavior as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users." => "默认情况下，内部用户名具有唯一识别属性，以确保用户名唯一，且字符不用经过转换。内部用户名有严格的字符限制，只允许使用 [ a-zA-Z0-9_.@- ]。其他字符会被 ASCII 码取代，或者被忽略。当出现冲突时，用户名后会增加或者减少一个数字。内部用户名用于内部用户识别，同时也作为 ownCloud 中用户根文件夹的默认名。其也作为远程 URLs 的一部分，如在所有的 *DAV 服务中。在这种设置下，默认行为可以被覆盖。要实现在 ownCloud 5 之前的类似的效果，在下框中输入用户的显示名称属性。如果留空，则执行默认操作。更改只影响新映射 (或增加) 的 LDAP 用户。",
"Internal Username Attribute:" => "内部用户名属性：",
"Override UUID detection" => "超越UUID检测",
"By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." => "ownCloud 默认会自动检测 UUID 属性。UUID 属性用来无误地识别 LDAP 用户和组。同时，如果上面没有特别设置，内部用户名也基于 UUID 创建。也可以覆盖设置，直接指定一个属性。但一定要确保指定的属性取得的用户和组是唯一的。留空，则执行默认操作。更改只影响新映射 (或增加) 的 LDAP 用户和组。",
"Username-LDAP User Mapping" => "用户名-LDAP用户映射",
"Usernames are used to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have a internal username. This requires a mapping from username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found. The internal username is used all over. Clearing the mappings will have leftovers everywhere. Clearing the mappings is not configuration sensitive, it affects all LDAP configurations! Never clear the mappings in a production environment, only in a testing or experimental stage." => "用户名用于存储和分配数据 (元)。为了准确地识别和确认用户，每个用户都有一个内部用户名。这需要一个 ownCloud 用户名到 LDAP 用户的映射。创建的用户名被映射到 LDAP 用户的 UUID。此外，DN 也会被缓存，以减少 LDAP 连接，但它不用于识别。DN 的变化会被监视到。内部用户名会被用于所有地方。清除映射将导致一片混乱。清除映射不是常用的设置，它会影响到所有的 LDAP 配置！千万不要在正式环境中清除映射，只有在测试或试验时才这样做。",
"Clear Username-LDAP User Mapping" => "清除用户-LDAP用户映射",
"Clear Groupname-LDAP Group Mapping" => "清除组用户-LDAP级映射"
);
$PLURAL_FORMS = "nplurals=1; plural=0;";
