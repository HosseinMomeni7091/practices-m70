<?php

namespace app\Core\db;


use PDO;

interface ConnectionInterface
{
    public static function getInstance();
    public function getConnection(): PDO;
}
