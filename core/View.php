<?php
declare(strict_types=1);

namespace Core;

/**
 * View class
 * 
 */
class View
{

	/**
	 * Render a view file
	 * 
	 * @param string $view The view file
	 * 
	 * @return void
	 */
	public static function render(string $view, array $args = []) : void
	{
		\extract($args, EXTR_SKIP);

		$file = "../src/View/$view"; //relative to the core directory

		if(is_readable($file)) {
			require $file;
		} else {
			throw new \Exception("$file not found");
		}
	}
}