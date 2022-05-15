<?php

namespace app\Core\db;


use PDO;

class MySqlDatabase implements DatabaseInterface
{
    private PDO $db;
    private string $table;
    private string $query;
    private array $fields = [];

    public function __construct(ConnectionInterface $connection)
    {
        $this->db = $connection->getConnection();
    }

    // Add table name in the first place
    public function table(string $table): DatabaseInterface
    {
        $this->table = $table;
        return $this;
    }

    // Create table then exec
    public function create()
    {
        $this->query = "CREATE TABLE IF NOT EXISTS {$this->table}";
        return $this;
    }

    // Drop table then exec
    public function drop()
    {
        $this->query = "DROP TABLE {$this->table}";
        return $this;
    }

    // SELECT array $cols from table then fetch or fetchAll
    public function select(array $cols = ['*']): DatabaseInterface
    {
        $this->query =
            "SELECT " . implode(",", $cols) .
            " FROM " . $this->table;
        return $this;
    }

    // SELECT array $cols from table then fetch or fetchAll
    public function insert(array $fields): DatabaseInterface
    {
        $this->fields = $fields;
        $params = array_map(fn ($v) => ":$v", array_keys($fields));
        $this->query =
            "INSERT INTO " . $this->table .
            "(" . implode(",", array_keys($fields)) . ") " .
            "VALUES (" . implode(",", $params) . ")";
        return $this;
    }

    public function update(array $fields): DatabaseInterface
    {
        $this->fields = $fields;

        $arr = array_map(
            fn ($key) => "$key = :$key",
            array_keys($fields),
        );

        $this->query = "UPDATE " . $this->table . " SET " . implode(",", $arr);

        return $this;
    }

    public function where(string $val1, string $val2, string $operation = '='): DatabaseInterface
    {
        $this->where = [
            $val1, $val2, $operation
        ];

        // NOTE: WE CAN ADD OR WHERE 
        // NOTE: WE CAN ADD AND WHERE
        $this->query .= " WHERE $val1 $operation '$val2'";
        return $this;
    }

    public function fetch()
    {
        $statement = $this->db->prepare($this->query);
        foreach ($this->fields as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }

    public function fetchAll()
    {
        $statement = $this->db->prepare($this->query);
        foreach ($this->fields as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function exec(): bool
    {
        $statement = $this->db->prepare($this->query);
        foreach ($this->fields as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        return $statement->execute();
    }
    public function delete(): DatabaseInterface
    {
        $this->query =
            "DELETE FROM" .$this->table ;
        return $this;
    }
}
