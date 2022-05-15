<?php

namespace app\Model;

use app\Core\Model;



class Tasks extends Model
{
    public $name='';
    public $lastname='';
    public $password='';

    public function tableName()
    {
        $this->table="Users";
        // return "Users";
    }
}
