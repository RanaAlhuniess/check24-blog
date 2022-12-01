<?php

class Router
{
    protected array $routes = [];
    public function __construct()
    {

    }
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }
    public function run() {
        //TODO: Hard coded for test
        $callback = $this->routes['get']['/'] ?? false;
        return call_user_func($callback);
    }
}