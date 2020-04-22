<?php
declare(strict_types=1);

namespace Core;

use PDO;
use Core\Config;

/**
 * Base model
 * 
 */
abstract class Model
{

	/**
	 * Get the PDO database connection
	 * 
	 * @return mixed
	 */
	protected static function getDB()
	{
		static $db = null;

		$config = Config::getInstance();

		if($db === null) {

			$db = new PDO(
				"mysql:host=" . $config::get('datasource/default/dbhost')
				.";dbname=" . $config::get('datasource/default/dbname')
				.";charset=utf8",
				$config::get('datasource/default/dbuser'),
				$config::get('datasource/default/dbpassword')
			);

			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}

		return $db;
	}
	
}