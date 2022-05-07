<?php
include_once "DatabaseConnectionInterface.php";
include_once "MySqlDatabaseConnection.php";
include_once "DatabaseInterface.php";
include_once "MySqlDatabase.php";


$connection = MySqlDatabaseConnection::getInstance();
$pdo1 = $connection->getConnection('localhost', 'root', '', 'chatroom');

$stmt = $pdo1->prepare('SELECT * FROM Users');
$stmt->execute();
$result = $stmt->fetchAll();

echo '<pre>';
print_r($result);
echo '</pre>'.'<br>';


//.................................................
// an object of DatabaseConnectionInterface
// $query1 = new MySqlDatabase($connection);
// $users = $query1->table('Users')->select()->fetchAll(); // get all users

// $query2 = new MySqlDatabase($connection);
// $user = $query2->table('users')->select()->where('id', 56)->fetch(); // get user by id = 56

// $query3 = new MySqlDatabase($connection);
// $newUser = ['name' => 'mohammad', 'lastname' => 'shabani'];
// $query3->table('users')->create($newUser)->exec();
//..........................................................