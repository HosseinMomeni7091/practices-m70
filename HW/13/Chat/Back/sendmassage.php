<?php
include "../assets/filesystem.php";
include "../assets/str.php";
include_once "../Storage/DB/DatabaseConnectionInterface.php";
include_once "../Storage/DB/MySqlDatabaseConnection.php";
include_once "../Storage/DB/DatabaseInterface.php";
include_once "../Storage/DB/MySqlDatabase.php";

$username = $_COOKIE["username"];
echo '<pre>';
print_r($_FILES);
echo '</pre>'.'<br>';
// File
// --------------------------------------------------------------------------
if ($_FILES["file"]["name"]!=""){
  


    // upload file
    $fakename = str_random(5);
    $imgname=$_FILES["file"]["name"];
    preg_match_all("/\.\w+$/",$_FILES["file"]["name"],$all);
    $exten=$all[0][0];
    $temp=$_FILES["file"]["tmp_name"];
    $target_file = __DIR__."/../Storage/upload/".$fakename.$exten;
    echo $target_file;
    move_uploaded_file($temp, $target_file);
    
    //storage method
    $StorageMethod = json_decode(read_file("config.json"), true);
    if ($StorageMethod["Save_mode"] == "DB") {
        $connection = MySqlDatabaseConnection::getInstance();
        $pdo1 = $connection->getConnection('localhost', 'root', '', 'chatroom');

        //add user as viewer to DB------------------------
        $stmt6 = $pdo1->prepare("INSERT INTO Chatroom (username,massage)
        VALUES (?,?);");
        $stmt6->execute([$username, $target_file]);
        $result_pdo2 = $stmt6->fetchAll();
        header("Location: ../Front/index.php?user=$username?user=$target_file");

    }else{
        $massage = $target_file;
        $chat_massage=[
            'username' => $username,
            'massage' => $massage,
            'seen_by'=>[],
        ];
        $totalchat = json_decode(read_file('chatroom.json'), true);
        $totalchat[] = $chat_massage;
        
        write_file('chatroom.json', json_encode($totalchat));
        header("Location: ../Front/index.php?user=$username?user=$target_file");
    }
      
}
// Message
// --------------------------------------------------------------------------
if ($_POST["massage"]!="") {
    
    $massage = $_POST["massage"];
    $StorageMethod = json_decode(read_file("config.json"), true);
    if ($StorageMethod["Save_mode"] == "DB") {
        $connection = MySqlDatabaseConnection::getInstance();
        $pdo1 = $connection->getConnection('localhost', 'root', '', 'chatroom');
        $stmt6 = $pdo1->prepare("INSERT INTO Chatroom (username,massage)
        VALUES (?,?);");
        $stmt6->execute([$username, $massage]);
        $result_pdo2 = $stmt6->fetchAll();
        header("Location: ../Front/index.php?user=$username");
    }else{

        $chat_massage=[
            'username' => $username,
            'massage' => $massage,
            'seen_by'=>[],
        ];
        $chat = [$_COOKIE["username"] => $chat_massage];
        
        $totalchat = json_decode(read_file('chatroom.json'), true);
        $totalchat[] = $chat_massage;
        
        write_file('chatroom.json', json_encode($totalchat));
        header("Location: ../Front/index.php?user=$username");

    }

}

if (($_POST["massage"]=="")&&($_FILES["file"]["name"]=="")) {
header("Location: ../Front/index.php?user=$username");
}