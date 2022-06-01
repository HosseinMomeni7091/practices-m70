<?php
/**
 * User: TheCodeholic
 * Date: 7/7/2020
 * Time: 10:23 AM
 */

namespace core;

use Illuminate\Validation\Rules\Exists;

/**
 * Class Request
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package thecodeholic\mvc
 */
class Request
{
    private array $routeParams = [];

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getUrl()
    {
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos($path, '?');
        if ($position !== false) {
            $path = substr($path, 0, $position);
        }
        return $path;
    }

    public function isGet()
    {
        return $this->getMethod() === 'get';
    }

    public function isPost()
    {
        return $this->getMethod() === 'post';
    }

    public function getBody()
    {
        $data = [];
        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if (isset($_FILES["image"]["name"])){
     
            $imgname=$_FILES["image"]["name"];
            // preg_match_all("/\.\w+$/",$_FILES["image"]["name"],$all);
            // $exten=$all[0][0];
            $temp=$_FILES["image"]["tmp_name"];
            // echo __DIR__;
            $target_file = __DIR__."/storage/".$imgname;
            // echo $target_file;
            move_uploaded_file($temp, $target_file);
            $data["image"]=$target_file;
        }
        $sess = (int) Application::$app->session->get('ID');
        $data["user_id"]=$sess; 



        return $data;
    }

    /**
     * @param $params
     * @return self
     */
    public function setRouteParams($params)
    {
        $this->routeParams = $params;
        return $this;
    }

    public function getRouteParams()
    {
        return $this->routeParams;
    }

    public function getRouteParam($param, $default = null)
    {
        return $this->routeParams[$param] ?? $default;
    }
}
