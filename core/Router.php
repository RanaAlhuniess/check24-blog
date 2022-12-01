<?php
namespace app\core;
class Router
{
    protected array $routes = [];
    private Request $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }
    public function run() {
        $path = $this->request->getPath();
        $methode = $this->request->method();
        $callback = $this->routes[$methode][$path] ?? false;
        if (!$callback) {
            http_response_code(404);
            //TODO: redircte to error page
            return '';
        }
        return call_user_func($callback);
    }
}