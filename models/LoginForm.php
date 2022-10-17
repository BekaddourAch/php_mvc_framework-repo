<?php

namespace mdls;
use oo\Application;
use oo\Model;

class LoginForm extends Model{

    public string $email='';
    public string $password='';
    public function rules():array
    {
        return[
            'email'=>[self::RULE_REQUIRED,self::RULE_EMAIL],
            'password'=>[self::RULE_REQUIRED]
        ];
    }
    public function login(){
        
        $user=User::findOne(['email'=>$this->email]);
        if(!$user){
            $this->addError('email','User does not exist with this email');
            return false;
        }
        if(!password_verify($this->password,$user->password)){
            $this->addError('password','Password is incorrect');
            return false;
        }
        return Application::$app->login($user);
            // echo'<pre>';  
            // var_dump($user);  
            // echo'</pre>';
            // exit;
    }

    public function labels():array
    {
        return[
            'email'=>'Your Email',
            'password'=>'Password'
        ];
    }

}