<?php
/**
 * User: TheCodeholic
 * Date: 7/25/2020
 * Time: 10:13 AM
 */

namespace core;

use core\db\DbModel;


/**
 * Class UserModel
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package thecodeholic\phpmvc
 */
abstract class UserModel extends DbModel
{
    abstract public function getDisplayName();
}