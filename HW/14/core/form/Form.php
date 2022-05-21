<?php
/**
 * User: TheCodeholic
 * Date: 7/9/2020
 * Time: 7:05 AM
 */

namespace core\form;

use core\Model;



/**
 * Class Form
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package core\form
 */
class Form
{
    public static function begin($action, $method, $options = [])
    {
        $attributes = [];
        foreach ($options as $key => $value) {
            $attributes[] = "$key=\"$value\"";
        }
        echo sprintf('<form class="shadow-md text-left w-1/2 m-auto bg-slate-100 rounded-md p-4" action="%s" method="%s" %s>', $action, $method, implode(" ", $attributes));
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new Field($model, $attribute);
    }

}