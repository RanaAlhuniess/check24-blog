<?php
namespace app\core;
class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        return $position ? substr($path, 0, $position) : $path;
    }

    public function method(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    public function isPost(): bool
    {
        return $this->method() == 'post';
    }
}