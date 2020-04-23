<?php

require '../vendor/autoload.php';

error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

$router = new Core\Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']); // /^$/i
//$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
//$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
$router->add('{controller}/{action}/{id:\d+}');
$router->add('{controller}/{action}/');
$router->add('{controller}/{action}');
$router->add('{controller}/');
$router->add('{controller}');

$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

$router->disaptch($_SERVER['QUERY_STRING']);