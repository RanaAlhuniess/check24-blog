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
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
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
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            //create an instance of controller
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;

        }
        return call_user_func($callback, $this->request);
    }

    public function renderView(string $view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderViewOnly($view);
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }
    private function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/main.php";
        return ob_get_clean();
    }

    protected function renderViewOnly($view)
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}