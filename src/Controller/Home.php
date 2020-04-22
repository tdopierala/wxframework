<?php
declare(strict_types=1);

namespace App\Controller;

use Core\Controller;
use Core\View;

class Home extends Controller
{
	public function indexAction() : void
	{
		View::render('Home/index.php',[
			'name' => 'Tom',
			'colours' => ['black', 'white', 'blue'],
		]);
	}

}