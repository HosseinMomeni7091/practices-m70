<?php

/**
 * User: TheCodeholic
 * Date: 7/8/2020
 * Time: 9:15 AM
 */

namespace app\models;

use core\UserModel;
use app\db\DbModel;



/**
 * Class Register
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package app\models
 */
class User extends UserModel
{
    public int $id = 0;
    public string $name = '';
    public string $family = '';
    public string $position = '';
    public string $age = '';
    public string $email = '';
    public string $username = '';
    public string $password = '';
    public string $confirmation_status = "false";

    public static function tableName(): string
    {
        // related database table name
        return 'user';
    }

    public function attributes(): array
    {
        // will be used into insert data (register data) to DB
        return ['name', 'family','position','age','email', 'username', 'password'];
    }

    public function labels(): array
    {
        return [
            'name' => 'First name',
            'family' => 'Last name',
            'position' => 'Please select your position form list',
            'age' => 'Age',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password'
        ];
    }

    public function rules()
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'family' => [self::RULE_REQUIRED],
            'position' => [self::RULE_REQUIRED],
            'age' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'username' => [self::RULE_REQUIRED, 
                            [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]]
        ];
    }

    public function save()
    {
        // hash 
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        // save according to DBModel 
        return parent::save();
    }

    public function getDisplayName(): string
    {
        return $this->name . ' ' . $this->family;
    }
}
