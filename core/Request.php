<?php

namespace oo;

class Request{
    public function getPath()
    {
        $path=$_SERVER['REQUEST_URI'] ?? '/'; 
        $position =strpos($path,'?');
        
        if($position=== false){
            return $path;
        }
        return substr($path,0,$position);
        // echo'<pre>';
        // var_dump($_SERVER['REQUEST_URI']);
        
        // var_dump($position);
        // echo'</pre>';
    }
    public function getBody(){
        $body=[];
        if($this->getMethod()==='get'){
            foreach($_GET as $key=>$value){
                 $body[$key]=filter_input(INPUT_GET,$key,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }
        if($this->getMethod()==='post'){
            foreach($_POST as $key=>$value){
                 $body[$key]=filter_input(INPUT_POST,$key,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }
        return $body;
    }
    public function isGet(){ 
            return $this->getMethod()==='get'; 
    }
    public function isPost(){ 
        return $this->getMethod()==='post'; 
}
    public function getMethod(){
        // $path=$_SERVER['REQUEST_METHOD'] ?? '/'; 
        // $position =strpos($path,'?');
        
        // if($position=== false){
        //     return $path;
        // }
        // //return $_SERVER; REQUEST_METHOD
        // return substr($path,$position,strlen($path));
        return strtolower($_SERVER['REQUEST_METHOD']);
    } 

}