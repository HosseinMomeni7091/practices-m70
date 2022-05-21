<?php
/**
 * User: TheCodeholic
 * Date: 7/7/2020
 * Time: 9:57 AM
 */


use core\Application;
use app\controllers\SiteController;
use app\controllers\AboutController;

require_once __DIR__ . '/vendor/autoload.php';
// $dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
// $dotenv->load();
$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' =>"mysql:host=localhost; dbname=medicalcenter",
        'user' => "root",
        'password' =>""
    ]
];

$root_dir=str_replace("\\","/",__DIR__);

$app = new Application($root_dir, $config);


$app->router->get('/', [SiteController::class, 'home']);
$app->router->post('/detail', [SiteController::class, 'detail']);
$app->router->post('/filter', [SiteController::class, 'filter']);
$app->router->post('/search', [SiteController::class, 'search']);
$app->router->get('/home', [SiteController::class, 'home']);
$app->router->get('/manager', [SiteController::class, 'manager']);
$app->router->post('/manager', [SiteController::class, 'manager']);
$app->router->get('/manager/userconfirmation', [SiteController::class, 'userconfirmation']);
$app->router->post('/manager/userconfirmation', [SiteController::class, 'userconfirmation']);
$app->router->get('/manager/departments', [SiteController::class, 'departments']);
$app->router->post('/manager/departments', [SiteController::class, 'departments']);
$app->router->get('/doctor', [SiteController::class, 'doctor']);
$app->router->post('/doctor', [SiteController::class, 'doctor']);
$app->router->get('/doctor/workingtimetabling', [SiteController::class, 'workingtimetabling']);
$app->router->get('/doctor/workingtimetabling', [SiteController::class, 'workingtimetabling']);
$app->router->get('/register', [SiteController::class, 'register']);
$app->router->post('/register', [SiteController::class, 'register']);
$app->router->get('/login', [SiteController::class, 'login']);
$app->router->get('/login/{id}', [SiteController::class, 'login']);
$app->router->post('/login', [SiteController::class, 'login']);
$app->router->get('/logout', [SiteController::class, 'logout']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->get('/about', [AboutController::class, 'index']);
// $app->router->get('/manager', [AboutController::class, 'manager']);
// $app->router->post('/manager', [AboutController::class, 'manager']);
$app->router->get('/profile', [SiteController::class, 'profile']);
$app->router->get('/profile/{id:\d+}/{username}', [SiteController::class, 'login']);

$app->run();
