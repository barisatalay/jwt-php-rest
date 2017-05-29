<?php
/*
    Creator: Barış ATALAY 27.05.2017
*/
class ResponseBase{
    public $data;
    
    public $status="";
    
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