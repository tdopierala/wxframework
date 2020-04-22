<?php
declare(strict_types=1);

namespace Core;

/**
 * Application configuration
 * 
 * 
 */
final class Config
{

	/**
	 * Instance of the Config class
	 * @var Config $instance
	 */
	private static ?Config $instance = null;

	/**
	 * Array of configuration strings
	 * @var array $config
	 */
	public static array $config = [];

	/**
	 * Show or hide error messages on screen
	 * @var boolean
	 */
	//const SHOW_ERRORS = true;

	/**
	 * Private constructor is not allowed to call from outside to prevent from creating multiple instances.
	 * Loading configuration file.
	 * 
	 */
	private function __construct()
    {
		Config::$config = include(dirname(__DIR__) . "/config/app.php");
	}
	
	private function __clone()
    {
	}
	
	private function __wakeup()
    {
    }

	/**
	 * Return an instance of existing object of the class or create new
	 * 
	 * @return Config
	 */
	public static function getInstance() : Config
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

	public static function __callStatic($name, $args) {

		$var = \explode('/', $args[0]);
		$pointer = Config::$config;

		//return $var;

		foreach($var as $v) {
			if(\array_key_exists($v, $pointer)) {
				$pointer = $pointer[$v];
			}
		}
		
		return $pointer;

	}

}