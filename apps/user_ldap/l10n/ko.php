<?php $TRANSLATIONS = array(
"Deletion failed" => "삭제 실패",
"Keep settings?" => "설정을 유지합니까?",
"Connection test succeeded" => "연결 시험 성공",
"Connection test failed" => "연결 시험 실패",
"<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behaviour. Please ask your system administrator to disable one of them." => "<b>경고:</b> user_ldap 앱과 user_webdavauth 앱은 호환되지 않습니다. 오동작을 일으킬 수 있으므로, 시스템 관리자에게 요청하여 둘 중 하나만 사용하도록 하십시오.",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>경고:</b> PHP LDAP 모듈이 비활성화되어 있거나 설치되어 있지 않습니다. 백엔드를 사용할 수 없습니다. 시스템 관리자에게 설치를 요청하십시오.",
"Host" => "호스트",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "SSL을 사용하는 경우가 아니라면 프로토콜을 입력하지 않아도 됩니다. SSL을 사용하려면 ldaps://를 입력하십시오.",
"Base DN" => "기본 DN",
"One Base DN per line" => "기본 DN을 한 줄에 하나씩 입력하십시오",
"You can specify Base DN for users and groups in the Advanced tab" => "고급 탭에서 사용자 및 그룹에 대한 기본 DN을 지정할 수 있습니다.",
"User DN" => "사용자 DN",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "바인딩 작업을 수행할 클라이언트 사용자 DN입니다. 예를 들어서 uid=agent,dc=example,dc=com입니다. 익명 접근을 허용하려면 DN과 암호를 비워 두십시오.",
"Password" => "암호",
"For anonymous access, leave DN and Password empty." => "익명 접근을 허용하려면 DN과 암호를 비워 두십시오.",
"User Login Filter" => "사용자 로그인 필터",
"Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action." => "로그인을 시도할 때 적용할 필터입니다. %%uid는 로그인 작업에서의 사용자 이름으로 대체됩니다.",
"use %%uid placeholder, e.g. \"uid=%%uid\"" => "%%uid 자리 비움자를 사용하십시오. 예제: \"uid=%%uid\"\"",
"User List Filter" => "사용자 목록 필터",
"Defines the filter to apply, when retrieving users." => "사용자를 검색할 때 적용할 필터를 정의합니다.",
"without any placeholder, e.g. \"objectClass=person\"." => "자리 비움자를 사용할 수 없습니다. 예제: \"objectClass=person\"",
"Group Filter" => "그룹 필터",
"Defines the filter to apply, when retrieving groups." => "그룹을 검색할 때 적용할 필터를 정의합니다.",
"without any placeholder, e.g. \"objectClass=posixGroup\"." => "자리 비움자를 사용할 수 없습니다. 예제: \"objectClass=posixGroup\"",
"Connection Settings" => "연결 설정",
"Configuration Active" => "구성 활성화",
"Port" => "포트",
"Backup (Replica) Host" => "백업 (복제) 포트",
"Backup (Replica) Port" => "백업 (복제) 포트",
"Disable Main Server" => "주 서버 비활성화",
"Use TLS" => "TLS 사용",
"Case insensitve LDAP server (Windows)" => "서버에서 대소문자를 구분하지 않음 (Windows)",
"Turn off SSL certificate validation." => "SSL 인증서 유효성 검사를 해제합니다.",
"If connection only works with this option, import the LDAP server's SSL certificate in your ownCloud server." => "이 옵션을 사용해야 연결할 수 있는 경우에는 LDAP 서버의 SSL 인증서를 ownCloud로 가져올 수 있습니다.",
"Not recommended, use for testing only." => "추천하지 않음, 테스트로만 사용하십시오.",
"in seconds. A change empties the cache." => "초. 항목 변경 시 캐시가 갱신됩니다.",
"Directory Settings" => "디렉토리 설정",
"User Display Name Field" => "사용자의 표시 이름 필드",
"The LDAP attribute to use to generate the user`s ownCloud name." => "LDAP 속성은 사용자의 ownCloud 이름을 생성하기 위해 사용합니다.",
"Base User Tree" => "기본 사용자 트리",
"One User Base DN per line" => "사용자 DN을 한 줄에 하나씩 입력하십시오",
"User Search Attributes" => "사용자 검색 속성",
"Group Display Name Field" => "그룹의 표시 이름 필드",
"The LDAP attribute to use to generate the groups`s ownCloud name." => "LDAP 속성은 그룹의 ownCloud 이름을 생성하기 위해 사용합니다.",
"Base Group Tree" => "기본 그룹 트리",
"One Group Base DN per line" => "그룹 기본 DN을 한 줄에 하나씩 입력하십시오",
"Group Search Attributes" => "그룹 검색 속성",
"Group-Member association" => "그룹-회원 연결",
"in bytes" => "바이트",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "사용자 이름을 사용하려면 비워 두십시오(기본값). 기타 경우 LDAP/AD 속성을 지정하십시오.",
"Help" => "도움말"
);
