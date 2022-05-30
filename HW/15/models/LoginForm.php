<?php

/**
 * User: TheCodeholic
 * Date: 7/25/2020
 * Time: 9:36 AM
 */

namespace app\models;

use core\Model;
use app\models\User;
use core\Application;


// use thecodeholic\phpmvc\Application;
// use thecodeholic\phpmvc\Model;

/**
 * Class LoginForm
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package app\models
 */
class LoginForm extends Model
{
    public string $username = '';
    public string $password = '';

    public function rules()
    {
        return [
            'username' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function labels()
    {
        return [
            'username' => 'Username',
            'password' => 'Password'
        ];
    }

    public function login($username, $password)
    {
        // search by name 
        // get
        $users = User::do();
        $tableName = $users::tableName();
        Application::$app->db->table($tableName);
        // find data from DB and show in output
        $user = $users->find($username, "username");
        // echo '<pre> userfind from login form';
        // print_r($user);
        // echo '</pre>' . '<br>';

        // is exist user with name
        if (!$user) {
            $this->addError('email', 'User does not exist with this username');
            return false;
        }

        // check pass
        if (password_verify($password, $user[0]["password"])) {
            // Set Cookie
            Application::$app->cookie->setCK("id", $user[0]["ID"]);
            $key=Application::$app->userClass::primaryKey();
            // echo "key:".$key;
            // echo "value , id:".$user[0]["ID"];
            Application::$app->session->set($key,$user[0]["ID"]);
            // echo '<pre>';
            // print_r($_SESSION);
            // echo '</pre>'.'<br>';
            // exit;
            return $user[0];
        }
        
        // wrong pass
        $this->addError('password', 'Password is incorrect');
        return false;




        // //get info records from DB consist of password - search according to email(not username)
        // $user = User::findOne(['username' => $this->username]);
        // if (!$user) {//if user not not found with this charectristics
        //     $this->addError('email', 'User does not exist with this username');
        //     return false;
        // }
        // // Ich denke ob es richtig oder falsch ist? it is better to print $user to know completely
        // //check passroed accoding to find records
        // if (!password_verify($this->password, $user->password)) {
        //     $this->addError('password', 'Password is incorrect');
        //     return false;
        // }

        // return Application::$app->login($user);
    }
}
