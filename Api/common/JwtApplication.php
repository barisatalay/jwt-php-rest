<?php
/*
    Creator: Barış ATALAY 27.05.2017
    Github: https://github.com/barisatalay/jwt-php-rest
*/
class JwtApplication extends Slim\Slim {

    private $tokenManager;
    private $responseItem;
    
    public function __constructor(){
        $this->responseItem=ResponseBase();
    }

    public function setToken($token){
        if($tokenManager === null){
            $this->tokenManager = new TokenManager();
        }
            
        $status = $this->tokenManager->setToken($token);
        
        return $status;
    }
    
    public function getTokenManager(){
        return $this->tokenManager;
    }
    
    public function getResponse(){
        if($this->responseItem === null){
           $this->responseItem=new ResponseBase();
        }
        
        return $this->responseItem;
    }
    
    public function toJson($statusCode){
        if($this->responseItem === null){
           $this->responseItem=new ResponseBase();
        }
        
        $this->contentType('application/json');
        $this->status($statusCode);
        echo $this->responseItem->toJson();
    }
}
?>