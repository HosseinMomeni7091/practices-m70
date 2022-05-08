<?php
include "../assets/filesystem.php";
include_once "../Storage/DB/DatabaseConnectionInterface.php";
include_once "../Storage/DB/MySqlDatabaseConnection.php";
include_once "../Storage/DB/DatabaseInterface.php";
include_once "../Storage/DB/MySqlDatabase.php";
$username = $_COOKIE["username"];
///Edit Main profile image
// --------------------------------------------------------------------------

if ($_POST["index"]!=""){
    $StorageMethod = json_decode(read_file("config.json"), true);
    if ($StorageMethod["Save_mode"] == "DB") {
        $index=$_POST["index"];
        $connection = MySqlDatabaseConnection::getInstance();
        $pdo1 = $connection->getConnection('localhost', 'root', '', 'chatroom');
        $stmt = $pdo1->prepare("SELECT * FROM Users ;");
        $stmt->execute();
        $users_info0 = $stmt->fetchAll();
        $users_info = [];
        foreach ($users_info0 as $key => $value) {
            $users_info[$value["username"]]=$value;
        }
        $users_info[$username]["main_profile_image"]=$index;
        header("Location: ../Front/index.php?user=$username");


    }else{
        $index=$_POST["index"];
        $user_array = json_decode(read_file("users.json"), true);
        $user_array[$username]["main_profile_image"][0]=$index;
        write_file("users.json", json_encode($user_array));
        header("Location: ../Front/index.php?user=$username");
    }

};