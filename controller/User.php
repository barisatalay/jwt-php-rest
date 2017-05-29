<?php
    $app->post('/Login', function() {
        global $app;
        if($app->getResponse()->getStatus() === false) exit;
        
        echo $app->toJson(200); 
    });
    
    $app->post('/GetStore','authenticate', function() {
        global $app;
        if($app->getResponse()->getStatus() === false) exit;
        
        echo $app->toJson(200); 
    });

?>