<?php
include_once "DatabaseInterface.php";

trait Formatter
{

    protected function format(array $targets, string $prefix = '', string $starter = '', string $finisher = '', string $separator = ', ', string $side = '')
    {
        $string = $starter;

        foreach ($targets as $target) {

            $string .= $prefix . $side . $target . $side . $separator;
        }

        return preg_replace("/{$separator}$/", $finisher, $string);
    }

    protected function formatEquation($targets)
    {
        $string = '';

        foreach ($targets as $target)
            $string .= "`$target`=:$target,";

        return substr($string, 0, strlen($string) - 1);
    }

    public function formatSize(int $size)
    {

        if ($size > 1000 * 1000)
            return ((int)(($size / (1000 * 1000)) * 100)) / 100 . ' MB';
        else if ($size > 1000)
            return ((int)(($size / 1000) * 100)) / 100 . ' KB';
        else
            return $size . ' B';
    }
}



class MySqlDatabase implements DatabaseInterface
{
    private $connection;
    private $tableName;
    protected string $query = '';
    private $condition;
    protected array $data = [];
    private $stmt;

    public function __construct(DatabaseConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function table(string $table): DatabaseInterface
    {
        $this->tableName = $table;
        return $this;
    }

    public function select($targets = '*'): DatabaseInterface
    {
        $columns = is_array($targets) ? $this->format($targets) : $targets;
        $this->query = "SELECT {$columns} FROM {$this->tableName} ";

        return $this;


        // $stmt=$this->connection->getPDO()->prepare('SELECT :col FROM '.$this->table);

        // $stmt->execute("id");

        // $this->stmt=$stmt;

        // return $this;
    }
    public function create(array $fields): DatabaseInterface
    {
        return $this;
    }
    public function prepare(): DatabaseInterface
    {
        $this->stmt = $this->connection->getPDO()->prepare($this->query . $this->condition . ';');;
        // $stmt->execute(["col"=>$cols]);
        return $this;
    }
    
    public function update(array $fields): DatabaseInterface
    {
        return $this;
    }
    
    public function where(string $val1, string $val2, string $operation = '='): DatabaseInterface
    {
        return $this;
    }

    public function execute()
    {
        $this->prepare();
        if (count($this->data) == 0) {
            return $this->stmt->execute();
        }
        elseif (count($this->data) == 1) {
            return $this->stmt->execute($this->data[0]);
        } else {
            return $this->stmt->execute($this->data[0]);
        }
    }

    public function fetch()
    {
        $this->execute();
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function fetchAll()
    {
        $this->execute();
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
