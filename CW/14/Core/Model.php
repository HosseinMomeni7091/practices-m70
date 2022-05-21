<?php

namespace app\Core;

abstract class Model
{
    private $db;
    public function __construct()
    {
        $this->tableName();
        $this->db = Application::$app->getInstanceOfClasses("db")->table($this->table);
    }
    //mandatory function
    public abstract function tableName();

    public static function do()
    {
        return new static;
    }


    // which table this model should work on
    protected $table;
    // return all records
    public function all()
    {
        return $this->db->select()->fetchAll();
    }



    // return the record
    public function find(string $value, string $col = 'id')
    {
        return  $this->db->select()->where($col, $value)->fetchAll();
    }


    
    // make a new recorde 
    public function create(array $data)
    {
        return $this->db->insert($data)->exec(); //statment;
    }
    public function delete(string $val1, string $val2, string $operation = '=')
    {
        return $this->db->delete()->where($val1, $val2, $operation)->exec();
    }
    public function where($oprand1, $oprand2, $operation = '='): self
    {
        return $this->db->where($oprand1, $oprand2, $operation);
    }
    // return all the filtered  records by where method
    public function get()
    {
        return $this->db->fetchAll();
    }
    public function update(array $data, string $val1, string $val2, string $operation = '=')
    {
        return $this->db->update($data)->where($val1,  $val2,  $operation)->exec();
    }
}
