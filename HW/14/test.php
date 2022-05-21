<?php
class a{
public function __invoke()
{
    echo "hello from invoke"."</br>";
}

    public function b(){
        echo "hello world!"."</br>";

    }
}
?>

include "test2.php";

<?php
$a=new a;
$a();
// call_user_func([$a,"b"]);
?>

