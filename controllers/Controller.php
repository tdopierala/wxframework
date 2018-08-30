<?php

namespace App\Controllers;

class Controller {

    private $action="indexAction";

    public function __construct($act){
        $action=$this->action;

        var_dump($act);
        if(empty($act)) {
            $this->$action();
            echo "asd";
        } else {
            $this->$act();
            echo "qwe";
        }
    }
}