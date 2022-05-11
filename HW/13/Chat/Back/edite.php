<?php
include "../assets/filesystem.php";
include_once "../Storage/DB/DatabaseConnectionInterface.php";
include_once "../Storage/DB/MySqlDatabaseConnection.php";
include_once "../Storage/DB/DatabaseInterface.php";
include_once "../Storage/DB/MySqlDatabase.php";
$username = $_COOKIE["username"];
///Edite
// --------------------------------------------------------------------------
if (isset($_POST["index"])){

    $index=$_POST["index"];
    $edit=$_POST["edit"];

    $StorageMethod = json_decode(read_file("config.json"), true);
    if ($StorageMethod["Save_mode"] == "DB") {
        $index=$_POST["index"];
        $connection = MySqlDatabaseConnection::getInstance();
        $pdo1 = $connection->getConnection('localhost', 'root', '', 'chatroom');
        $stmt = $pdo1->prepare("UPDATE Chatroom Set massage=? where massage_id=?");
        $stmt->execute([$edit,$index]);
        $chat_info0 = $stmt->fetchAll();
        header("Location: ../Front/index.php?user=$username");

    }else{

    $totalchat = json_decode(read_file('chatroom.json'), true);
    $totalchat[$index]["massage"]=$edit;
    write_file('chatroom.json', json_encode($totalchat));
    header("Location: ../Front/index.php?user=$username");
    }

};