<?php

/**
 * @author Christoph Wurst <christoph@owncloud.com>
 *
 * @copyright Copyright (c) 2016, ownCloud, Inc.
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

namespace OC\Core\Controller;

use OC\Authentication\TwoFactorAuth\Manager;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\RedirectResponse;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IRequest;
use OCP\ISession;
use OCP\IURLGenerator;
use OCP\IUserSession;

class TwoFactorChallengeController extends Controller {

	/** @var Manager */
	private $twoFactorManager;

	/** @var IUserSession */
	private $userSession;

	/** @var ISession */
	private $session;

	/** @var IURLGenerator */
	private $urlGenerator;

	/**
	 * @param string $appName
	 * @param IRequest $request
	 * @param Manager $twoFactorManager
	 * @param IUserSession $userSession
	 * @param ISession $session
	 * @param IURLGenerator $urlGenerator
	 */
	public function __construct($appName, IRequest $request, Manager $twoFactorManager, IUserSession $userSession,
		ISession $session, IURLGenerator $urlGenerator) {
		parent::__construct($appName, $request);
		$this->twoFactorManager = $twoFactorManager;
		$this->userSession = $userSession;
		$this->session = $session;
		$this->urlGenerator = $urlGenerator;
	}

	/**
	 * @NoCSRFRequired
	 * @PublicPage
	 *
	 * @return TemplateResponse
	 */
	public function selectChallenge() {
		$user = $this->userSession->getUser();
		$providers = $this->twoFactorManager->getProviders($user);

		$data = [
			'providers' => $providers,
		];
		return new TemplateResponse($this->appName, 'twofactorselectchallenge', $data, 'guest');
	}

	/**
	 * @NoCSRFRequired
	 * @PublicPage
	 * @UseSession
	 *
	 * @param string $challengeProviderId
	 * @return TemplateResponse
	 */
	public function showChallenge($challengeProviderId) {
		$user = $this->userSession->getUser();
		$provider = $this->twoFactorManager->getProvider($user, $challengeProviderId);
		if (is_null($provider)) {
			return new RedirectResponse($this->urlGenerator->linkToRoute('core.TwoFactorChallenge.selectChallenge'));
		}

		if ($this->session->exists('two_factor_auth_error')) {
			$this->session->remove('two_factor_auth_error');
			$error = true;
		} else {
			$error = false;
		}
		$data = [
			'error' => $error,
			'provider' => $provider,
			'template' => $provider->getTemplate($user)->fetchPage(),
		];
		return new TemplateResponse($this->appName, 'twofactorshowchallenge', $data, 'guest');
	}

	/**
	 * @NoCSRFRequired
	 * @PublicPage
	 * @UseSession
	 *
	 * @param string $challengeProviderId
	 * @param string $challenge
	 * @return RedirectResponse
	 */
	public function solveChallenge($challengeProviderId, $challenge) {
		$user = $this->userSession->getUser();
		$provider = $this->twoFactorManager->getProvider($user, $challengeProviderId);
		if (is_null($provider)) {
			return new RedirectResponse($this->urlGenerator->linkToRoute('core.TwoFactorChallenge.selectChallenge'));
		}

		if ($this->twoFactorManager->verifyChallenge($challengeProviderId, $user, $challenge)) {
			return new RedirectResponse($this->urlGenerator->linkToRoute('files.view.index'));
		}

		$this->session->set('two_factor_auth_error', true);
		return new RedirectResponse($this->urlGenerator->linkToRoute('core.TwoFactorChallenge.showChallenge', ['challengeProviderId' => $provider->getId()]));
	}

}
