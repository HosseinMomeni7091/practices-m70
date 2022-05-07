<?php
include "../assets/filesystem.php";
include "../assets/str.php";
$username = $_COOKIE["username"];

///Update profile
// --------------------------------------------------------------------------
// Upload picture
// --------------------------------------------------------------------------
if ($_FILES["file"]["name"]!=""){
    // upload file-------------------------------
    $fakename = str_random(5);
    $imgname=$_FILES["file"]["name"];
    preg_match_all("/\.\w+$/",$_FILES["file"]["name"],$all);
    $exten=$all[0][0];
    $temp=$_FILES["file"]["tmp_name"];
    $target_file = "C:/xampp/htdocs/Train/CW/CW15.1400.12.27/Storage/upload/".$fakename.$exten;
    echo $target_file;
    move_uploaded_file($temp, $target_file);
    
    // Json formation ----------------------------
    $imgaddress = $target_file;
    $user_jns = json_decode(read_file("users.json"), true);
    if (count($user_jns[$username]["other_profile_image"])<4){
        $user_jns[$username]["other_profile_image"][]=$imgaddress;
        if (count($user_jns[$username]["other_profile_image"])==1){
            $user_jns[$username]["main_profile_image"][]=0;
        }
    }else{
        echo ("You had 4 images before!!!!");
    };
    write_file("users.json", json_encode($user_jns));
}

if (($_POST["firstname"]!="")||($_POST["bio"]!="")){
    
    $user_jns = json_decode(read_file("users.json"), true);
    if ($_POST["firstname"]!=""){
        $user_firstname=$_POST["firstname"];
        $user_jns[$username]["name"]=$user_firstname;
    }
    if ($_POST["bio"]!=""){
        $user_bio=$_POST["bio"];
        $user_jns[$username]["bio"]=$user_bio;
    }
    write_file("users.json", json_encode($user_jns));
    header("Location: ../Front/index.php?user=$username");
};
header("Location: ../Front/index.php?user=$username?user=$target_file");