<?php

namespace App\Library;

class Config {

    private $app;

    public function __construct(){

        $this->app = include(dirname(__DIR__) . "/config/app.php");
    }

}