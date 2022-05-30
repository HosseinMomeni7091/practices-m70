<?php

namespace core;

class Cookie
{

    public function setCK($id, $value, $timee =null )
    {   
        if ($timee==null){
            $timee=time() + (86400 * 30);
        }
        
        setcookie($id, $value, $timee, "/");
        return;
        // ["id"=>"hossein"]
    }

    public function deleteCK($id)
    {
        setcookie($id, time() -10, "/");
        return;
        // ["id"=>"hossein"]
    }

    public function getCK($id)
    {
        return $_COOKIE[$id];
    }
}
