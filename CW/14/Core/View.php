<?php

namespace app\Core;

class View
{
    public $mainpath = __DIR__ . "/../view/";

    public function show($path, $data)
    {
        extract($data);
        $list = $data;
        require_once $this->mainpath . $path;
    }

    public function create($main, $layout = [], $data = [])
    {
        extract($data);
        $list = $data;

        ob_start(); //Output Buffer

        require_once $this->mainpath . $main;
        $mainpage = ob_get_clean(); //In this step we get content
        foreach ($layout as $value) {
            require_once $this->mainpath . $value;
            $all_layout = ob_get_contents();
        }

        ob_end_clean(); //End of Output Buffer

        echo str_replace("{{Rasoul}}", $all_layout, $mainpage);
    }
}
