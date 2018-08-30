<?php

namespace App\Library;

class Request {

    private $get;
    private $post;
    private $put;
    private $delete;

    private $req;
    private $server;

    private $script;
    private $uri;
    private $ip;

    public function __construct(){

        $this->get = $_GET;
        $this->post = $_POST;
        
        $this->req = $_REQUEST;
        $this->server = $_SERVER;
        $this->script = $_SERVER['SCRIPT_NAME'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->ip = $_SERVER['REMOTE_ADDR'];

        return $this;
    }

    public function get($name){
        return $this->$name;
    }
}