<?php
namespace oo;
use Exception;
use oo\db\Database;
use oo\db\DbModel;
use oo\Response; 
class Application{
    public string $layout='main';
    public static $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public static Application $app;
    public ?Controller $controller=NULL;
    public View $view;
    public Database $db;
    public ?DbModel $user=null;// it's might be null

    public string $userClass;

    public function __construct($rootPath,array $config){
         self::$ROOT_DIR=$rootPath;
         $this->request = new Request();
         $this->response=new Response();
         $this->session=new Session();
         $this->db=new Database($config['db']);
         $this->userClass=$config['userClass'];
         self::$app=$this;
         $this->router=new Router($this->request,$this->response);
        $this->view=new View();
         $primaryValue=$this->session->get('user');
         if($primaryValue){//test if primary key exists in the session

         $primaryKey=$this->userClass::primaryKey();
         $this->user= $this->userClass::findOne([$primaryKey=>$primaryValue]);
         }
    }
    
    public function run()
    {
        try{
             $this->router->resolve();
        }
        catch(Exception $e){
            $this->response->setStatusCode($e->getCode());
            $this->view->renderView('_error',[
                'exception'=>$e
            ]);
        }
    }

    public function getController(){
        return $this->controller;
    }
    public function setController(Controller $controller){
        return $this->controller=$controller;
    }

    public function login(DbModel $user){
      $this->user=$user;
      $primaryKey=$user->primaryKey();  
      $primaryValue=$user->{$primaryKey};
      $this->session->set('user',$primaryValue);
      return true;
    }
    public function logout(){
        $this->user=null;
        self::$app->session->remove('user');
        //$this->session->remove('user');
      }
    public static function isGuest(){
        return !self::$app->user;
    }
}