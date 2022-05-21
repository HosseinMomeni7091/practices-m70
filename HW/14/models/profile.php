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
class Profile extends UserModel
{
    public int $id = 0;
    public string $user_id = '';
    public string $image = '';
    public string $medical_licence = '';
    public string $department = '';
    public string $degree = '';
    public string $working_field = '';
    public string $exprience = '';
    public string $graduated_university = '';

    public static function tableName(): string
    {
        // related database table name
        return 'profile';
    }

    public function attributes(): array
    {
        // will be used into insert data (register data) to DB
        return ['image', 'medical_licence','department','degree','working_field', 'exprience', 'graduated_university'];
    }

    public function labels(): array
    {
        return [
            'image' => 'Upload your profile picture',
            'medical_licence' => 'Medical licence No.',
            'department' => 'Please select your department form list',
            'degree' => 'Degree',
            'working_field' => 'Field',
            'exprience' => 'Expreience',
            'graduated_university' => 'University'
        ];
    }

    public function rules()
    {
        return [
            'image' => [],
            'medical_licence' => [self::RULE_REQUIRED],
            'department' => [self::RULE_REQUIRED],
            'degree' => [self::RULE_REQUIRED],
            'working_field' => [self::RULE_REQUIRED],
            'exprience' => [self::RULE_REQUIRED],
            'graduated_university' => [self::RULE_REQUIRED]
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
