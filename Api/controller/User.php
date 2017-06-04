<?php
/*
    Creator: Barış ATALAY 27.05.2017
*/
    $app->post('/Login', function() {
        global $app;
        if($app->getResponse()->getStatus() === false) exit;
        
        $user = R::getRow( 'Select * from user where userName=? and password=? and active=1 ',[ $app->getRequest()->userName, $app->getRequest()->password]);
        $data = new stdClass();
        
        if ($user === NULL || sizeof($user) == 0){
            $app->getResponse()->setStatus(false);
            $app->getResponse()->setDescription(Constant::$err_user_not_found);
        }else{
            /*
             * Token Data Example
             */
            $tokenData = array(
                "userId" => $user["recID"],
                "userName" => $user["userName"],
                "crtDate" => date(Constant::$format_datetime, time())
            );
            
            $data->token = $app->getTokenManager()->createToken($tokenData);
            
            $app->getResponse()->setData($data);
        }
        echo $app->toJson(200); 
    });
    
    $app->post('/GetUserDetail','authenticate', function() {
        //$app = JwtApplication::getInstance();
        global $app;
        
        if($app->getResponse()->getStatus() === false) exit;
        
        $data = R::getRow( 'Select * from userdetail where masterId=? ',[ $app->getTokenItem("userId")]);
        
        $app->getResponse()->setData($data);
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