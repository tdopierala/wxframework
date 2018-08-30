<?php

namespace App\Library;

use App\Controllers;

class Router {

    private $controller;
    private $action;
    private $id;

    public function __construct($request){
        
        $this->getRoute($request);

        $this->load();
    }

    private function getRoute($req){

        $vars = explode("/", $req);
        
        $this->controller = $vars[2];
        $this->action = $vars[3];
        $this->id = $vars[4];
    }

    public function getController(){
        return $this->controller;
    }

    public function getAction(){
        return $this->action;
    }

    public function getId(){
        return $this->id;
    }

    private function load(){
        
        $controller = ucfirst($this->getController()) . "Controller";

        $action = strtolower($this->getAction()) . "Action";

        if(file_exists(dirname(__DIR__) . "/controllers/" . $controller . ".php")){

            $className = "\App\Controllers\\" . $controller;
            //if($action)
            $main = new $className($action);
            //$main->$action();
        }
    }
}