<?php

use PHPUnit\Framework\TestCase;
use Core\Router;

class RouterTest extends TestCase
{
	public function testRouteHome() {
		
		$router = new Router();

		$result = $router->add('', ['controller' => 'Home', 'action' => 'index']); // /^$/i

		$this->assertIsString($result);
		$this->assertEquals($result, '/^$/i');
	}
}