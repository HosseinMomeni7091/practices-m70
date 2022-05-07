<?php

echo "Allah";
include "../assets/filesystem.php";
define("STORAGE_PATH", "C:/xampp/htdocs/Train/CW/CW15.1400.12.27/Storage/upload/");
$username = $_COOKIE["username"];
echo "Upload file.php";
echo '<pre>';
print_r($_FILES);
echo '</pre>'.'<br>';


// File
// --------------------------------------------------------------------------
if (isset($_FILES["myfile"])){
    // upload file
    echo '<pre>';
    die (print_r($_FILES));
    echo '</pre>'.'<br>';
    $imgname=$_FILES["myfile"]["name"];
    $temp=$_FILES["myfile"]["tmp_name"];
    $target_file = "C:/xampp/htdocs/Train/CW/CW15.1400.12.27/Storage/upload/".$imgname;
    echo $target_file;
    move_uploaded_file($temp, $target_file);
    
    
    // $massage = $target_file;
    // $chat_massage = compact("username", "massage");  
    // $totalchat = json_decode(read_file('chatroom.json'), true);
    // $totalchat[] = $chat_massage;
    
    // write_file('chatroom.json', json_encode($totalchat));
    header("Location: ../Front/index.php?user=$username?user=$target_file");
      
}