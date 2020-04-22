<?php
declare(strict_types=1);

namespace App\Controller;

use Core\Controller;
use Core\View;
use Core\Config;
use App\Model\Post;

class Posts extends Controller
{
	protected function before() :void
	{
		echo '(before)<br/>';
	}

	protected function after() :void
	{
		echo '<br/>(after)';
	}

	public function indexAction() : void
	{
		echo 'Hello from the index action in the Posts controller';
		echo '<p>Query string paramaters: <pre>' . htmlspecialchars(print_r($_GET, true)) . '</pre></p>';
	}

	public function addNewAction() : void
	{
		echo 'Hello from the addNew action in the Posts controller';
	}

	public function editAction() : void
	{
		echo 'Hello from the edit action in the Posts controller';
		echo '<p>Query string paramaters: <pre>' . htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
		echo '<p>Query string paramaters: <pre>' . htmlspecialchars(print_r($_GET, true)) . '</pre></p>';
	}

	public function showAction() : void
	{
		$config = Config::getInstance();

		$posts = ['one','two','tree'];
		$posts = Post::findAll();

		View::render('Posts/index.php', [
			'posts' => $posts,
			'config' => $config::get('datasource/default/dbhost')
		]);
	}
}