<?php

namespace oo;
class View{
    public string $title='vv';

    public function renderView($view,$params=[]){
        $this->title=$view;
        $layoutsContent = $this->layoutContent();  
        $viewContent=$this->renderOnlyView($view,$params);
         return str_replace('{{content}}',$viewContent,$layoutsContent);
           
        //include_once Application::$ROOT_DIR."\\views\\$view.php";
        // include_once __DIR__."/../views/$view.php";
    }
    public function renderContent($viewContent){
        $layoutsContent = $this->layoutContent();  
         return str_replace('{{content}}',$viewContent,$layoutsContent);
           
        //include_once Application::$ROOT_DIR."\\views\\$view.php";
        // include_once __DIR__."/../views/$view.php";
    }
    protected function layoutContent(){ 
        //echo include_once __DIR__."/../views/layouts/main.php"; 
        ob_start();//start the output caching
        $layout=Application::$app->layout;
        if(Application::$app->controller){
            $layout=Application::$app->controller->layout;
            
        }
        return include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
        
        //ob_end_flush();
        //include_once __DIR__."\\..\\views\\layouts\\main.php"; 
         //return ob_get_clean(); //returns the buffer and clear the buffer
    }
    protected function renderOnlyView($view,$params){ 
        //  echo'<pre>';  
        // var_dump($params);  
        //  echo'</pre>';
        
         foreach($params as $key=>$value){
            $$key = $value;
         }
         ob_start();
        //start the output caching--- this to show nothing on the browser
        //include_once __DIR__."\\..\\views\\$view.php"; 
        return include_once Application::$ROOT_DIR."/views/$view.php";
        //ob_end_flush();
         //return ob_get_clean(); //returns the buffer and clear the buffer
    }
}