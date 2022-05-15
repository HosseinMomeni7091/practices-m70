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
    public string $email = '';
    public string $password = '';

    public function rules()
    {
        return [
            'email' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function labels()
    {
        return [
            'email' => 'Your Email address',
            'password' => 'Password'
        ];
    }

    public function login()
    {   
        //get info records from DB consist of password - search according to email(not username)
        $user = User::findOne(['email' => $this->email]);
        if (!$user) {//if user not not found with this charectristics
            $this->addError('email', 'User does not exist with this email address');
            return false;
        }
        // Ich denke ob es richtig oder falsch ist? it is better to print $user to know completely
        //check passroed accoding to find records
        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }

        return Application::$app->login($user);
    }
}