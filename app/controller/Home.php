<?php

namespace App\Controller;

use Core\Controller;

class Home extends Controller
{
	public function index() : void
	{
		echo 'Hello from the index action in the Home controller';
	}

}