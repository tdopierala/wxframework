<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use Core\Controller;

class Users extends Controller
{
	protected function before() : void
	{
	}

	/**
	 * Show the index page
	 *
	 * @return void
	 */
	public function indexAction() : void
	{
		echo 'User admin index';
	}
}
