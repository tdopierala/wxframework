<?php

namespace App\Library;

class Session {

    private $session;

    public function __construct(){

        $this->session = $_SESSION;

        return $this;
    }

    public function sessionStart(){        
        return session_start();
    }

    public function save($name,$val){
        $this->session[$name] = $val;
        $this->_save();
    }

    private function _save(){
        $_SESSION = $this->session;
    }

    public function get($name){
        return $this->session[$name];
    }
}