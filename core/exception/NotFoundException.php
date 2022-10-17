<?php
namespace oo\exception;
use Exception;
class NotFoundException extends Exception{
    
        protected $message='Page not Found';
        protected $code=404;
    public function __construct(){}
}