<?php
include "../assets/filesystem.php";
$pas="../Storage/";
include_once "../Storage/DB/DatabaseConnectionInterface.php";
include_once "../Storage/DB/MySqlDatabaseConnection.php";
include_once "../Storage/DB/DatabaseInterface.php";
include_once "../Storage/DB/MySqlDatabase.php";

// get data and add to users.json file
// -------------------------------------------------------------------
$name=$_POST["name"];
$email=$_POST["email"];
$username=$_POST["username"];
$password=$_POST["password"];

// validation--------------------------------
$namelen=strlen($name);
$minname=0;
$maxname=0;
$usernamelen=strlen($username);
$minusername=0;
$maxusername=0;
$passlen=strlen($password);
$minpass=0;
$maxpass=0;

// length check-------------------------------------
// name-----
if (32<$namelen){
    setcookie("name_error","length of your name must be up to 32 characters ",['expires' => time() + 6,"path"=>"/"]);
    $maxname=1;
}
if ($namelen<3){
    setcookie("name_error","length of your name must be minimum 3 characters ",['expires' => time() + 6,"path"=>"/"]);
    $minname=1;
}
// username-----
if (32<$usernamelen){
    setcookie("user_error","length of your username must be up to 32 characters ",['expires' => time() + 6,"path"=>"/"]);
    $maxusername=1;
}
if ($usernamelen<3){
    setcookie("user_error","length of your username must be minimum 3 characters ",['expires' => time() + 6,"path"=>"/"]);
    $minusername=1;
}
// password-----
if (32<$passlen){
    setcookie("pass_error","length of your password must be up to 32  characters ",['expires' => time() + 6,"path"=>"/"]);
    $maxpass=1;
}
if ($passlen<4){
    setcookie("pass_error","length of your password must be minimum 4 characters ",['expires' => time() + 6,"path"=>"/"]);
    $minpass=1;
}

// Valid Character----------
// name
$pattern = "/^\s*[a-z ]*\s*$/";
$name_pattern=preg_match_all($pattern, $name);
if (!$name_pattern){
    setcookie("pname_error","Your name can only contain lower case English Alphabets ",['expires' => time() + 6,"path"=>"/"]);
}

// email
$pattern = "/^\w+(?:[\.-]?\w+)*@\w+([\.-]?\w+)*(?:\.\w{2,3})+$/";
$email_pattern=preg_match_all($pattern, $email);
if (!$email_pattern){
    setcookie("pemail_error","Are you kidding us? please enter the correct email address.",['expires' => time() + 6,"path"=>"/"]);
}

// username
$pattern = "/^\s*[a-zA-Z0-9_]*\s*$/";
$username_pattern=preg_match_all($pattern, $username);
if (!$username_pattern){
    setcookie("puser_error","Your user can only contain English Alphabets, numbers and _ ",['expires' => time() + 6,"path"=>"/"]);
}


// stop checking, if length is not correct
 if(($minname==1)||($minusername==1)||($minpass==1)||($maxname==1)||($maxusername==1)||($maxpass==1)||($name_pattern==0)||($email_pattern==0)||($username_pattern==0)){
     header("Location: ../Front/register.php?type=length_or_pattern$minname.$minusername.$minpass");
     die();
 };


$users = json_decode(read_file('users.json'), true);
// Check beeing unique
foreach ($users as $key => $value){
    if($value["email"]==$email){
        setcookie("email_error", "This email has been used before you, Please enter another email address",['expires' => time() + 6,"path"=>"/"]);
        header("Location: ../Front/register.php?type=email");
        die();
    }
    if($value["username"]==$username){
        setcookie("user_error", "This username has been used before you, Please enter another email address",['expires' => time() + 6,"path"=>"/"]);
        header("Location: ../Front/register.php?type=username");
        die();
    }
}



// Create Json file foreach user/Data Base
//----------------------------------------------------------------------------
if ($username=="admin"){
    $permission="admin";
}else{
    $permission="user";
}

$StorageMethod = json_decode(read_file("config.json"), true);
if ($StorageMethod["Save_mode"] == "DB") {
    $connection = MySqlDatabaseConnection::getInstance();
    $pdo1 = $connection->getConnection('localhost', 'root', '', 'chatroom');

    //add user as viewer to DB------------------------
    $stmt6 = $pdo1->prepare("INSERT INTO Users (username,name, bio,password,email,permission,main_profile_image)
    VALUES (?,?);");
    $stmt6->execute([$username, $name, "BIO", $password, $email,$permission,""]);
    $result_pdo2 = $stmt6->fetchAll();

}else{

    $user=[
        'name' => $name,
        'bio' => "BIO",
        'username'=>$username,
        'password'=>$password,
        'email'=>$email,
        'permission' => $permission,
        'seen_messages'=>[],
        'main_profile_image'=>[],
        'other_profile_image'=>[],
    ];
    $users[$username] = $user;
    write_file('users.json', json_encode($users));
}
setcookie("username", $username,["path"=>"/"]);

// Foward to main chatroom page
header("Location: ../Front/index.php?user=$username");

?>