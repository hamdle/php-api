<?php
namespace Http;

use Http\Request;
use Http\Response;
use Controllers\Controller;
use Utils\ErrorLog;

class Api
{
    private $endpoints;

    public function run()
    {
        $request = Request::get();
        $controller = $this->getController($request);

        $controller->response();
    }

    public function endpoint($uri, $controller) 
    {
        $this->endpoints[$uri] = $controller;
    }

    private function getController($request)
    {
        $value = $this->endpoints['authenticate'];
        $parts = explode('.', $value);
        $class= $parts[0];
        $method = $parts[1];

        return new Controller($class, $method);
    }
}
