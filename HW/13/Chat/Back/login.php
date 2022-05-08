<?php 

include "../assets/filesystem.php";
include_once "../Storage/DB/DatabaseConnectionInterface.php";
include_once "../Storage/DB/MySqlDatabaseConnection.php";
include_once "../Storage/DB/DatabaseInterface.php";
include_once "../Storage/DB/MySqlDatabase.php";

$username = $_POST['username'];
$password = $_POST['password'];

$StorageMethod = json_decode(read_file("config.json"), true);
if ($StorageMethod["Save_mode"] == "DB") {
    $connection = MySqlDatabaseConnection::getInstance();
    $pdo1 = $connection->getConnection('localhost', 'root', '', 'chatroom');
    $stmt = $pdo1->prepare("SELECT * FROM Users ;");
    $stmt->execute();
    $users_info0 = $stmt->fetchAll();
    $users_info = [];
    foreach ($users_info0 as $key => $value) {
        $users_info[$value["username"]]=$value;
    }
    $user = $users_info[$username];
    
    if (empty($user)) {
        setcookie("user_error", "This username doesn't exist, Please first do registeration then login",['expires' => time() + 2,"path"=>"/"]);
        header("Location: ../Front/login.php");
        die();
    }
    
    if ($user['password'] == $password) {
        setcookie("username", $username,["path"=>"/"]);
        header("Location: ../Front/index.php?user=$username");
        exit;
    } else {
        setcookie("pass_error", "your password isn't correct, please try again",['expires' => time() + 2,"path"=>"/"]);
        header("Location: ../Front/login.php");
        die();
       
    }
}else{
    $users = json_decode(read_file('users.json'), true);

    $user = $users[$username];
    
    if (empty($user)) {
        setcookie("user_error", "This username doesn't exist, Please first do registeration then login",['expires' => time() + 2,"path"=>"/"]);
        header("Location: ../Front/login.php");
        die();
    }
    
    if ($user['password'] == $password) {
        setcookie("username", $username,["path"=>"/"]);
        header("Location: ../Front/index.php?user=$username");
        exit;
    } else {
        setcookie("pass_error", "your password isn't correct, please try again",['expires' => time() + 2,"path"=>"/"]);
        header("Location: ../Front/login.php");
        die();
       
    }



}



