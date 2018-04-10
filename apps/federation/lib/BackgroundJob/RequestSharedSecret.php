<?php
/**
 * @copyright Copyright (c) 2016, ownCloud, Inc.
 *
 * @author Bjoern Schiessle <bjoern@schiessle.org>
 * @author Björn Schießle <bjoern@schiessle.org>
 * @author Joas Schilling <coding@schilljs.com>
 * @author Lukas Reschke <lukas@statuscode.ch>
 * @author Morris Jobke <hey@morrisjobke.de>
 * @author Robin Appelman <robin@icewind.nl>
 * @author Roeland Jago Douma <roeland@famdouma.nl>
 * @author Thomas Müller <thomas.mueller@tmit.eu>
 *
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */


namespace OCA\Federation\BackgroundJob;


use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Ring\Exception\RingException;
use OC\BackgroundJob\JobList;
use OC\BackgroundJob\Job;
use OCA\Federation\DbHandler;
use OCA\Federation\TrustedServers;
use OCP\AppFramework\Http;
use OCP\AppFramework\Utility\ITimeFactory;
use OCP\BackgroundJob\IJobList;
use OCP\Http\Client\IClient;
use OCP\Http\Client\IClientService;
use OCP\ILogger;
use OCP\IURLGenerator;
use OCP\OCS\IDiscoveryService;

/**
 * Class RequestSharedSecret
 *
 * Ask remote Nextcloud to request a sharedSecret from this server
 *
 * @package OCA\Federation\Backgroundjob
 */
class RequestSharedSecret extends Job {

	/** @var IClient */
	private $httpClient;

	/** @var IJobList */
	private $jobList;

	/** @var IURLGenerator */
	private $urlGenerator;

	/** @var DbHandler */
	private $dbHandler;

	/** @var TrustedServers */
	private $trustedServers;

	/** @var IDiscoveryService  */
	private $ocsDiscoveryService;

	/** @var ILogger */
	private $logger;

	/** @var ITimeFactory */
	private $timeFactory;

	/** @var bool */
	protected $retainJob = false;

	private $format = '?format=json';

	private $defaultEndPoint = '/ocs/v2.php/apps/federation/api/v1/request-shared-secret';

	/** @var  int  30 day = 2592000sec */
	private $maxLifespan = 2592000;

	/**
	 * RequestSharedSecret constructor.
	 *
	 * @param IClientService $httpClientService
	 * @param IURLGenerator $urlGenerator
	 * @param IJobList $jobList
	 * @param TrustedServers $trustedServers
	 * @param DbHandler $dbHandler
	 * @param IDiscoveryService $ocsDiscoveryService
	 * @param ILogger $logger
	 * @param ITimeFactory $timeFactory
	 */
	public function __construct(
		IClientService $httpClientService,
		IURLGenerator $urlGenerator,
		IJobList $jobList,
		TrustedServers $trustedServers,
		DbHandler $dbHandler,
		IDiscoveryService $ocsDiscoveryService,
		ILogger $logger,
		ITimeFactory $timeFactory
	) {
		$this->httpClient = $httpClientService->newClient();
		$this->jobList = $jobList;
		$this->urlGenerator = $urlGenerator;
		$this->dbHandler = $dbHandler;
		$this->logger = $logger;
		$this->ocsDiscoveryService = $ocsDiscoveryService;
		$this->trustedServers = $trustedServers;
		$this->timeFactory = $timeFactory;
	}


	/**
	 * run the job, then remove it from the joblist
	 *
	 * @param JobList $jobList
	 * @param ILogger|null $logger
	 */
	public function execute($jobList, ILogger $logger = null) {
		$target = $this->argument['url'];
		// only execute if target is still in the list of trusted domains
		if ($this->trustedServers->isTrustedServer($target)) {
			$this->parentExecute($jobList, $logger);
		}

		$jobList->remove($this, $this->argument);

		if ($this->retainJob) {
			$this->reAddJob($this->argument);
		}
	}

	/**
	 * call execute() method of parent
	 *
	 * @param JobList $jobList
	 * @param ILogger $logger
	 */
	protected function parentExecute($jobList, $logger) {
		parent::execute($jobList, $logger);
	}

	protected function run($argument) {

		$target = $argument['url'];
		$created = isset($argument['created']) ? (int)$argument['created'] : $this->timeFactory->getTime();
		$currentTime = $this->timeFactory->getTime();
		$source = $this->urlGenerator->getAbsoluteURL('/');
		$source = rtrim($source, '/');
		$token = $argument['token'];

		// kill job after 30 days of trying
		$deadline = $currentTime - $this->maxLifespan;
		if ($created < $deadline) {
			$this->retainJob = false;
			$this->trustedServers->setServerStatus($target, TrustedServers::STATUS_FAILURE);
			return;
		}

		$endPoints = $this->ocsDiscoveryService->discover($target, 'FEDERATED_SHARING');
		$endPoint = isset($endPoints['shared-secret']) ? $endPoints['shared-secret'] : $this->defaultEndPoint;

		// make sure that we have a well formated url
		$url = rtrim($target, '/') . '/' . trim($endPoint, '/') . $this->format;

		try {
			$result = $this->httpClient->post(
				$url,
				[
					'body' => [
						'url' => $source,
						'token' => $token,
					],
					'timeout' => 3,
					'connect_timeout' => 3,
				]
			);

			$status = $result->getStatusCode();

		} catch (ClientException $e) {
			$status = $e->getCode();
			if ($status === Http::STATUS_FORBIDDEN) {
				$this->logger->info($target . ' refused to ask for a shared secret.', ['app' => 'federation']);
			} else {
				$this->logger->info($target . ' responded with a ' . $status . ' containing: ' . $e->getMessage(), ['app' => 'federation']);
			}
		} catch (RequestException $e) {
			$status = -1; // There is no status code if we could not connect
			$this->logger->info('Could not connect to ' . $target, ['app' => 'federation']);
		} catch (RingException $e) {
			$status = -1; // There is no status code if we could not connect
			$this->logger->info('Could not connect to ' . $target, ['app' => 'federation']);
		} catch (\Exception $e) {
			$status = Http::STATUS_INTERNAL_SERVER_ERROR;
			$this->logger->logException($e, ['app' => 'federation']);
		}

		// if we received a unexpected response we try again later
		if (
			$status !== Http::STATUS_OK
			&& $status !== Http::STATUS_FORBIDDEN
		) {
			$this->retainJob = true;
		}

		if ($status === Http::STATUS_FORBIDDEN) {
			// clear token if remote server refuses to ask for shared secret
			$this->dbHandler->addToken($target, '');
		}

	}

	/**
	 * re-add background job
	 *
	 * @param array $argument
	 */
	protected function reAddJob(array $argument) {
		$url = $argument['url'];
		$created = isset($argument['created']) ? (int)$argument['created'] : $this->timeFactory->getTime();
		$token = $argument['token'];

		$this->jobList->add(
			RequestSharedSecret::class,
			[
				'url' => $url,
				'token' => $token,
				'created' => $created
			]
		);
	}
}
