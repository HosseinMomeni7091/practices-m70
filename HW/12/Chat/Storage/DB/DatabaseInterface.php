<?php
interface DatabaseInterface {
	public function __construct(DatabaseConnectionInterface $connection);
	public function table(string $table) : DatabaseInterface;
	public function select(array $cols = ['*']) : DatabaseInterface;
      public function create(array $fields) : DatabaseInterface;
	public function update(array $fields) : DatabaseInterface;
  public function where(string $val1, string $val2, string $operation = '='): DatabaseInterface;
	public function fetch();
	public function fetchAll();
	public function execute() ;
}