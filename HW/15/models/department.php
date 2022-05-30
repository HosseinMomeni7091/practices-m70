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
class Department extends UserModel
{
    public int $id = 0;
    public string $name = '';


    public static function tableName(): string
    {
        // related database table name
        return 'departments';
    }

    public function attributes(): array
    {
        // will be used into insert data (register data) to DB
        return ['name'];
    }

    public function labels(): array
    {
        return [
            'name' => 'Name of Department'
        ];
    }

    public function rules()
    {
        return [
            'image' => [self::RULE_REQUIRED]
        ];
    }

    public function save()
    {

        // save according to DBModel 
        return parent::save();
    }

    public function getDisplayName(): string
    {
        return "";
    }
}
