<?php
declare(strict_types=1);

namespace App\Model;

use Core\Model;
use PDO;


/**
 * Post model
 * 
 */
class Post extends Model
{

	/**
	 * Get all the posts as an associative array
	 * 
	 * @return array
	 */
	public static function findAll()
	{
		$db = static::getDB();

		$stmt = $db->query("SELECT id, title, date, text FROM posts ORDER BY id ASC");
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
}