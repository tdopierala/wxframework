<?php

namespace App\Library;

use App\Library\Session;
use App\Library\Config;
use App\Library\Request;
use App\Library\Router;
use App\Library\MainController;

class Application {

    private $session;
    private $config;
    private $request;
    private $router;

    public function __construct(){

        $this->session = new Session();
        $this->session->sessionStart();

        $this->config = new Config();

        $this->session->save("variable1", "test12345");

        $this->request = new Request();
        echo "<pre>" . print_r($this->request,true) . "</pre>";
        $this->router = new Router($this->request->get('uri'));

    }

    public function __destruct(){

    }
}