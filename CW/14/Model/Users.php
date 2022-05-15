<?php

namespace app\Model;

use app\Core\Model;



class Users extends Model
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
