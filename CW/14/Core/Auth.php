<?php

namespace app\Core;

use app\Model\Users;

class Auth
{

    public function isLogin() //must be checked in each page

    {
        // getcookie
        $id=Application::$app->getInstanceOfClasses("cookie")->getCK("id")??null;
        if ($id)

        return true / false; //boolean
    }


    public function user() //for print name and family of current user and etc.
    {
        // get id from cookie
        $id=Application::$app->getInstanceOfClasses("cookie")->getCK("id");

        // return all user info 
        $users = Users::do();
        return $users->find($id, "id");
 

    }


    public function login($name, $password) //or input can be email and pass
    {
        // search by name 
        // get
        $users = Users::do();


        // find data from DB and show in output
        $user = $users->find($name, "name");
        echo '<pre>';
        print_r($user);
        echo '</pre>' . '<br>';

        // is exist user with name
        if (!$user) {
            return false;
        }

        // check pass
        if ($user[0]["password"]==$password){
            // Set Cookie
            Application::$app->getInstanceOfClasses("cookie")->setCK("id", $user[0]["ID"]);
            return $user[0];
        }

        // wrong pass
        return false;
    }
}
