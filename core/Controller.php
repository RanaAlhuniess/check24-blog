<?php

namespace app\core;

class Controller
{
    function render($view, $params = [])
    {
        return Application::$app->router->renderView($view);
    }
}