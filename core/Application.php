<?php

namespace app\core;

use app\core\db\Database;
use app\core\db\DbModel;

class Application
{
    public static Application $app;
    public static string $ROOT_DIR;
    public Router $router;
    /**
     * @var mixed
     */
    public Controller $controller;
    private Request $request;
    public Database $db;
    public ?DbModel $user;

    public function __construct($rootPath, array $config)
    {
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->router = new Router($this->request);
        $this->db = new Database($config['db']);
    }

    function run()
    {
        echo $this->router->run();
    }

    public function login(DbModel $user): bool
    {
        $this->user = $user;
        //TODO: set in a session
        return true;
    }

    public function logout()
    {
        $this->user = null;
    }
    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }
}