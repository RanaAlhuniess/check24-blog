<?php

namespace app\core;
class Application
{
    public Router $router;
    private Request $request;
    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    function run (){
        $this->router->run();
    }
}