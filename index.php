<?php
require_once 'core/Application.php';
$app = new Application();

$app->router->get('/', function (){
    echo "Hello word";
});
$app->run();
