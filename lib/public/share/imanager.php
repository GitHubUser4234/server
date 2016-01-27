<?php
/**
 * @author Roeland Jago Douma <rullzer@owncloud.com>
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

namespace OCP\Share;

use OCP\IUser;

use OC\Share20\Exception\ShareNotFound;

/**
 * Interface IManager
 *
 * @package OCP\Share
 * @since 9.0.0
 */
interface IManager {

	/**
	 * Create a Share
	 *
	 * @param IShare $share
	 * @return Share The share object
	 * @since 9.0.0
	 */
	public function createShare(IShare $share);

	/**
	 * Update a share
	 *
	 * @param IShare $share
	 * @return IShare The share object
	 * @since 9.0.0
	 */
	public function updateShare(IShare $share);

	/**
	 * Delete a share
	 *
	 * @param IShare $share
	 * @throws ShareNotFound
	 * @since 9.0.0
	 */
	public function deleteShare(IShare $share);

	/**
	 * Unshare a file as the recipient.
	 * This can be different from a regular delete for example when one of
	 * the users in a groups deletes that share. But the provider should
	 * handle this.
	 *
	 * @param IShare $share
	 * @param IUser $recipient
	 * @since 9.0.0
	 */
	public function deleteFromSelf(IShare $share, IUser $recipient);

	/**
	 * Get shares shared by (initiated) by the provided user.
	 *
	 * @param IUser $user
	 * @param int $shareType
	 * @param \OCP\Files\File|\OCP\Files\Folder $path
	 * @param bool $reshares
	 * @param int $limit The maximum number of returned results, -1 for all results
	 * @param int $offset
	 * @return IShare[]
	 * @since 9.0.0
	 */
	public function getSharesBy(IUser $user, $shareType, $path = null, $reshares = false, $limit = 50, $offset = 0);

	/**
	 * Get shares shared with $user.
	 *
	 * @param IUser $user
	 * @param int $shareType
	 * @param int $limit The maximum number of shares returned, -1 for all
	 * @param int $offset
	 * @return IShare[]
	 * @since 9.0.0
	 */
	public function getSharedWith(IUser $user, $shareType, $limit = 50, $offset = 0);

	/**
	 * Retrieve a share by the share id
	 *
	 * @param string $id
	 * @return Share
	 * @throws ShareNotFound
	 * @since 9.0.0
	 */
	public function getShareById($id);

	/**
	 * Get the share by token possible with password
	 *
	 * @param string $token
	 * @return Share
	 * @throws ShareNotFound
	 * @since 9.0.0
	 */
	public function getShareByToken($token);

	/**
	 * Verify the password of a public share
	 *
	 * @param IShare $share
	 * @param string $password
	 * @return bool
	 * @since 9.0.0
	 */
	public function checkPassword(IShare $share, $password);

	/**
	 * Instantiates a new share object. This is to be passed to
	 * createShare.
	 *
	 * @return IShare
	 * @since 9.0.0
	 */
	public function newShare();

	/**
	 * Is the share API enabled
	 *
	 * @return bool
	 * @since 9.0.0
	 */
	public function shareApiEnabled();

	/**
	 * Is public link sharing enabled
	 *
	 * @return bool
	 * @since 9.0.0
	 */
	public function shareApiAllowLinks();

	/**
	 * Is password on public link requires
	 *
	 * @return bool
	 * @since 9.0.0
	 */
	public function shareApiLinkEnforcePassword();

	/**
	 * Is default expire date enabled
	 *
	 * @return bool
	 * @since 9.0.0
	 */
	public function shareApiLinkDefaultExpireDate();

	/**
	 * Is default expire date enforced
	 *`
	 * @return bool
	 * @since 9.0.0
	 */
	public function shareApiLinkDefaultExpireDateEnforced();

	/**
	 * Number of default expire days
	 *
	 * @return int
	 * @since 9.0.0
	 */
	public function shareApiLinkDefaultExpireDays();

	/**
	 * Allow public upload on link shares
	 *
	 * @return bool
	 * @since 9.0.0
	 */
	public function shareApiLinkAllowPublicUpload();

	/**
	 * check if user can only share with group members
	 * @return bool
	 * @since 9.0.0
	 */
	public function shareWithGroupMembersOnly();

	/**
	 * Check if sharing is disabled for the given user
	 *
	 * @param IUser $user
	 * @return bool
	 * @since 9.0.0
	 */
	public function sharingDisabledForUser(IUser $user);

}
