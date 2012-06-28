<?php

/**
* ownCloud - hooks handler of the Versions app
*
* @author Bjoern Schiessle
* @copyright 2012 Bjoern Schiessle schiessle@owncloud.com
* 
* This library is free software; you can redistribute it and/or
* modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
* License as published by the Free Software Foundation; either 
* version 3 of the License, or any later version.
* 
* This library is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	See the
* GNU AFFERO GENERAL PUBLIC LICENSE for more details.
*	
* You should have received a copy of the GNU Lesser General Public 
* License along with this library. If not, see <http://www.gnu.org/licenses/>.
* 
*/

class OC_Files_Versions_Hooks_Handler {

	public static function removeVersions($params) {
		$rel_path =  $params[OC_Filesystem::signal_param_path];
		$abs_path = \OCP\Config::getSystemValue('datadirectory').'/'.\OC_User::getUser()."/versions".$rel_path;
		if(OCA_Versions\Storage::isversioned($rel_path)) {
			$versions = OCA_Versions\Storage::getVersions($rel_path);
			foreach ($versions as $v){
					unlink($abs_path.'.v' . $v['version']);
			}
		}
	}
}

?>