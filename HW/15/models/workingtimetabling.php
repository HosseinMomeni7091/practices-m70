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
class Workingtimetabling extends UserModel
{
    // public int $id = 0;
    public  $user_id = 0;
    public  $sat_start = 0;
    public  $sat_end = 0;
    public  $sun_start = 0;
    public  $sun_end = 0;
    public  $mon_start = 0;
    public  $mon_end = 0;
    public  $tues_start = 0;
    public  $tues_end = 0;
    public  $wendes_start = 0;
    public  $wendes_end = 0;
    public  $thurs_start = 0;
    public  $thurs_end = 0;
    public  $fri_start = 0;
    public  $fri_end = 0;

    public static function tableName(): string
    {
        // related database table name
        return 'workingtimetabling';
    }

    public function attributes(): array
    {
        // will be used into insert data (register data) to DB
        return ["user_id","sat_start",'sat_end', 'sun_start','sun_end','mon_start','mon_end', 'tues_start', 'tues_end','wendes_start','wendes_end','thurs_start','thurs_end',"fri_start","fri_end"];
    }
    public function labels(): array
    {
        return [
        ];
    }
    public function rules()
    {
        return [
            'sat_start' => [],
            'sat_end' => [],
            'sun_start' => [],
            'sun_end' => [],
            'mon_start' => [],
            'mon_end' => [],
            'tues_start' => [],
            'tues_end' => [],
            'wendes_start' => [],
            'wendes_end' => [],
            'thurs_start' => [],
            'thurs_end' => [],
            'fri_start' => [],
            'fri_end' => []
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
