<?php

namespace app\Model;

use app\Core\Model;



class Tasks extends Model
{
    public $Subject='';
    public $Deadline='';
    public $Color='';
    public $Description='';
    public $Status='';

    public function tableName()
    {
        return $this->table="Tasks";
        // return "Users";
    }
}
