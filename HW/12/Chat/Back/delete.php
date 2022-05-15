<?php
include "../assets/filesystem.php";
include_once "../Storage/DB/DatabaseConnectionInterface.php";
include_once "../Storage/DB/MySqlDatabaseConnection.php";
include_once "../Storage/DB/DatabaseInterface.php";
include_once "../Storage/DB/MySqlDatabase.php";
$username = $_COOKIE["username"];
///Delete
// --------------------------------------------------------------------------
if (isset($_POST["index"])){



    $StorageMethod = json_decode(read_file("config.json"), true);
    if ($StorageMethod["Save_mode"] == "DB") {
        $index=$_POST["index"];
        $connection = MySqlDatabaseConnection::getInstance();
        $pdo1 = $connection->getConnection('localhost', 'root', '', 'chatroom');
        $stmt = $pdo1->prepare("DELETE from Chatroom where Chatroom.massage_id=?");
        $stmt->execute($index);
        $del_info = $stmt->fetchAll();
        header("Location: ../Front/index.php?user=$username?massage_id=$index");

    }else{
        $index=$_POST["index"];
        $action=$_POST["jaction"];
    
        $totalchat = json_decode(read_file('chatroom.json'), true);
        unset($totalchat[$index]);
        write_file('chatroom.json', json_encode($totalchat));
        header("Location: ../Front/index.php?user=$username");
    }
};