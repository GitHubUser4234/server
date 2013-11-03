<?php
$TRANSLATIONS = array(
"Failed to delete the server configuration" => "შეცდომა სერვერის კონფიგურაციის წაშლისას",
"The configuration is valid and the connection could be established!" => "კონფიგურაცია მართებულია და კავშირი დამყარდება!",
"The configuration is valid, but the Bind failed. Please check the server settings and credentials." => "კონფიგურაცია მართებულია, მაგრამ მიერთება ვერ მოხერხდა. გთხოვთ შეამოწმოთ სერვერის პარამეტრები და აუთენთიკაციის პარამეტრები.",
"Deletion failed" => "წაშლა ვერ განხორციელდა",
"Take over settings from recent server configuration?" => "დაბრუნდებით სერვერის წინა კონფიგურაციაში?",
"Keep settings?" => "დავტოვოთ პარამეტრები?",
"Cannot add server configuration" => "სერვერის პარამეტრების დამატება ვერ მოხერხდა",
"Success" => "დასრულდა",
"Error" => "შეცდომა",
"Select groups" => "ჯგუფების არჩევა",
"Connection test succeeded" => "კავშირის ტესტირება მოხერხდა",
"Connection test failed" => "კავშირის ტესტირება ვერ მოხერხდა",
"Do you really want to delete the current Server Configuration?" => "ნამდვილად გინდათ წაშალოთ სერვერის მიმდინარე პარამეტრები?",
"Confirm Deletion" => "წაშლის დადასტურება",
"_%s group found_::_%s groups found_" => array(""),
"_%s user found_::_%s users found_" => array(""),
"Test Configuration" => "კავშირის ტესტირება",
"Help" => "დახმარება",
"Add Server Configuration" => "სერვერის პარამეტრების დამატება",
"Host" => "ჰოსტი",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "თქვენ შეგიძლიათ გამოტოვოთ პროტოკოლი. გარდა ამისა გჭირდებათ SSL. შემდეგ დაიწყეთ ldaps://",
"Port" => "პორტი",
"User DN" => "მომხმარებლის DN",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "მომხმარებლის DN რომელთანაც უნდა მოხდეს დაკავშირება მოხდება შემდეგნაირად მაგ: uid=agent,dc=example,dc=com. ხოლო ანონიმური დაშვებისთვის, დატოვეთ DN–ის და პაროლის ველები ცარიელი.",
"Password" => "პაროლი",
"For anonymous access, leave DN and Password empty." => "ანონიმური დაშვებისთვის, დატოვეთ DN–ის და პაროლის ველები ცარიელი.",
"One Base DN per line" => "ერთი საწყისი DN ერთ ხაზზე",
"You can specify Base DN for users and groups in the Advanced tab" => "თქვენ შეგიძლიათ მიუთითოთ საწყისი DN მომხმარებლებისთვის და ჯგუფებისთვის Advanced ტაბში",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>გაფრთხილება:</b> PHP LDAP მოდული არ არის ინსტალირებული, ბექენდი არ იმუშავებს. თხოვეთ თქვენს ადმინისტრატორს დააინსტალიროს ის.",
"Connection Settings" => "კავშირის პარამეტრები",
"Configuration Active" => "კონფიგურაცია აქტიურია",
"When unchecked, this configuration will be skipped." => "როცა გადანიშნულია, ეს კონფიგურაცია გამოტოვებული იქნება.",
"User Login Filter" => "მომხმარებლის ფილტრი",
"Backup (Replica) Host" => "ბექაფ  (რეპლიკა)  ჰოსტი",
"Give an optional backup host. It must be a replica of the main LDAP/AD server." => "მიუთითეთ რაიმე ბექაფ ჰოსტი. ის უნდა იყოს ძირითადი LDAP/AD სერვერის რეპლიკა.",
"Backup (Replica) Port" => "ბექაფ (რეპლიკა) პორტი",
"Disable Main Server" => "გამორთეთ ძირითადი სერვერი",
"Case insensitve LDAP server (Windows)" => "LDAP server (Windows)",
"Turn off SSL certificate validation." => "გამორთეთ SSL სერთიფიკატის ვალიდაცია.",
"Cache Time-To-Live" => "ქეშის სიცოცხლის ხანგრძლივობა",
"in seconds. A change empties the cache." => "წამებში. ცვლილება ასუფთავებს ქეშს.",
"Directory Settings" => "დირექტორიის პარამეტრები",
"User Display Name Field" => "მომხმარებლის დისფლეის სახელის ფილდი",
"Base User Tree" => "ძირითად მომხმარებელთა სია",
"One User Base DN per line" => "ერთი მომხმარებლის საწყისი DN ერთ ხაზზე",
"User Search Attributes" => "მომხმარებლის ძებნის ატრიბუტი",
"Optional; one attribute per line" => "ოფციონალური; თითო ატრიბუტი თითო ხაზზე",
"Group Display Name Field" => "ჯგუფის დისფლეის სახელის ფილდი",
"Base Group Tree" => "ძირითად ჯგუფთა სია",
"One Group Base DN per line" => "ერთი ჯგუფის საწყისი DN ერთ ხაზზე",
"Group Search Attributes" => "ჯგუფური ძებნის ატრიბუტი",
"Group-Member association" => "ჯგუფის წევრობის ასოციაცია",
"Special Attributes" => "სპეციალური ატრიბუტები",
"Quota Field" => "ქვოტას ველი",
"Quota Default" => "საწყისი ქვოტა",
"in bytes" => "ბაიტებში",
"Email Field" => "იმეილის ველი",
"User Home Folder Naming Rule" => "მომხმარებლის Home დირექტორიის სახელების დარქმევის წესი",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "დატოვეთ ცარიელი მომხმარებლის სახელი (default). სხვა დანარჩენში მიუთითეთ LDAP/AD ატრიბუტი."
);
$PLURAL_FORMS = "nplurals=1; plural=0;";
