<?php

//phpinfo();
//echo 'Requested URL = "' . $_SERVER['QUERY_STRING'] . '"';

//require '../App/Controller/Posts.php';
//require '../Core/Router.php';

spl_autoload_register(function($class) {
	$root = dirname(__DIR__); // root directory
	$file = $root . '/' . str_replace('\\', '/', $class) . '.php';
	if(is_readable($file)) {
		require $file;
	}
});

$router = new Core\Router();

//echo get_class($router);

$router->add('', ['controller' => 'Home', 'action' => 'index']);
//$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
//$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
$router->add('{controller}/{action}');
//$router->add('{controller}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
$router->add('{controller}/{action}/{id:\d+}');

//echo '<pre>';
//var_dump($router->getRoutes());
//echo '</pre>';

/* $url = $_SERVER['QUERY_STRING'];

if($router->match($url)) {
	echo '<pre>';
	echo htmlspecialchars(print_r($router->getRoutes(),true));
	var_dump($router->getParams());
	echo '</pre>';
} else {
	echo 'No route found for URL "'.$url.'"';
} */

$router->disaptch($_SERVER['QUERY_STRING']);