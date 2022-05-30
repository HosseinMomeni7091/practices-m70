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
class Reservation extends UserModel
{
    // public int $id = 0;
    public  $patient_id = '';
    public  $doctor_id = '';
    public  $day = '';
    public  $time = '';


    public static function tableName(): string
    {
        // related database table name
        return 'reservation';
    }

    public function attributes(): array
    {
        // will be used into insert data (register data) to DB
        return ["patient_id",'doctor_id', 'day','time'];
    }

    public function labels(): array
    {
        return [

        ];
    }

    public function rules()
    {
        return [
            'patient_id' => [],
            'doctor_id' => [],
            'day' =>[],
            'time' =>[]
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
