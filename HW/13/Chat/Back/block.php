<?php
include "../assets/filesystem.php";
$username = $_COOKIE["username"];
///Delete
// --------------------------------------------------------------------------
if (isset($_POST["username_of_block"])){

    $user_block=$_POST["username_of_block"];

    $user_jns = json_decode(read_file("users.json"), true);
    $user_jns[$user_block]["permission"]="blocked";
    write_file("users.json", json_encode($user_jns));
    header("Location: ../Front/index.php?user=$username");
};