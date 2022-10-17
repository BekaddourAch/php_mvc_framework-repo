<?php
namespace oo\db;
use PDO;
use oo\Application;
class Database{
  
public PDO $pdo;

    public function __construct(array $config){
        $host=$config['pdo'];
        $user=$config['user'];
        $password=$config['password'];
        $this->pdo=new PDO($host,$user,$password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }  

    public function applyMigrations(){
        $this->createMigrationsTable();
        $appliedMigrations=$this->getAppliedMigrations();

        $newMigrations=[];
        $files =scandir(Application::$ROOT_DIR.'/migrations');
        $toApplyMigrations=array_diff($files,$appliedMigrations);
        
        foreach($toApplyMigrations as $migration){
            if($migration === '.' || $migration === '..'){
                continue;
            }

            require_once Application::$ROOT_DIR.'\migrations\\'.$migration;
            $classname=pathinfo($migration,PATHINFO_FILENAME);

            $instance = new $classname();
            $this->log("Applying migration $migration".PHP_EOL);
            $instance->up();
            
            $this->log("Applyed migration $migration".PHP_EOL);
            $newMigrations[]=$migration;

           
        }
         if(!empty($newMigrations)){
                $this->saveMigrations($newMigrations);
            }else{
                $this->log("All migrations are applied");
            }
        echo '----------------------------'.PHP_EOL;      
echo '<pre>';
        var_dump($newMigrations);
        echo '</pre>';
        
        echo '----------------------------'.PHP_EOL;      
    }
    public function createMigrationsTable(){
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )  ENGINE=INNODB;");
    }
    public function getAppliedMigrations(){
        $statments=$this->pdo->prepare("SELECT migration FROM migrations");
        $statments->execute();
        return $statments->fetchAll(PDO::FETCH_COLUMN);
        // $files=scandir(Application::$ROOT_DIR.'/migrations');
        // echo '<pre>';
        // var_dump($files);
        // echo '</pre>';
        //exit;
    }

    public function saveMigrations(array $migrations){
        $str=implode(",",array_map(fn($m)=>"('$m')",$migrations));
        
        $statment=$this->pdo->prepare("INSERT INTO  migrations (migration) VALUES $str");
        $statment->execute();
        echo '********************************************************************'.PHP_EOL;
        echo '<pre>';
        var_dump($str);
        echo '</pre>';
        echo '********************************************************************'.PHP_EOL;
    }


    protected function log($message){
        echo '['.date('Y-m-d H:i:s').'] - '.$message.PHP_EOL;
   }
   public function prepare($sql){
    return $this->pdo->prepare($sql);
   }


}