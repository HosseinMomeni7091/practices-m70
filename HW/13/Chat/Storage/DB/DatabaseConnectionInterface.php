<?php

interface DatabaseConnectionInterface
{
	public static function getInstance();
	public function getConnection(string $host, string $user, string $password, string $dbname): PDO;
	public function getPDO();

}
