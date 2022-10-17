<?php
namespace oo\db;
use Attribute;
use oo\Model;
use oo\Application;

abstract class DbModel extends Model{
    abstract public static function tableName(): string;
    abstract function attributes():array;
    abstract public static function primaryKey():string;
    public function save(){ //it takes the model attributes and save it in the database
        $tableName=$this->tableName();
        $attributes=$this->attributes();
        $params=array_map(fn($m)=>':'.$m,$attributes);

        $statment=self::prepare("INSERT INTO $tableName (".implode(',',$attributes).") VALUES (".implode(',',$params).")");
        foreach($attributes as $attribute){
            $statment->bindValue(":$attribute",$this->{$attribute});
        }
        $statment->execute();
        return true;
    }

    public static function prepare($sql){
        return Application::$app->db->pdo->prepare($sql);
    }

    public static function findOne($where)// [email=>zura@example.com,firstname=>zura]
    {
        $tableName=static::tableName();//User class tableName will be called
        $attributes=array_keys($where);
        $sql = implode("AND ", array_map(fn($attr)=>"$attr = :$attr",$attributes));
        //SELECT * FROM $tableName WHERE email= :email AND firstname = :firstname
        $statement=self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach($where as $key =>$item){
            $statement->bindValue(":$key",$item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);//this will gives us an instance of the user class

    }

}