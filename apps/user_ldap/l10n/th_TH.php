<?php
$TRANSLATIONS = array(
"Failed to delete the server configuration" => "การลบการกำหนดค่าเซิร์ฟเวอร์ล้มเหลว",
"The configuration is valid and the connection could be established!" => "การกำหนดค่าถูกต้องและการเชื่อมต่อสามารถเชื่อมต่อได้!",
"The configuration is valid, but the Bind failed. Please check the server settings and credentials." => "การกำหนดค่าถูกต้อง, แต่การผูกข้อมูลล้มเหลว, กรุณาตรวจสอบการตั้งค่าเซิร์ฟเวอร์และข้อมูลการเข้าใช้งาน",
"The configuration is invalid. Please look in the ownCloud log for further details." => "การกำหนดค่าไม่ถูกต้อง กรุณาดูรายละเอียดจากบันทึกการเปลี่ยนแปลงของ ownCloud สำหรับรายละเอียดเพิ่มเติม",
"Deletion failed" => "การลบทิ้งล้มเหลว",
"Keep settings?" => "รักษาการตั้งค่าไว้?",
"Cannot add server configuration" => "ไม่สามารถเพิ่มค่ากำหนดเซิร์ฟเวอร์ได้",
"Success" => "เสร็จสิ้น",
"Error" => "ข้อผิดพลาด",
"Select groups" => "เลือกกลุ่ม",
"Connection test succeeded" => "ทดสอบการเชื่อมต่อสำเร็จ",
"Connection test failed" => "ทดสอบการเชื่อมต่อล้มเหลว",
"Do you really want to delete the current Server Configuration?" => "คุณแน่ใจแล้วหรือว่าต้องการลบการกำหนดค่าเซิร์ฟเวอร์ปัจจุบันทิ้งไป?",
"Confirm Deletion" => "ยืนยันการลบทิ้ง",
"_%s group found_::_%s groups found_" => array(""),
"_%s user found_::_%s users found_" => array(""),
"Help" => "ช่วยเหลือ",
"Add Server Configuration" => "เพิ่มการกำหนดค่าเซิร์ฟเวอร์",
"Host" => "โฮสต์",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "คุณสามารถปล่อยช่องโปรโตคอลเว้นไว้ได้, ยกเว้นกรณีที่คุณต้องการใช้ SSL จากนั้นเริ่มต้นด้วย ldaps://",
"Port" => "พอร์ต",
"User DN" => "DN ของผู้ใช้งาน",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "DN ของผู้ใช้งานที่เป็นลูกค้าอะไรก็ตามที่ผูกอยู่ด้วย เช่น uid=agent, dc=example, dc=com, สำหรับการเข้าถึงโดยบุคคลนิรนาม, ให้เว้นว่าง DN และ รหัสผ่านเอาไว้",
"Password" => "รหัสผ่าน",
"For anonymous access, leave DN and Password empty." => "สำหรับการเข้าถึงโดยบุคคลนิรนาม ให้เว้นว่าง DN และรหัสผ่านไว้",
"One Base DN per line" => "หนึ่ง Base DN ต่อบรรทัด",
"You can specify Base DN for users and groups in the Advanced tab" => "คุณสามารถระบุ DN หลักสำหรับผู้ใช้งานและกลุ่มต่างๆในแท็บขั้นสูงได้",
"Back" => "ย้อนกลับ",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>คำเตือน:</b> โมดูล PHP LDAP ยังไม่ได้ถูกติดตั้ง, ระบบด้านหลังจะไม่สามารถทำงานได้ กรุณาติดต่อผู้ดูแลระบบของคุณเพื่อทำการติดตั้งโมดูลดังกล่าว",
"Connection Settings" => "ตั้งค่าการเชื่อมต่อ",
"User Login Filter" => "ตัวกรองข้อมูลการเข้าสู่ระบบของผู้ใช้งาน",
"Disable Main Server" => "ปิดใช้งานเซิร์ฟเวอร์หลัก",
"Case insensitve LDAP server (Windows)" => "เซิร์ฟเวอร์ LDAP ประเภท Case insensitive (วินโดวส์)",
"Turn off SSL certificate validation." => "ปิดใช้งานการตรวจสอบความถูกต้องของใบรับรองความปลอดภัย SSL",
"in seconds. A change empties the cache." => "ในอีกไม่กี่วินาที ระบบจะเปลี่ยนแปลงข้อมูลในแคชให้ว่างเปล่า",
"Directory Settings" => "ตั้งค่าไดเร็กทอรี่",
"User Display Name Field" => "ช่องแสดงชื่อผู้ใช้งานที่ต้องการ",
"Base User Tree" => "รายการผู้ใช้งานหลักแบบ Tree",
"One User Base DN per line" => "หนึ่ง User Base DN ต่อบรรทัด",
"User Search Attributes" => "คุณลักษณะการค้นหาชื่อผู้ใช้",
"Optional; one attribute per line" => "ตัวเลือกเพิ่มเติม; หนึ่งคุณลักษณะต่อบรรทัด",
"Group Display Name Field" => "ช่องแสดงชื่อกลุ่มที่ต้องการ",
"Base Group Tree" => "รายการกลุ่มหลักแบบ Tree",
"One Group Base DN per line" => "หนึ่ง Group Base DN ต่อบรรทัด",
"Group Search Attributes" => "คุณลักษณะการค้นหาแบบกลุ่ม",
"Group-Member association" => "ความสัมพันธ์ของสมาชิกในกลุ่ม",
"Special Attributes" => "คุณลักษณะพิเศษ",
"in bytes" => "ในหน่วยไบต์",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "เว้นว่างไว้สำหรับ ชื่อผู้ใช้ (ค่าเริ่มต้น) หรือไม่กรุณาระบุคุณลักษณะของ LDAP/AD"
);
$PLURAL_FORMS = "nplurals=1; plural=0;";
