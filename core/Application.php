<?php

namespace app\core;
class Application
{
    public static string $ROOT_DIR;
    public Router $router;
    private Request $request;
    public Database $db;
    public function __construct($rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->router = new Router($this->request);
        $this->db = new Database($config['db']);
    }

    function run (){
        echo $this->router->run();
    }
}