<?php 
use cont\SiteController;
use cont\AuthController;
use  oo\Application;  
 
/** Composer Autoload to define Namespaces */
if ( file_exists(dirname(__File__).'/../vendor/autoload.php') ) {
    require_once dirname(__File__).'/../vendor/autoload.php';
}
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
// use  app\core\Application;  

$config=[
    'userClass'=>mdls\User::class,
    'db'=>[
        'pdo'=>$_ENV['DB_DSN'],
        'user'=>$_ENV['DB_USER'],
        'password'=>$_ENV['DB_PASSWORD'],
    ]
];

$app=new Application(dirname(__DIR__),$config);
// $app=new Application();

// $app->router->get('/',function(){
//     return 'Hello Worldss';
// });

// $siteCOntroler=new SiteController();
// $app->router->get('/contacts','contacts');
 // $app->router->get('/','home' );
$app->router->get('/',[SiteController::class,'home'] );
$app->router->get('/contacts',[SiteController::class,'contacts']);
// $app->router->post('/contacts',[SiteController::class,'contacts']);

$app->router->get('/login',[AuthController::class,'login']);
$app->router->post('/login',[AuthController::class,'login']);
$app->router->get('/register',[AuthController::class,'register']);
$app->router->post('/register',[AuthController::class,'register']);
$app->router->get('/logout',[AuthController::class,'logout']);
$app->router->get('/profile',[AuthController::class,'profile']);
//  $app->router->post('/contacts',[SiteController::class,'handleContact']);
// $app->router->post('/contacts',function(){
//     echo 'Handling submitted data';
// } );
$app->run();