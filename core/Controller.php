<?php

namespace Core;


abstract class Controller
{

	/**
	 * Parameters from the matched route
	 * @var array
	 */
	protected array $route_params = [];

	/**
	 * Class constructor
	 * 
	 * @param array $route_params Parameters from the route
	 * 
	 * @return void
	 */
	public function __construct(array $route_params)// : void
	{
		$this->route_params = $route_params;
	}

	/**
	 * 
	 * @param string $name 
	 * @param array $args Arguments passed to the methods
	 * 
	 * @return void
	 */
	public function __call(string $name, array $args) : void
	{
		$method = $name . 'Action';

		if(\method_exists($this, $method)) {
			if($this->before() !== false) {
				\call_user_func_array([$this, $method], $args);
				$this->after();
			}
		} else {
			echo "Method $method not found in the controller " . get_class($this);
		}
	}

	/**
	 * Before filter - called before an action method.
	 * 
	 * @return void
	 */
	protected function before() : void
	{
	}

	/**
	 * After filter - called after an action method.
	 * 
	 * @return void
	 */
	protected function after() : void
	{
	}
}