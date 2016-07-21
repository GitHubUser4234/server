<?php
/**

 *
 * @author Joas Schilling <coding@schilljs.com>
 * @author Morris Jobke <hey@morrisjobke.de>
 * @author Roeland Jago Douma <roeland@famdouma.nl>
 * @author Sergio Bertolin <sbertolin@solidgear.es>
 * @author Sergio Bertolín <sbertolin@solidgear.es>
 * @author Thomas Müller <thomas.mueller@tmit.eu>
 * @author Vincent Petry <pvince81@owncloud.com>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
use GuzzleHttp\Client;
use GuzzleHttp\Message\ResponseInterface;

require __DIR__ . '/../../vendor/autoload.php';

trait Provisioning {
	use BasicStructure;

	/** @var array */
	private $createdUsers = [];

	/** @var array */
	private $createdRemoteUsers = [];

	/** @var array */
	private $createdRemoteGroups = [];
	
	/** @var array */
	private $createdGroups = [];

	/**
	 * @Given /^user "([^"]*)" exists$/
	 * @param string $user
	 */
	public function assureUserExists($user) {
		try {
			$this->userExists($user);
		} catch (\GuzzleHttp\Exception\ClientException $ex) {
			$previous_user = $this->currentUser;
			$this->currentUser = "admin";
			$this->creatingTheUser($user);
			$this->currentUser = $previous_user;
		}
		$this->userExists($user);
		PHPUnit_Framework_Assert::assertEquals(200, $this->response->getStatusCode());
	}

	/**
	 * @Given /^user "([^"]*)" does not exist$/
	 * @param string $user
	 */
	public function userDoesNotExist($user) {
		try {
			$this->userExists($user);
		} catch (\GuzzleHttp\Exception\ClientException $ex) {
			$this->response = $ex->getResponse();
			PHPUnit_Framework_Assert::assertEquals(404, $ex->getResponse()->getStatusCode());
			return;
		}
		$previous_user = $this->currentUser;
		$this->currentUser = "admin";
		$this->deletingTheUser($user);
		$this->currentUser = $previous_user;
		try {
			$this->userExists($user);
		} catch (\GuzzleHttp\Exception\ClientException $ex) {
			$this->response = $ex->getResponse();
			PHPUnit_Framework_Assert::assertEquals(404, $ex->getResponse()->getStatusCode());
		}
	}

	public function creatingTheUser($user) {
		$fullUrl = $this->baseUrl . "v{$this->apiVersion}.php/cloud/users";
		$client = new Client();
		$options = [];
		if ($this->currentUser === 'admin') {
			$options['auth'] = $this->adminUser;
		}

		$options['body'] = [
							'userid' => $user,
							'password' => '123456'
							];

		$this->response = $client->send($client->createRequest("POST", $fullUrl, $options));
		if ($this->currentServer === 'LOCAL'){
			$this->createdUsers[$user] = $user;
		} elseif ($this->currentServer === 'REMOTE') {
			$this->createdRemoteUsers[$user] = $user;
		}

		//Quick hack to login once with the current user
		$options2 = [
			'auth' => [$user, '123456'],
		];
		$url = $fullUrl.'/'.$user;
		$client->send($client->createRequest('GET', $url, $options2));
	}

	public function createUser($user) {
		$previous_user = $this->currentUser;
		$this->currentUser = "admin";
		$this->creatingTheUser($user);
		$this->userExists($user);
		$this->currentUser = $previous_user;
	}

	public function deleteUser($user) {
		$previous_user = $this->currentUser;
		$this->currentUser = "admin";
		$this->deletingTheUser($user);
		$this->userDoesNotExist($user);
		$this->currentUser = $previous_user;
	}

	public function createGroup($group) {
		$previous_user = $this->currentUser;
		$this->currentUser = "admin";
		$this->creatingTheGroup($group);
		$this->groupExists($group);
		$this->currentUser = $previous_user;
	}

	public function deleteGroup($group) {
		$previous_user = $this->currentUser;
		$this->currentUser = "admin";
		$this->deletingTheGroup($group);
		$this->groupDoesNotExist($group);
		$this->currentUser = $previous_user;
	}

	public function userExists($user){
		$fullUrl = $this->baseUrl . "v2.php/cloud/users/$user";
		$client = new Client();
		$options = [];
		$options['auth'] = $this->adminUser;

		$this->response = $client->get($fullUrl, $options);
	}

	/**
	 * @Then /^check that user "([^"]*)" belongs to group "([^"]*)"$/
	 * @param string $user
	 * @param string $group
	 */
	public function checkThatUserBelongsToGroup($user, $group) {
		$fullUrl = $this->baseUrl . "v2.php/cloud/users/$user/groups";
		$client = new Client();
		$options = [];
		if ($this->currentUser === 'admin') {
			$options['auth'] = $this->adminUser;
		}

		$this->response = $client->get($fullUrl, $options);
		$respondedArray = $this->getArrayOfGroupsResponded($this->response);
		sort($respondedArray);
		PHPUnit_Framework_Assert::assertContains($group, $respondedArray);
		PHPUnit_Framework_Assert::assertEquals(200, $this->response->getStatusCode());
	}

	public function userBelongsToGroup($user, $group) {
		$fullUrl = $this->baseUrl . "v2.php/cloud/users/$user/groups";
		$client = new Client();
		$options = [];
		if ($this->currentUser === 'admin') {
			$options['auth'] = $this->adminUser;
		}

		$this->response = $client->get($fullUrl, $options);
		$respondedArray = $this->getArrayOfGroupsResponded($this->response);

		if (array_key_exists($group, $respondedArray)) {
			return True;
		} else{
			return False;
		}
	}

	/**
	 * @Given /^user "([^"]*)" belongs to group "([^"]*)"$/
	 * @param string $user
	 * @param string $group
	 */
	public function assureUserBelongsToGroup($user, $group){
		$previous_user = $this->currentUser;
		$this->currentUser = "admin";

		if (!$this->userBelongsToGroup($user, $group)){
			$this->addingUserToGroup($user, $group);
		}

		$this->checkThatUserBelongsToGroup($user, $group);
		$this->currentUser = $previous_user;
	}

	/**
	 * @Given /^user "([^"]*)" does not belong to group "([^"]*)"$/
	 * @param string $user
	 * @param string $group
	 */
	public function userDoesNotBelongToGroup($user, $group) {
		$fullUrl = $this->baseUrl . "v2.php/cloud/users/$user/groups";
		$client = new Client();
		$options = [];
		if ($this->currentUser === 'admin') {
			$options['auth'] = $this->adminUser;
		}

		$this->response = $client->get($fullUrl, $options);
		$groups = array($group);
		$respondedArray = $this->getArrayOfGroupsResponded($this->response);
		PHPUnit_Framework_Assert::assertNotEquals($groups, $respondedArray, "", 0.0, 10, true);
		PHPUnit_Framework_Assert::assertEquals(200, $this->response->getStatusCode());
	}

	/**
	 * @When /^creating the group "([^"]*)"$/
	 * @param string $group
	 */
	public function creatingTheGroup($group) {
		$fullUrl = $this->baseUrl . "v{$this->apiVersion}.php/cloud/groups";
		$client = new Client();
		$options = [];
		if ($this->currentUser === 'admin') {
			$options['auth'] = $this->adminUser;
		}

		$options['body'] = [
							'groupid' => $group,
							];

		$this->response = $client->send($client->createRequest("POST", $fullUrl, $options));
		if ($this->currentServer === 'LOCAL'){
			$this->createdGroups[$group] = $group;
		} elseif ($this->currentServer === 'REMOTE') {
			$this->createdRemoteGroups[$group] = $group;
		}
	}

	/**
	 * @When /^assure user "([^"]*)" is disabled$/
	 */
	public function assureUserIsDisabled($user) {
		$fullUrl = $this->baseUrl . "v{$this->apiVersion}.php/cloud/users/$user/disable";
		$client = new Client();
		$options = [];
		if ($this->currentUser === 'admin') {
			$options['auth'] = $this->adminUser;
		}

		$this->response = $client->send($client->createRequest("PUT", $fullUrl, $options));
	}

	/**
	 * @When /^Deleting the user "([^"]*)"$/
	 * @param string $user
	 */
	public function deletingTheUser($user) {
		$fullUrl = $this->baseUrl . "v{$this->apiVersion}.php/cloud/users/$user";
		$client = new Client();
		$options = [];
		if ($this->currentUser === 'admin') {
			$options['auth'] = $this->adminUser;
		}

		$this->response = $client->send($client->createRequest("DELETE", $fullUrl, $options));
	}

	/**
	 * @When /^Deleting the group "([^"]*)"$/
	 * @param string $group
	 */
	public function deletingTheGroup($group) {
		$fullUrl = $this->baseUrl . "v{$this->apiVersion}.php/cloud/groups/$group";
		$client = new Client();
		$options = [];
		if ($this->currentUser === 'admin') {
			$options['auth'] = $this->adminUser;
		}

		$this->response = $client->send($client->createRequest("DELETE", $fullUrl, $options));
	}

	/**
	 * @Given /^Add user "([^"]*)" to the group "([^"]*)"$/
	 * @param string $user
	 * @param string $group
	 */
	public function addUserToGroup($user, $group) {
		$this->userExists($user);
		$this->groupExists($group);
		$this->addingUserToGroup($user, $group);

	}

	/**
	 * @When /^User "([^"]*)" is added to the group "([^"]*)"$/
	 * @param string $user
	 * @param string $group
	 */
	public function addingUserToGroup($user, $group) {
		$fullUrl = $this->baseUrl . "v{$this->apiVersion}.php/cloud/users/$user/groups";
		$client = new Client();
		$options = [];
		if ($this->currentUser === 'admin') {
			$options['auth'] = $this->adminUser;
		}

		$options['body'] = [
							'groupid' => $group,
							];

		$this->response = $client->send($client->createRequest("POST", $fullUrl, $options));
	}


	public function groupExists($group) {
		$fullUrl = $this->baseUrl . "v2.php/cloud/groups/$group";
		$client = new Client();
		$options = [];
		$options['auth'] = $this->adminUser;

		$this->response = $client->get($fullUrl, $options);
	}

	/**
	 * @Given /^group "([^"]*)" exists$/
	 * @param string $group
	 */
	public function assureGroupExists($group) {
		try {
			$this->groupExists($group);
		} catch (\GuzzleHttp\Exception\ClientException $ex) {
			$previous_user = $this->currentUser;
			$this->currentUser = "admin";
			$this->creatingTheGroup($group);
			$this->currentUser = $previous_user;
		}
		$this->groupExists($group);
		PHPUnit_Framework_Assert::assertEquals(200, $this->response->getStatusCode());
	}

	/**
	 * @Given /^group "([^"]*)" does not exist$/
	 * @param string $group
	 */
	public function groupDoesNotExist($group) {
		try {
			$this->groupExists($group);
		} catch (\GuzzleHttp\Exception\ClientException $ex) {
			$this->response = $ex->getResponse();
			PHPUnit_Framework_Assert::assertEquals(404, $ex->getResponse()->getStatusCode());
			return;
		}
		$previous_user = $this->currentUser;
		$this->currentUser = "admin";
		$this->deletingTheGroup($group);
		$this->currentUser = $previous_user;
		try {
			$this->groupExists($group);
		} catch (\GuzzleHttp\Exception\ClientException $ex) {
			$this->response = $ex->getResponse();
			PHPUnit_Framework_Assert::assertEquals(404, $ex->getResponse()->getStatusCode());
		}
	}

	/**
	 * @Given /^user "([^"]*)" is subadmin of group "([^"]*)"$/
	 * @param string $user
	 * @param string $group
	 */
	public function userIsSubadminOfGroup($user, $group) {
		$fullUrl = $this->baseUrl . "v2.php/cloud/groups/$group/subadmins";
		$client = new Client();
		$options = [];
		if ($this->currentUser === 'admin') {
			$options['auth'] = $this->adminUser;
		}

		$this->response = $client->get($fullUrl, $options);
		$respondedArray = $this->getArrayOfSubadminsResponded($this->response);
		sort($respondedArray);
		PHPUnit_Framework_Assert::assertContains($user, $respondedArray);
		PHPUnit_Framework_Assert::assertEquals(200, $this->response->getStatusCode());
	}

	/**
	 * @Given /^Assure user "([^"]*)" is subadmin of group "([^"]*)"$/
	 * @param string $user
	 * @param string $group
	 */
	public function assureUserIsSubadminOfGroup($user, $group) {
		$fullUrl = $this->baseUrl . "v{$this->apiVersion}.php/cloud/users/$user/subadmins";
		$client = new Client();
		$options = [];
		if ($this->currentUser === 'admin') {
			$options['auth'] = $this->adminUser;
		}
		$options['body'] = [
							'groupid' => $group
							];
		$this->response = $client->send($client->createRequest("POST", $fullUrl, $options));
		PHPUnit_Framework_Assert::assertEquals(200, $this->response->getStatusCode());
	}

	/**
	 * @Given /^user "([^"]*)" is not a subadmin of group "([^"]*)"$/
	 * @param string $user
	 * @param string $group
	 */
	public function userIsNotSubadminOfGroup($user, $group) {
		$fullUrl = $this->baseUrl . "v2.php/cloud/groups/$group/subadmins";
		$client = new Client();
		$options = [];
		if ($this->currentUser === 'admin') {
			$options['auth'] = $this->adminUser;
		}

		$this->response = $client->get($fullUrl, $options);
		$respondedArray = $this->getArrayOfSubadminsResponded($this->response);
		sort($respondedArray);
		PHPUnit_Framework_Assert::assertNotContains($user, $respondedArray);
		PHPUnit_Framework_Assert::assertEquals(200, $this->response->getStatusCode());
	}

	/**
	 * @Then /^users returned are$/
	 * @param \Behat\Gherkin\Node\TableNode|null $usersList
	 */
	public function theUsersShouldBe($usersList) {
		if ($usersList instanceof \Behat\Gherkin\Node\TableNode) {
			$users = $usersList->getRows();
			$usersSimplified = $this->simplifyArray($users);
			$respondedArray = $this->getArrayOfUsersResponded($this->response);
			PHPUnit_Framework_Assert::assertEquals($usersSimplified, $respondedArray, "", 0.0, 10, true);
		}

	}

	/**
	 * @Then /^groups returned are$/
	 * @param \Behat\Gherkin\Node\TableNode|null $groupsList
	 */
	public function theGroupsShouldBe($groupsList) {
		if ($groupsList instanceof \Behat\Gherkin\Node\TableNode) {
			$groups = $groupsList->getRows();
			$groupsSimplified = $this->simplifyArray($groups);
			$respondedArray = $this->getArrayOfGroupsResponded($this->response);
			PHPUnit_Framework_Assert::assertEquals($groupsSimplified, $respondedArray, "", 0.0, 10, true);
		}

	}

	/**
	 * @Then /^subadmin groups returned are$/
	 * @param \Behat\Gherkin\Node\TableNode|null $groupsList
	 */
	public function theSubadminGroupsShouldBe($groupsList) {
		if ($groupsList instanceof \Behat\Gherkin\Node\TableNode) {
			$groups = $groupsList->getRows();
			$groupsSimplified = $this->simplifyArray($groups);
			$respondedArray = $this->getArrayOfSubadminsResponded($this->response);
			PHPUnit_Framework_Assert::assertEquals($groupsSimplified, $respondedArray, "", 0.0, 10, true);
		}

	}

	/**
	 * @Then /^apps returned are$/
	 * @param \Behat\Gherkin\Node\TableNode|null $appList
	 */
	public function theAppsShouldBe($appList) {
		if ($appList instanceof \Behat\Gherkin\Node\TableNode) {
			$apps = $appList->getRows();
			$appsSimplified = $this->simplifyArray($apps);
			$respondedArray = $this->getArrayOfAppsResponded($this->response);
			PHPUnit_Framework_Assert::assertEquals($appsSimplified, $respondedArray, "", 0.0, 10, true);
		}

	}

	/**
	 * @Then /^subadmin users returned are$/
	 * @param \Behat\Gherkin\Node\TableNode|null $groupsList
	 */
	public function theSubadminUsersShouldBe($groupsList) {
		$this->theSubadminGroupsShouldBe($groupsList);
	}

	/**
	 * Parses the xml answer to get the array of users returned.
	 * @param ResponseInterface $resp
	 * @return array
	 */
	public function getArrayOfUsersResponded($resp) {
		$listCheckedElements = $resp->xml()->data[0]->users[0]->element;
		$extractedElementsArray = json_decode(json_encode($listCheckedElements), 1);
		return $extractedElementsArray;
	}

	/**
	 * Parses the xml answer to get the array of groups returned.
	 * @param ResponseInterface $resp
	 * @return array
	 */
	public function getArrayOfGroupsResponded($resp) {
		$listCheckedElements = $resp->xml()->data[0]->groups[0]->element;
		$extractedElementsArray = json_decode(json_encode($listCheckedElements), 1);
		return $extractedElementsArray;
	}

	/**
	 * Parses the xml answer to get the array of apps returned.
	 * @param ResponseInterface $resp
	 * @return array
	 */
	public function getArrayOfAppsResponded($resp) {
		$listCheckedElements = $resp->xml()->data[0]->apps[0]->element;
		$extractedElementsArray = json_decode(json_encode($listCheckedElements), 1);
		return $extractedElementsArray;
	}

	/**
	 * Parses the xml answer to get the array of subadmins returned.
	 * @param ResponseInterface $resp
	 * @return array
	 */
	public function getArrayOfSubadminsResponded($resp) {
		$listCheckedElements = $resp->xml()->data[0]->element;
		$extractedElementsArray = json_decode(json_encode($listCheckedElements), 1);
		return $extractedElementsArray;
	}


	/**
	 * @Given /^app "([^"]*)" is disabled$/
	 * @param string $app
	 */
	public function appIsDisabled($app) {
		$fullUrl = $this->baseUrl . "v2.php/cloud/apps?filter=disabled";
		$client = new Client();
		$options = [];
		if ($this->currentUser === 'admin') {
			$options['auth'] = $this->adminUser;
		}

		$this->response = $client->get($fullUrl, $options);
		$respondedArray = $this->getArrayOfAppsResponded($this->response);
		PHPUnit_Framework_Assert::assertContains($app, $respondedArray);
		PHPUnit_Framework_Assert::assertEquals(200, $this->response->getStatusCode());
	}

	/**
	 * @Given /^app "([^"]*)" is enabled$/
	 * @param string $app
	 */
	public function appIsEnabled($app) {
		$fullUrl = $this->baseUrl . "v2.php/cloud/apps?filter=enabled";
		$client = new Client();
		$options = [];
		if ($this->currentUser === 'admin') {
			$options['auth'] = $this->adminUser;
		}

		$this->response = $client->get($fullUrl, $options);
		$respondedArray = $this->getArrayOfAppsResponded($this->response);
		PHPUnit_Framework_Assert::assertContains($app, $respondedArray);
		PHPUnit_Framework_Assert::assertEquals(200, $this->response->getStatusCode());
	}

	/**
	 * @Then /^user "([^"]*)" is disabled$/
	 * @param string $user
	 */
	public function userIsDisabled($user) {
		$fullUrl = $this->baseUrl . "v{$this->apiVersion}.php/cloud/users/$user";
		$client = new Client();
		$options = [];
		if ($this->currentUser === 'admin') {
			$options['auth'] = $this->adminUser;
		}

		$this->response = $client->get($fullUrl, $options);
		PHPUnit_Framework_Assert::assertEquals("false", $this->response->xml()->data[0]->enabled);
	}

	/**
	 * @Then /^user "([^"]*)" is enabled$/
	 * @param string $user
	 */
	public function userIsEnabled($user) {
		$fullUrl = $this->baseUrl . "v{$this->apiVersion}.php/cloud/users/$user";
		$client = new Client();
		$options = [];
		if ($this->currentUser === 'admin') {
			$options['auth'] = $this->adminUser;
		}

		$this->response = $client->get($fullUrl, $options);
		PHPUnit_Framework_Assert::assertEquals("true", $this->response->xml()->data[0]->enabled);
	}

	/**
	 * @Given user :user has a quota of :quota
	 * @param string $user
	 * @param string $quota
	 */
	public function userHasAQuotaOf($user, $quota)
	{
		$body = new \Behat\Gherkin\Node\TableNode([
			0 => ['key', 'quota'],
			1 => ['value', $quota],
		]);

		// method used from BasicStructure trait
		$this->sendingToWith("PUT", "/cloud/users/" . $user, $body);
	}

	/**
	 * @Given user :user has unlimited quota
	 * @param string $user
	 */
	public function userHasUnlimitedQuota($user)
	{
		$this->userHasAQuotaOf($user, 'none');
	}

	/**
	 * @BeforeScenario
	 * @AfterScenario
	 */
	public function cleanupUsers()
	{
		$previousServer = $this->currentServer;
		$this->usingServer('LOCAL');
		foreach($this->createdUsers as $user) {	
			$this->deleteUser($user);
		}
		$this->usingServer('REMOTE');
		foreach($this->createdRemoteUsers as $remoteUser) {
			$this->deleteUser($remoteUser);
		}
		$this->usingServer($previousServer);
	}

	/**
	 * @BeforeScenario
	 * @AfterScenario
	 */
	public function cleanupGroups()
	{
		$previousServer = $this->currentServer;
		$this->usingServer('LOCAL');
		foreach($this->createdGroups as $group) {
			$this->deleteGroup($group);
		}
		$this->usingServer('REMOTE');
		foreach($this->createdRemoteGroups as $remoteGroup) {
			$this->deleteUser($remoteGroup);
		}
		$this->usingServer($previousServer);
	}

}
