<?php
/*
    Creator: Barış ATALAY 27.05.2017
    Github: https://github.com/barisatalay/jwt-php-rest
*/
    require_once 'vendor/autoload.php';
    class_alias('\RedBeanPHP\R','\R');
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
    $databaseConfig = parse_ini_file("DatabaseConfig.ini");
    $host = $databaseConfig["host"];
    $dbname = $databaseConfig["dbname"];
    $dbuser= $databaseConfig["dbuser"];
    $dbpassword = $databaseConfig["dbpassword"];
    /**
     * RedBean defination
     */
    
    R::setup('mysql:host='.$host.';dbname='.$dbname, $dbuser, $dbpassword);
    
    
    /**
     * As you have seen, RedBeanPHP dynamically changes 
     * the structure of the database during development. 
     * This is a very nice feature, but you don't want 
     * that to happen on your production server! 
     * So, before deploying your app, be sure to freeze 
     * the database by adding the following line just below the setup:
     */
    R::freeze(true);
    
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
        //$app = JwtApplication::getInstance();
        global $app;
        if(!$app->setToken($app->request->headers->get('Authorization'))){
            $app->getResponse()->setStatus(false);
            $app->getResponse()->setDescription($app->getTokenManager()->getError());
            
            $app->toJson(403);
        }
    }
    
    // Run app
    $app->run();
?>