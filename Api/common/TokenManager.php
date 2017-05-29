<?php
/*
    Creator: Barış ATALAY 27.05.2017
    Github: https://github.com/barisatalay/jwt-php-rest
*/
use Firebase\JWT\JWT;

class TokenManager{
    
    private $token_str;
    private $token_key="secret";
    private $bearerRegex="/Bearer\s+(.*)$/i";
    
    private $token_Data;
    
    private $lastError="";
    
    public function __construct(){}
    
    /*
     * $token is Json Web Token
     */
    public function setToken($token){
        if($token === null){
            $this->lastError = Constant::$err_token_authorization;
            return false;
        }
        
        $matches = array();
        if (!preg_match($this->bearerRegex, $token, $matches)) {
            $this->lastError = Constant::$err_token_no_found;
            return false;
        }
        
        $this->token_str = $matches[1];
        
        //$testtoken = $this->createToken("qwe");
        try{
            $this->token_Data = JWT::decode($this->token_str, Constant::$token_key, array('HS256'));
            
            if($this->token_Data === null || sizeof($this->token_Data) == 0){
                $lastError = Constant::$err_token_not_valid;
                return false;
            }
        }catch(Exception  $e ){
            $this->lastError = $e->getMessage();
            return false;
        }
        
        return true;
    }
    
    
    public function createToken($userData){
        
        
        //$tokenData[] = $userData;
        
        /**
		* IMPORTANT:
		* You must specify supported algorithms for your application. See
		* https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
		* for a list of spec-compliant algorithms.
		*/
		$jwt = JWT::encode($userData, Constant::$token_key);
		
		return $jwt;
    }
    
    public function getError(){
        return $this->lastError;
    }
    
    public function getTokenData(){
        if($this->token_Data === null)
            $this->token_Data = array();
            
        return $this->token_Data;
    }
}


?>