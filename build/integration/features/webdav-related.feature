Feature: webdav-related
	Background:
		Given using api version "1"

	Scenario: moving a file old way
		Given using dav path "remote.php/webdav"
		And As an "admin"
		And user "user0" exists
		When User "user0" moves file "/textfile0.txt" to "/FOLDER/textfile0.txt"
		Then the HTTP status code should be "201"

	Scenario: download a file with range
		Given using dav path "remote.php/webdav"
		And As an "admin"
		When Downloading file "/welcome.txt" with range "bytes=51-77"
		Then Downloaded content should be "example file for developers"

	Scenario: Upload forbidden if quota is 0
		Given using dav path "remote.php/webdav"
		And As an "admin"
		And user "user0" exists
		And user "user0" has a quota of "0"
		When User "user0" uploads file "data/textfile.txt" to "/asdf.txt"
		Then the HTTP status code should be "507"

	Scenario: Retrieving folder quota when no quota is set
		Given using dav path "remote.php/webdav"
		And As an "admin"
		And user "user0" exists
		When user "user0" has unlimited quota
		Then as "user0" gets properties of folder "/" with
		  |{DAV:}quota-available-bytes|
		And the single response should contain a property "{DAV:}quota-available-bytes" with value "-3"

	Scenario: Retrieving folder quota when quota is set
		Given using dav path "remote.php/webdav"
		And As an "admin"
		And user "user0" exists
		When user "user0" has a quota of "10 MB"
		Then as "user0" gets properties of folder "/" with
		  |{DAV:}quota-available-bytes|
		And the single response should contain a property "{DAV:}quota-available-bytes" with value "10485429"

	Scenario: Retrieving folder quota of shared folder with quota when no quota is set for recipient
		Given using dav path "remote.php/webdav"
		And As an "admin"
		And user "user0" exists
		And user "user1" exists
		And user "user0" has unlimited quota
		And user "user1" has a quota of "10 MB"
		And As an "user1"
		And user "user1" created a folder "/testquota"
		And as "user1" creating a share with
		  | path | testquota |
		  | shareType | 0 |
		  | permissions | 31 |
		  | shareWith | user0 |
		Then as "user0" gets properties of folder "/testquota" with
		  |{DAV:}quota-available-bytes|
		And the single response should contain a property "{DAV:}quota-available-bytes" with value "10485429"

	Scenario: download a public shared file with range
		Given user "user0" exists
		And As an "user0"
		When creating a share with
			| path | welcome.txt |
			| shareType | 3 |
		And Downloading last public shared file with range "bytes=51-77"
		Then Downloaded content should be "example file for developers"

	Scenario: Downloading a file on the old endpoint should serve security headers
		Given using dav path "remote.php/webdav"
		And As an "admin"
		When Downloading file "/welcome.txt"
		Then The following headers should be set
			|Content-Disposition|attachment|
			|Content-Security-Policy|default-src 'self'; script-src 'self' 'unsafe-eval'; style-src 'self' 'unsafe-inline'; frame-src *; img-src * data: blob:; font-src 'self' data:; media-src *; connect-src *|
			|X-Content-Type-Options |nosniff|
			|X-Download-Options|noopen|
			|X-Frame-Options|Sameorigin|
			|X-Permitted-Cross-Domain-Policies|none|
			|X-Robots-Tag|none|
			|X-XSS-Protection|1; mode=block|
		And Downloaded content should start with "Welcome to your ownCloud account!"

	Scenario: Downloading a file on the new endpoint should serve security headers
		Given using dav path "remote.php/dav/files/admin/"
		And As an "admin"
		When Downloading file "/welcome.txt"
		Then The following headers should be set
			|Content-Disposition|attachment|
			|Content-Security-Policy|default-src 'self'; script-src 'self' 'unsafe-eval'; style-src 'self' 'unsafe-inline'; frame-src *; img-src * data: blob:; font-src 'self' data:; media-src *; connect-src *|
			|X-Content-Type-Options |nosniff|
			|X-Download-Options|noopen|
			|X-Frame-Options|Sameorigin|
			|X-Permitted-Cross-Domain-Policies|none|
			|X-Robots-Tag|none|
			|X-XSS-Protection|1; mode=block|
		And Downloaded content should start with "Welcome to your ownCloud account!"

	Scenario: Doing a GET with a web login should work without CSRF token on the new backend
		Given Logging in using web as "admin"
		When Sending a "GET" to "/remote.php/dav/files/admin/welcome.txt" without requesttoken
		Then Downloaded content should start with "Welcome to your ownCloud account!"
		Then the HTTP status code should be "200"

	Scenario: Doing a GET with a web login should work with CSRF token on the new backend
		Given Logging in using web as "admin"
		When Sending a "GET" to "/remote.php/dav/files/admin/welcome.txt" with requesttoken
		Then Downloaded content should start with "Welcome to your ownCloud account!"
		Then the HTTP status code should be "200"

	Scenario: Doing a PROPFIND with a web login should not work without CSRF token on the new backend
		Given Logging in using web as "admin"
		When Sending a "PROPFIND" to "/remote.php/dav/files/admin/welcome.txt" without requesttoken
		Then the HTTP status code should be "401"

	Scenario: Doing a PROPFIND with a web login should work with CSRF token on the new backend
		Given Logging in using web as "admin"
		When Sending a "PROPFIND" to "/remote.php/dav/files/admin/welcome.txt" with requesttoken
		Then the HTTP status code should be "207"

	Scenario: Doing a GET with a web login should work without CSRF token on the old backend
		Given Logging in using web as "admin"
		When Sending a "GET" to "/remote.php/webdav/welcome.txt" without requesttoken
		Then Downloaded content should start with "Welcome to your ownCloud account!"
		Then the HTTP status code should be "200"

	Scenario: Doing a GET with a web login should work with CSRF token on the old backend
		Given Logging in using web as "admin"
		When Sending a "GET" to "/remote.php/webdav/welcome.txt" with requesttoken
		Then Downloaded content should start with "Welcome to your ownCloud account!"
		Then the HTTP status code should be "200"

	Scenario: Doing a PROPFIND with a web login should not work without CSRF token on the old backend
		Given Logging in using web as "admin"
		When Sending a "PROPFIND" to "/remote.php/webdav/welcome.txt" without requesttoken
		Then the HTTP status code should be "401"

	Scenario: Doing a PROPFIND with a web login should work with CSRF token on the old backend
		Given Logging in using web as "admin"
		When Sending a "PROPFIND" to "/remote.php/webdav/welcome.txt" with requesttoken
		Then the HTTP status code should be "207"
