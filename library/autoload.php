<?php

function __autoload($className){

    $path = explode("\\", $className);

    if(count($path)>1){
        
        array_shift($path);
        
        require_once( dirname(__DIR__) . "/" . implode("/",$path) . ".php" );

    } else {

        require_once( __DIR__ . "/$className.php" );

    }
}
