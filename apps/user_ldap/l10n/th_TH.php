<?php $TRANSLATIONS = array(
"Deletion failed" => "การลบทิ้งล้มเหลว",
"<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behaviour. Please ask your system administrator to disable one of them." => "<b>คำเตือน:</b> แอปฯ user_ldap และ user_webdavauth ไม่สามารถใช้งานร่วมกันได้. คุณอาจประสพปัญหาที่ไม่คาดคิดจากเหตุการณ์ดังกล่าว กรุณาติดต่อผู้ดูแลระบบของคุณเพื่อระงับการใช้งานแอปฯ ตัวใดตัวหนึ่งข้างต้น",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>คำเตือน:</b> โมดูล PHP LDAP ยังไม่ได้ถูกติดตั้ง, ระบบด้านหลังจะไม่สามารถทำงานได้ กรุณาติดต่อผู้ดูแลระบบของคุณเพื่อทำการติดตั้งโมดูลดังกล่าว",
"Host" => "โฮสต์",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "คุณสามารถปล่อยช่องโปรโตคอลเว้นไว้ได้, ยกเว้นกรณีที่คุณต้องการใช้ SSL จากนั้นเริ่มต้นด้วย ldaps://",
"Base DN" => "DN ฐาน",
"One Base DN per line" => "หนึ่ง Base DN ต่อบรรทัด",
"You can specify Base DN for users and groups in the Advanced tab" => "คุณสามารถระบุ DN หลักสำหรับผู้ใช้งานและกลุ่มต่างๆในแท็บขั้นสูงได้",
"User DN" => "DN ของผู้ใช้งาน",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "DN ของผู้ใช้งานที่เป็นลูกค้าอะไรก็ตามที่ผูกอยู่ด้วย เช่น uid=agent, dc=example, dc=com, สำหรับการเข้าถึงโดยบุคคลนิรนาม, ให้เว้นว่าง DN และ รหัสผ่านเอาไว้",
"Password" => "รหัสผ่าน",
"For anonymous access, leave DN and Password empty." => "สำหรับการเข้าถึงโดยบุคคลนิรนาม ให้เว้นว่าง DN และรหัสผ่านไว้",
"User Login Filter" => "ตัวกรองข้อมูลการเข้าสู่ระบบของผู้ใช้งาน",
"Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action." => "กำหนดตัวกรองข้อมูลที่ต้องการนำไปใช้งาน, เมื่อมีความพยายามในการเข้าสู่ระบบ %%uid จะถูกนำไปแทนที่ชื่อผู้ใช้งานในการกระทำของการเข้าสู่ระบบ",
"use %%uid placeholder, e.g. \"uid=%%uid\"" => "ใช้ตัวยึด %%uid, เช่น \"uid=%%uid\"",
"User List Filter" => "ตัวกรองข้อมูลรายชื่อผู้ใช้งาน",
"Defines the filter to apply, when retrieving users." => "ระบุตัวกรองข้อมูลที่ต้องการนำไปใช้งาน, เมื่อดึงข้อมูลผู้ใช้งาน",
"without any placeholder, e.g. \"objectClass=person\"." => "โดยไม่ต้องมีตัวยึดใดๆ, เช่น \"objectClass=person\",",
"Group Filter" => "ตัวกรองข้อมูลกลุ่ม",
"Defines the filter to apply, when retrieving groups." => "ระบุตัวกรองข้อมูลที่ต้องการนำไปใช้งาน, เมื่อดึงข้อมูลกลุ่ม",
"without any placeholder, e.g. \"objectClass=posixGroup\"." => "โดยไม่ต้องมีตัวยึดใดๆ, เช่น \"objectClass=posixGroup\",",
"Port" => "พอร์ต",
"Use TLS" => "ใช้ TLS",
"Do not use it for SSL connections, it will fail." => "กรุณาอย่าใช้การเชื่อมต่อแบบ SSL การเชื่อมต่อจะเกิดการล้มเหลว",
"Case insensitve LDAP server (Windows)" => "เซิร์ฟเวอร์ LDAP ประเภท Case insensitive (วินโดวส์)",
"Turn off SSL certificate validation." => "ปิดใช้งานการตรวจสอบความถูกต้องของใบรับรองความปลอดภัย SSL",
"If connection only works with this option, import the LDAP server's SSL certificate in your ownCloud server." => "หากการเชื่อมต่อสามารถทำงานได้เฉพาะกับตัวเลือกนี้เท่านั้น, ให้นำเข้าข้อมูลใบรับรองความปลอดภัยแบบ SSL ของเซิร์ฟเวอร์ LDAP ดังกล่าวเข้าไปไว้ในเซิร์ฟเวอร์ ownCloud",
"Not recommended, use for testing only." => "ไม่แนะนำให้ใช้งาน, ใช้สำหรับการทดสอบเท่านั้น",
"in seconds. A change empties the cache." => "ในอีกไม่กี่วินาที ระบบจะเปลี่ยนแปลงข้อมูลในแคชให้ว่างเปล่า",
"User Display Name Field" => "ช่องแสดงชื่อผู้ใช้งานที่ต้องการ",
"The LDAP attribute to use to generate the user`s ownCloud name." => "คุณลักษณะ LDAP ที่ต้องการใช้สำหรับสร้างชื่อของผู้ใช้งาน ownCloud",
"Base User Tree" => "รายการผู้ใช้งานหลักแบบ Tree",
"One User Base DN per line" => "หนึ่ง User Base DN ต่อบรรทัด",
"Group Display Name Field" => "ช่องแสดงชื่อกลุ่มที่ต้องการ",
"The LDAP attribute to use to generate the groups`s ownCloud name." => "คุณลักษณะ LDAP ที่ต้องการใช้สร้างชื่อกลุ่มของ ownCloud",
"Base Group Tree" => "รายการกลุ่มหลักแบบ Tree",
"One Group Base DN per line" => "หนึ่ง Group Base DN ต่อบรรทัด",
"Group-Member association" => "ความสัมพันธ์ของสมาชิกในกลุ่ม",
"in bytes" => "ในหน่วยไบต์",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "เว้นว่างไว้สำหรับ ชื่อผู้ใช้ (ค่าเริ่มต้น) หรือไม่กรุณาระบุคุณลักษณะของ LDAP/AD",
"Help" => "ช่วยเหลือ"
);
