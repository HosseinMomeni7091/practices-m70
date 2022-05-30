<?php
/**
 * User: TheCodeholic
 * Date: 7/10/2020
 * Time: 9:19 AM
 */

namespace core\db;

use core\Model;
use core\Application;

/**
 * Class DbModel
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package thecodeholic\phpmvc
 */
abstract class DbModel extends Model
{
    abstract public static function tableName(): string;

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function save()
    {
        $tableName = $this->tableName();//tablename::user/loginform/profile

        // its very exited if it return all properties
        $attributes = $this->attributes();//name of properties of users/loginform/...
        // $attributes = ['firstname', 'lastname', 'email', 'password'];
        
        $params = array_map(fn($attr) => ":$attr", $attributes); 
        // $params = [':firstname', ':lastname', ':email', ':password'];
        

        $statement = self::prepare("INSERT INTO $tableName (" . implode(",", $attributes) . ") 
        VALUES (" . implode(",", $params) . ")");
        // users ("username,name, pass,age")
        // VALUES (":username, :name, :pass,:age")

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    public static function prepare($sql): \PDOStatement
    {
        return Application::$app->db->prepare($sql);
    }

    public static function findOne($where)
    {   //$where----->>>['email' => $this->email] (sample)
        $tableName = static::tableName();//output::user or loginform
        //which key/keys we must search according on==email/username or both of them
        $attributes = array_keys($where);
        // create condition according to requested data
        $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        // return all records that passed our conditions
        return $statement->fetchObject(static::class);
    }
}