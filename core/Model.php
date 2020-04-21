<?php
declare(strict_types=1);

namespace Core;

use PDO;
use Config\Config;

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

		if($db === null) {

			$db = new PDO("mysql:host=" . Config::DB_HOST . ";dbname=" . Config::DB_NAME . ";charset=utf8", Config::DB_USER, Config::DB_PASSWORD);

			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}

		return $db;
	}
	
}