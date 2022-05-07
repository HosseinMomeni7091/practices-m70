<?php 

include "../assets/filesystem.php";

$username = $_POST['username'];
$password = $_POST['password'];

$users = json_decode(read_file('users.json'), true);

$user = $users[$username];

if (empty($user)) {
    setcookie("user_error", "This username doesn't exist, Please first do registeration then login",['expires' => time() + 2,"path"=>"/"]);
    header("Location: ../Front/login.php");
    die();
}

if ($user['password'] == $password) {
    setcookie("username", $username,["path"=>"/"]);
    header("Location: ../Front/index.php?user=$username");
    exit;
} else {
    setcookie("pass_error", "your password isn't correct, please try again",['expires' => time() + 2,"path"=>"/"]);
    header("Location: ../Front/login.php");
    die();
   
}

