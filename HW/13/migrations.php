<?php

use core\Application;
/**
 * User: TheCodeholic
 * Date: 7/10/2020
 * Time: 8:21 AM
 */


require_once __DIR__.'/vendor/autoload.php';
// $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->load();

$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' =>"mysql:host=localhost; dbname=medicalcenter",
        'user' => "root",
        'password' =>"",
    ]
];

$app = new Application(__DIR__, $config);

$app->db->applyMigrations();