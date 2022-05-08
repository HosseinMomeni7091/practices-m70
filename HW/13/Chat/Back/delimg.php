<?php
include "../assets/filesystem.php";
include_once "../Storage/DB/DatabaseConnectionInterface.php";
include_once "../Storage/DB/MySqlDatabaseConnection.php";
include_once "../Storage/DB/DatabaseInterface.php";
include_once "../Storage/DB/MySqlDatabase.php";
$username = $_COOKIE["username"];
///Delete
// --------------------------------------------------------------------------
if ($_POST["index"]!=""){

    $index=$_POST["index"];

    $StorageMethod = json_decode(read_file("config.json"), true);
    if ($StorageMethod["Save_mode"] == "DB") {
        $index=$_POST["index"];
        $connection = MySqlDatabaseConnection::getInstance();
        $pdo1 = $connection->getConnection('localhost', 'root', '', 'chatroom');
        $stmt = $pdo1->prepare("SELECT Profile_images.image_id from Profile_images  join Users on Profile_images.username=Users.username where Users.username=?");
        $stmt->execute($username);
        $profile_info0 = $stmt->fetchAll();
        $all_profile=array($profile_info0["0"])[0];
        $genu_image_id=$all_profile[$index];


        $stmt = $pdo1->prepare("SELECT Users.main_profile_image from Users where Users.username=?");
        $stmt->execute($username);
        $profile_info0 = $stmt->fetchAll();
        $main_profile=$profile_info0[0];

        if ($main_profile==$index){
            $stmt = $pdo1->prepare("DELETE from Profile_images where image_id=?");
            $stmt->execute($$genu_image_id);
            $profile_info0 = $stmt->fetchAll();
            if (count($all_profile)!=0){
                $stmt = $pdo1->prepare("UPDATE Users set main_profile_image='0' where Users.username=?");
                $stmt->execute($username);
                $profile_info0 = $stmt->fetchAll();
            }else{
                $stmt = $pdo1->prepare("UPDATE Users set main_profile_image=' ' where Users.username=?");
                $stmt->execute($username);
                $profile_info0 = $stmt->fetchAll();
            }
        }else{
            $stmt = $pdo1->prepare("DELETE from Profile_images where image_id=?");
            $stmt->execute($$genu_image_id);
            $profile_info0 = $stmt->fetchAll();
        }
        header("Location: ../Front/index.php?user=$username");

    }else{
        $user_array = json_decode(read_file("users.json"), true);
        if ($user_array[$username]["main_profile_image"][0]==$index){
            unset($user_array[$username]["other_profile_image"][$index]);
            if (count($user_array[$username]["other_profile_image"])!=0){
                $user_array[$username]["main_profile_image"][0]=array_key_first($user_array[$username]["other_profile_image"]);
            }else{
                $user_array[$username]["main_profile_image"]=[];
            }
        }else{
            unset($user_array[$username]["other_profile_image"][$index]);
        }
        write_file("users.json", json_encode($user_array));
        header("Location: ../Front/index.php?user=$username");
    }

};