<?php

namespace App\Controller;

use Core\Controller;
use Core\View;

class Home extends Controller
{
	public function indexAction() : void
	{
		//echo 'Hello from the index action in the Home controller';

		View::render('Home/index.php',[
			'name' => 'Tom',
			'colours' => ['black', 'white', 'blue'],
		]);
	}

}