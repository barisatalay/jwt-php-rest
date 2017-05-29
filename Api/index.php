<?php
    require_once 'vendor/autoload.php';
    $folder_Controller = "controller/*.php";

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
    
    //$app->response->headers->get('Content-Type');
    
    /*Content-Type kontrolü*/
    if(!($app->request->headers->get('Content-Type') === "application/json")){
        $app->getResponse()->setStatus(false);
        $app->getResponse()->setDescription("Content-Type must be application/json");
        
        $app->toJson(403);
        //$app->halt(403);
    }
    
    foreach (glob($folder_Controller) as $controller){
        require_once($controller);
    }
    //Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiYWRtaW4iOnRydWV9.TJVA95OrM7E2cBab30RMHrHDcEfxjoYZgeFONFh7HgQ
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