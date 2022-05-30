<?php

/**
 * User: TheCodeholic
 * Date: 7/10/2020
 * Time: 9:19 AM
 */

namespace core\db;

use core\Model;
use app\models\User;
use app\models\Workingtimetabling;
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
        return 'ID';
    }

    public static function do()
    {
        return new static;
    }

    public function save()
    {
        $tableName = $this->tableName(); //tablename::user/loginform
        echo "tabl:::".$tableName;
        // exit;
        // its very exited if it return all properties
        $attributes = $this->attributes(); //name of properties of users/loginform/...
        // exit;
        // $attributes = ['firstname', 'lastname', 'email', 'password'];

        if ($tableName=="profile"){
            // echo "profile";
            $users = User::do();
            $tableName = static::tableName();
            Application::$app->db->table($tableName);
            // find data from DB and show in output
            $sess = (int) Application::$app->session->get('ID');
            $user = $users->find($sess, "user_id");

            if ($user==[]){
                $params = array_map(fn ($attr) => ":$attr", $attributes);
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
                
            }else{
                return true;
            }
            
        }

        if ($tableName=="workingtimetabling"){
            // echo "worktime";

            $users = Workingtimetabling::do();
            $tableName = static::tableName();
            Application::$app->db->table($tableName);
            // find data from DB and show in output
            $sess = (int) Application::$app->session->get('ID');
            $user = $users->find($sess, "user_id");

            if ($user==[]){
                $params = array_map(fn ($attr) => ":$attr", $attributes);
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
                
            }else{
                return true;
            }
            
        }
        // echo "continue";
        
        $params = array_map(fn ($attr) => ":$attr", $attributes);
        // $params = [':firstname', ':lastname', ':email', ':password'];
        $statement = self::prepare("INSERT INTO $tableName (" . implode(",", $attributes) . ") 
        VALUES (" . implode(",", $params) . ")");
        // users ("username,name, pass,age")
        // VALUES (":username, :name, :pass,:age");
        // echo '<pre>';
        // print_r($statement);
        // echo '</pre>'.'<br>';
        
        foreach ($attributes as $attribute) {
            // echo $this->{$attribute}."<br>";
           $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        // echo '<pre>';
        // print_r($statement);
        // echo '</pre>'.'<br>';
        // exit;

        return true;

    }



    public static function prepare($sql): \PDOStatement
    {
        return Application::$app->db->prepare($sql);
    }

    public static function findOne($where)
    {   //$where----->>>['email' => $this->email] (sample)
        $tableName = static::tableName(); //output::user or loginform
        //which key/keys we must search according on==email/username or both of them
        $attributes = array_keys($where);
        // create condition according to requested data
        $sql = implode("AND", array_map(fn ($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        // return all records that passed our conditions
        return $statement->fetchObject(static::class);
    }


    // new methods for login and cookie---------------------
    public function isLogin() //must be checked in each page

    {
        // getcookie
        $id = Application::$app->cookie->getCK("id") ?? null;
        if ($id)

            return true / false; //boolean
    }


    public function user() //for print name and family of current user and etc.
    {
        // get id from cookie
        $id = Application::$app->cookie->getCK("id");

        // return all user info 
        $users = User::do();
        return $users->find($id, "id");
    }


    public function login($name, $password) //or input can be email and pass
    {
        // search by name 
        // get
        $users = User::do();
        $tableName = static::tableName();
        Application::$app->db->table($tableName);
        // find data from DB and show in output
        $user = $users->find($name, "name");
        echo '<pre>';
        print_r($user);
        echo '</pre>' . '<br>';

        // is exist user with name
        if (!$user) {
            return false;
        }

        // check pass
        if (!password_verify($password, $user[0]["password"])) {
            // Set Cookie
            Application::$app->cookie->setCK("id", $user[0]["ID"]);
            return $user[0];
        }

        // wrong pass
        return false;
    }

    // new methods for working with DB -----------------------------------
    // return all records
    public function all()
    {
        return Application::$app->db->select()->fetchAll();
    }

    // return the record
    public function find(string $value, string $col = 'id')
    {
        return  Application::$app->db->select()->where($col, $value)->fetchAll();
    }

    // return the record
    public function selectCol(array $cols = ['*'])
    {
        return  Application::$app->db->select($cols)->fetchAll();
    }


    public function Join(array $cols = ['*'], $tablename1,$tablename2,$jointype,$ontable1, $ontable2, $val1="",$val2="")
    {
        if ($val1==""&&$val2==""){
            return  Application::$app->db->join($cols, $tablename1,$tablename2,$jointype,$ontable1, $ontable2)->execFetch();
        }
        return  Application::$app->db->join($cols, $tablename1,$tablename2,$jointype,$ontable1, $ontable2)->where($val1, $val2)->execFetch();
    }

    // make a new recorde 
    public function create(array $data)
    {
        return Application::$app->db->insert($data)->exec(); //statment;
    }
    public function delete(string $val1, string $val2, string $operation = '=')
    {
        return Application::$app->db->delete()->where($val1, $val2, $operation)->exec();
    }
    public function where($oprand1, $oprand2, $operation = '='): self
    {
        return Application::$app->db->where($oprand1, $oprand2, $operation);
    }
    // return all the filtered  records by where method
    public function get()
    {
        return Application::$app->db->fetchAll();
    }
    public function update(array $data, string $val1, string $val2, string $operation = '=')
    {
        return Application::$app->db->update($data)->where($val1,  $val2,  $operation)->exec();
    }
}
