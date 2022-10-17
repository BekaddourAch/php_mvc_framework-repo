<?php
namespace oo;
use oo\exception\NotFoundException;
use oo\Response;
 class Router{
    
    public Request $request;
    public Response $response;
    protected array $routes=[];
    public function __construct(Request $request,Response $response){
        $this->request =$request;
        $this->response=$response;
    }
    public function get($path,$callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path,$callback)
    {
        $this->routes['post'][$path] = $callback;
    }


    //define witch method is used and path
    public function resolve(){
        $path=$this->request->getPath();
        $method=$this->request->getMethod();
        $callback=$this->routes[$method][$path] ?? false;
        if ($callback===false) {
            throw new NotFoundException();
            // return $this->renderView("layouts/_error");
        }
        if(is_string($callback)){
            // return $this->renderView($callback);
            return Application::$app->view->renderView($callback);
        }
        if(is_array($callback)){
            //creat a new object of the class called in the callback
            //its creates an instance of the controller
            // $callback[0]=new $callback[0]();***
            
            // $controller=new $callback[0]();
            // Application::$app->controller=$controller;
            // $controller->action=new $callback[1]();
            $controller = new $callback[0];
            $controller->action = $callback[1];
            Application::$app->controller = $controller;
            $callback[0]=$controller;
            foreach($controller->getMiddleWares() as $middleware){
                $middleware->execute();
            }
            // echo'<pre>';  
            // var_dump($callback);  
            // echo'</pre>';
        }
        //execute the callback
       // return call_user_func_array([$this,$callback],function(){return null;});
       //return call_user_func([new $callback[0],$callback[1]]);
       //return call_user_func($this->isCheck($callback));
          // return var_dump($callback);
           return call_user_func($callback,$this->request,$this->response);

        //    return call_user_func(array(new SiteController(),'home'),$this->request);

        //    return is_callable($callback);
        // echo'<pre>';  
        // var_dump($callback);  
        // echo'</pre>';

        // echo'<pre>';  
        // var_dump($path); 
        // var_dump($method);
        // echo'</pre>';
    }
   

     
    // private function isCheck($callback)
    // {
    //     if(is_array($callback))
    //         $callback[0] = new $callback[0];
    
    //     return $callback;
    // }
    
// ---------------------------------------------------------------------------------------------- Moved To View Class 
    // public function renderView($view,$params=[]){
    //     return Application::$app->view->renderView($view,$params);
    // }
    // public function renderContent($viewContent){
    //     return Application::$app->view->renderContent($viewContent);
    // }
    // protected function layoutContent(){ 
    //     return Application::$app->view->layoutContent();
    // }
    // protected function renderOnlyView($view,$params){ 
    //     return Application::$app->view->renderOnlyView($view,$params);
    // }
    
}