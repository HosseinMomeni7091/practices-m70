<?php
include "../assets/filesystem.php";
$username = $_COOKIE["username"];
///Delete
// --------------------------------------------------------------------------
if (isset($_POST["index"])){

    $index=$_POST["index"];
    $action=$_POST["jaction"];

    $totalchat = json_decode(read_file('chatroom.json'), true);
    unset($totalchat[$index]);
    write_file('chatroom.json', json_encode($totalchat));
    header("Location: ../Front/index.php?user=$username");

};