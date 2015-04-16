<?php
/**
 * @author Lukas Reschke <lukas@owncloud.com>
 *
 * @copyright Copyright (c) 2015, ownCloud, Inc.
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

namespace OCA\Session_Login_Tracker\Lib;

/**
 * Class Hooks
 *
 * @package OCA\Session_Login_Tracker\Lib
 */
class Hooks {

	/**
	 * @param array $params
	 */
	public static function postLogin($params) {
		$dbConnection = \OC::$server->getDatabaseConnection();
		$query = $dbConnection->prepare('INSERT INTO `*PREFIX*login_sessions` (`user_id`, `session_id`) VALUES(?, ?)');
		$query->bindValue(1, $params['uid']);
		$query->bindValue(2, session_id());
		try {
			$query->execute();
		} catch (\Exception $e) {
			\OC::$server->getLogger()->critical($e->getMessage(), array('app' => 'session_login_tracker'));
			http_response_code(500);
			session_destroy();
			exit();
		}
	}
}