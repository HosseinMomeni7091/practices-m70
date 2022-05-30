<?php

/**
 * User: TheCodeholic
 * Date: 7/10/2020
 * Time: 8:09 AM
 */

namespace core\db;


use core\Application;

/**
 * Class Database
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package thecodeholic\phpmvc
 */
class Database
{
    public \PDO $pdo;
    private string $table;
    private string $query;
    private array $fields = [];

    public function __construct($dbConfig = [])
    {
        $dbDsn = $dbConfig['dsn'] ?? '';
        $username = $dbConfig['user'] ?? '';
        $password = $dbConfig['password'] ?? '';

        $this->pdo = new \PDO($dbDsn, $username, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }


    
    // new added------------------------------------------
    // Add table name in the first place
    public function table(string $table)
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
    public function select(array $cols = ['*'])
    {
        $this->query =
            "SELECT " . implode(",", $cols) .
            " FROM " . $this->table;
        return $this;
    }


    public function join(array $cols = ['*'], $tablename1,$tablename2,$jointype,$ontable1, $ontable2)
    {
        $this->query =
            "SELECT " . implode(",", $cols) .
            " FROM " . $tablename1 ."  ". 
            "$jointype JOIN " . $tablename2 .
            " ON " .$tablename1 .".".$ontable1."=" .$tablename2 .".".$ontable2;
        return $this;
    }

    // SELECT array $cols from table then fetch or fetchAll
    public function insert(array $fields)
    {
        $this->fields = $fields;
        $params = array_map(fn ($v) => ":$v", array_keys($fields));
        $this->query =
            "INSERT INTO " . $this->table .
            "(" . implode(",", array_keys($fields)) . ") " .
            "VALUES (" . implode(",", $params) . ")";
        return $this;
    }

    public function update(array $fields)
    {
        $this->fields = $fields;

        $arr = array_map(
            fn ($key) => "$key = :$key",
            array_keys($fields),
        );

        $this->query = "UPDATE " . $this->table . " SET " . implode(",", $arr);

        return $this;
    }

    public function where(string $val1, string $val2, string $operation = '=')
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
        $statement = $this->pdo->prepare($this->query);
        foreach ($this->fields as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function fetchAll()
    {
        $statement = $this->pdo->prepare($this->query);
        foreach ($this->fields as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function exec(): bool
    {
        $statement = $this->pdo->prepare($this->query);
        foreach ($this->fields as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        return $statement->execute();
    }
    public function execFetch()
    {
        $statement = $this->pdo->prepare($this->query);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function delete()
    {
        $this->query =
            "DELETE FROM" . $this->table;
        return $this;
    }


    // migrations -----------------------------
    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR . '/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }

            require_once Application::$ROOT_DIR . '/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied migration $migration");
            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("There are no migrations to apply");
        }
    }

    protected function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )  ENGINE=INNODB;");
    }

    protected function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    protected function saveMigrations(array $newMigrations)
    {
        $str = implode(',', array_map(fn ($m) => "('$m')", $newMigrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES 
            $str
        ");
        $statement->execute();
    }

    public function prepare($sql): \PDOStatement
    {
        return $this->pdo->prepare($sql);
    }

    private function log($message)
    {
        echo "[" . date("Y-m-d H:i:s") . "] - " . $message . PHP_EOL;
    }
}
