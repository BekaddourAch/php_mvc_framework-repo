<?php
namespace oo;
use oo\middlewares\BaseMiddleware;
class Controller { 
    public array $middlewares=[];
public string $layout='main';
public string $action='';

public function setLayout(String $layout){
    $this->layout=$layout;
}
public function render($view,$params= []){
    return Application::$app->view->renderView($view,$params);
}
public function registerMiddleware(BaseMiddleware $middleware){
    $this->middlewares[]=$middleware;
}

public function getMiddleWares():array
{
    return $this->middlewares;
}
}