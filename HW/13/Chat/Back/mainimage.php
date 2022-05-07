<?php
include "../assets/filesystem.php";
$username = $_COOKIE["username"];
///Edit Main profile image
// --------------------------------------------------------------------------
if ($_POST["index"]!=""){

    $index=$_POST["index"];
    $user_array = json_decode(read_file("users.json"), true);
    $user_array[$username]["main_profile_image"][0]=$index;
    write_file("users.json", json_encode($user_array));
    header("Location: ../Front/index.php?user=$username");

};