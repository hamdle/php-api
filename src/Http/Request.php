<?php
namespace Http;

class Request {
    private static $instance;

    public static function get()
    {
        if (isset(self::$instance))
        {
            return self::$instance;
        }
        else
        {
            self::$instance = new Request();
            return self::$instance;
        }
    }

    public function getPath()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getData()
    {
        return json_decode(file_get_contents('php://input'), true);
    }
}
