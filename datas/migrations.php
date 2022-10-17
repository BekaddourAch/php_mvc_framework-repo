<?php 
namespace datas;
use cont\SiteController;
use cont\AuthController;
use Dotenv\Dotenv;
use oo\Application;
 
/** Composer Autoload to define Namespaces */
if ( file_exists(dirname(__File__).'/../vendor/autoload.php') ) {
    require_once dirname(__File__).'/../vendor/autoload.php';
}
// $dotenv = Dotenv::createImmutable(dirname(__DIR__));
// $dotenv->load();
// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->load();
// $dotenv = Dotenv::createImmutable((__DIR__.'/vendor'));
// $dotenv->load();
// Load dotenv?
// if (class_exists(Dotenv::class)) {
//     // By default, this will allow .env file values to override environment variables
//     // with matching names. Use `createUnsafeImmutable` to disable this.
//     Dotenv::createUnsafeMutable(__DIR__)->safeLoad();
// }
// use  app\core\Application;  

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config=[
    'db'=>[
        'pdo'=>$_SERVER['DB_DSN'],
        'user'=>$_SERVER['DB_USER'],
        'password'=>$_SERVER['DB_PASSWORD'],
    ]
];

// if ( ! class_exists(Application::class)) 
//     die('There is no hope!');

$app=new Application(dirname(__DIR__),$config);

$app->db->applyMigrations();
