<?php
/*
    Creator: Barış ATALAY 27.05.2017
    Github: https://github.com/barisatalay/jwt-php-rest
*/
    require_once 'vendor/autoload.php';
    $folder_Controller = "controller/*.php";

    /*
     * Php file paths
     */
    $requireDirs=array(
        "common/utils/*.php",
        "common/*.php",
        "model/*.php"
    );
    
    foreach($requireDirs as $dir){
        foreach (glob($dir) as $controller){
            require_once($controller);
        }
    }
    
    JwtApplication::registerAutoloader();
        
    $app = new JwtApplication();
    
    /*Content-Type Checker*/
    if(!($app->request->headers->get('Content-Type') === "application/json")){
        $app->getResponse()->setStatus(false);
        $app->getResponse()->setDescription("Content-Type must be application/json");
        
        $app->toJson(403);
    }
    
    foreach (glob($folder_Controller) as $controller){
        require_once($controller);
    }
    
    function authenticate(\Slim\Route $route) {
        $app = JwtApplication::getInstance();
        if(!$app->setToken($app->request->headers->get('Authorization'))){
            $app->getResponse()->setStatus(false);
            $app->getResponse()->setDescription($app->getTokenManager()->getError());
            
            $app->toJson(403);
        }
    }
    
    // Run app
    $app->run();
?>