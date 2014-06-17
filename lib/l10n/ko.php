<?php
$TRANSLATIONS = array(
"Help" => "도움말",
"Personal" => "개인",
"Settings" => "설정",
"Users" => "사용자",
"Admin" => "관리자",
"Failed to upgrade \"%s\"." => "\"%s\" 업그레이드에 실패했습니다.",
"No app name specified" => "앱 이름이 지정되지 않았습니다.",
"Unknown filetype" => "알 수 없는 파일 형식",
"Invalid image" => "잘못된 그림",
"web services under your control" => "내가 관리하는 웹 서비스",
"App directory already exists" => "앱 디렉터리가 이미 존재합니다.",
"Can't create app folder. Please fix permissions. %s" => "앱 폴더를 만들 수 없습니다. 권한을 수정하십시오. %s",
"No source specified when installing app" => "앱을 설치할 때 소스가 지정되지 않았습니다.",
"No href specified when installing app from http" => "http에서 앱을 설치할 때 href가 지정되지 않았습니다.",
"No path specified when installing app from local file" => "로컬 파일에서 앱을 설치할 때 경로가 지정되지 않았습니다.",
"Archives of type %s are not supported" => "%s 타입 아카이브는 지원되지 않습니다.",
"Failed to open archive when installing app" => "앱을 설치할 때 아카이브를 열지 못했습니다.",
"App does not provide an info.xml file" => "앱에서 info.xml 파일이 제공되지 않았습니다.",
"App can't be installed because of not allowed code in the App" => "앱에 허용되지 않는 코드가 있어서 앱을 설치할 수 없습니다.",
"App can't be installed because it is not compatible with this version of ownCloud" => "현재 ownCloud 버전과 호환되지 않기 때문에 앱을 설치할 수 없습니다.",
"App can't be installed because it contains the <shipped>true</shipped> tag which is not allowed for non shipped apps" => "출시되지 않은 앱에 허용되지 않는 <shipped>true</shipped> 태그를 포함하고 있기 때문에 앱을 설치할 수 없습니다.",
"App can't be installed because the version in info.xml/version is not the same as the version reported from the app store" => "info.xml/version에 포함된 버전과 앱 스토어에 보고된 버전이 같지 않아서 앱을 설치할 수 없습니다.",
"Application is not enabled" => "앱이 활성화되지 않았습니다",
"Authentication error" => "인증 오류",
"Token expired. Please reload page." => "토큰이 만료되었습니다. 페이지를 새로 고치십시오.",
"Unknown user" => "알려지지 않은 사용자",
"%s enter the database username." => "%s 데이터베이스 사용자 이름을 입력해 주십시오.",
"%s enter the database name." => "%s 데이터베이스 이름을 입력하십시오.",
"%s you may not use dots in the database name" => "%s 데이터베이스 이름에는 마침표를 사용할 수 없습니다",
"MS SQL username and/or password not valid: %s" => "MS SQL 사용자 이름이나 암호가 잘못되었습니다: %s",
"You need to enter either an existing account or the administrator." => "기존 계정이나 administrator(관리자)를 입력해야 합니다.",
"MySQL/MariaDB username and/or password not valid" => "MySQL/MariaDB 사용자 명 혹은 비밀번호가 일치하지 않습니다",
"DB Error: \"%s\"" => "DB 오류: \"%s\"",
"Offending command was: \"%s\"" => "잘못된 명령: \"%s\"",
"MySQL/MariaDB user '%s'@'localhost' exists already." => "MySQL/MariaDB '%s'@'localhost' 사용자가 이미 존재합니다",
"Drop this user from MySQL/MariaDB" => "MySQL/MariaDB에서 이 사용자 제거하기",
"MySQL/MariaDB user '%s'@'%%' already exists" => "MySQL/MariaDB '%s'@'%%' 사용자가 이미 존재합니다",
"Drop this user from MySQL/MariaDB." => "MySQL/MariaDB에서 이 사용자 제거하기",
"Oracle connection could not be established" => "Oracle 연결을 수립할 수 없습니다.",
"Oracle username and/or password not valid" => "Oracle 사용자 이름이나 암호가 잘못되었습니다.",
"Offending command was: \"%s\", name: %s, password: %s" => "잘못된 명령: \"%s\", 이름: %s, 암호: %s",
"PostgreSQL username and/or password not valid" => "PostgreSQL의 사용자 이름 또는 암호가 잘못되었습니다",
"Set an admin username." => "관리자의 사용자 이름을 설정합니다.",
"Set an admin password." => "관리자의 암호를 설정합니다.",
"Your web server is not yet properly setup to allow files synchronization because the WebDAV interface seems to be broken." => "WebDAV 인터페이스가 제대로 작동하지 않습니다. 웹 서버에서 파일 동기화를 사용할 수 있도록 설정이 제대로 되지 않은 것 같습니다.",
"Please double check the <a href='%s'>installation guides</a>." => "<a href='%s'>설치 가이드</a>를 다시 한 번 확인하십시오.",
"%s shared »%s« with you" => "%s 님이 %s을(를) 공유하였습니다",
"Could not find category \"%s\"" => "분류 \"%s\"을(를) 찾을 수 없습니다.",
"seconds ago" => "초 전",
"_%n minute ago_::_%n minutes ago_" => array("%n분 전 "),
"_%n hour ago_::_%n hours ago_" => array("%n시간 전 "),
"today" => "오늘",
"yesterday" => "어제",
"_%n day go_::_%n days ago_" => array("%n일 전 "),
"last month" => "지난 달",
"_%n month ago_::_%n months ago_" => array("%n달 전 "),
"last year" => "작년",
"years ago" => "년 전",
"Only the following characters are allowed in a username: \"a-z\", \"A-Z\", \"0-9\", and \"_.@-\"" => "사용자 명에는 다음과 같은 문자만 사용이 가능합니다: \"a-z\", \"A-Z\", \"0-9\", and \"_.@-\"",
"A valid username must be provided" => "올바른 사용자 이름을 입력해야 함",
"A valid password must be provided" => "올바른 암호를 입력해야 함",
"The username is already being used" => "이 사용자명은 현재 사용중입니다"
);
$PLURAL_FORMS = "nplurals=1; plural=0;";
