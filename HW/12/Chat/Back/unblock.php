<?php
include "../assets/filesystem.php";
$username = $_COOKIE["username"];
///Delete
// --------------------------------------------------------------------------
if (isset($_POST["username_of_unblock"])){

    $user_block=$_POST["username_of_unblock"];

    $StorageMethod = json_decode(read_file("config.json"), true);
    if ($StorageMethod["Save_mode"] == "DB") {
        $index=$_POST["index"];
        $connection = MySqlDatabaseConnection::getInstance();
        $pdo1 = $connection->getConnection('localhost', 'root', '', 'chatroom');
        $stmt = $pdo1->prepare("UPDATE Users set permission='user' where username=? ");
        $stmt->execute($user_block);
        $block_info = $stmt->fetchAll();
        header("Location: ../Front/index.php?user=$username");
    }else{
        $user_jns = json_decode(read_file("users.json"), true);
        $user_jns[$user_block]["permission"]="user";
        write_file("users.json", json_encode($user_jns));
        header("Location: ../Front/index.php?user=$username");

    }

};