<?php
include "../assets/filesystem.php";
$username = $_COOKIE["username"];
///Edite
// --------------------------------------------------------------------------
if (isset($_POST["index"])){

    $index=$_POST["index"];
    $edit=$_POST["edit"];

    $totalchat = json_decode(read_file('chatroom.json'), true);
    $totalchat[$index]["massage"]=$edit;

    
    write_file('chatroom.json', json_encode($totalchat));
    header("Location: ../Front/index.php?user=$username");

};