<?php
require_once __DIR__ . '/../vendor/autoload.php';
use app\core\Application;
use app\controllers\AuthController;
use app\controllers\BlogController;
$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];
$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [BlogController::class,'overview']);
$app->router->get('/login', [AuthController::class,'login']);
$app->router->post('/login', [AuthController::class,'login']);
$app->run();
