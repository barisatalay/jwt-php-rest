<?php
/*
    Creator: Barış ATALAY 27.05.2017
*/
    $app->post('/Login', function() {
        global $app;
        if($app->getResponse()->getStatus() === false) exit;
        
        $testLogin = new stdClass();
        $testLogin->userName = "Barış";
        $testLogin->userSurName = "ATALAY";
        
        $app->getResponse()->setData($testLogin);
        
        echo $app->toJson(200); 
    });
    
    $app->post('/GetStore','authenticate', function() {
        global $app;
        if($app->getResponse()->getStatus() === false) exit;
        
        $response=array();
        
        $storeRow=new stdClass();
        $storeRow->Id = 1;
        $storeRow->ProductName="Pencil";
        $storeRow->Amount=3.15;
        $response[]=$storeRow;
        
        $storeRow=new stdClass();
        $storeRow->Id = 1;
        $storeRow->ProductName="Book";
        $storeRow->Amount=10.00;
        $response[]=$storeRow;
        
        $storeRow=new stdClass();
        $storeRow->Id = 1;
        $storeRow->ProductName="Door";
        $storeRow->Amount=52.76;
        $response[]=$storeRow;
        
        $app->getResponse()->setData($response);
        echo $app->toJson(200); 
    });

?>