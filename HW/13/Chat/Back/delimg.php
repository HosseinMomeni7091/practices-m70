<?php
include "../assets/filesystem.php";
$username = $_COOKIE["username"];
///Delete
// --------------------------------------------------------------------------
if ($_POST["index"]!=""){

    $index=$_POST["index"];
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

};