<?php
/*
    Creator: Barış ATALAY 27.05.2017
    Github: https://github.com/barisatalay/jwt-php-rest
*/
class ResponseBase{
    public $data;
    
    /*
     * Default value is true;
     * If there is any problem must be false;
     */
    public $status=true;
    
    public $description="";
    
    public function getData(){
        return $this->data;
    }
    
    public function getStatus(){
        return $this->status;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function setData($value){
        $this->data=$value;
    }
    
    public function setStatus($value){
        $this->status=$value;
    }
    
    public function setDescription($value){
        $this->description=$value;
    }
    
    public function toJson(){
        return json_encode($this);
    }
}

?>