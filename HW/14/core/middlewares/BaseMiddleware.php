<?php
/**
 * User: TheCodeholic
 * Date: 7/25/2020
 * Time: 11:33 AM
 */

namespace core\middlewares;


/**
 * Class BaseMiddleware
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package thecodeholic\phpmvc
 */
abstract class BaseMiddleware
{
    abstract public function execute();
}