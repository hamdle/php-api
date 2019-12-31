<?php
namespace Http;

use Utils\Router;

class Api
{
    private $endpoints;

    public function run()
    {
        $request = Request::get();
        $router = new Router($this->endpoints);
        $controller = $router->getController($request);
        $controller->response();
    }

    public function endpoint($uri, $controller) 
    {
        $this->endpoints[$uri] = $controller;
    }
}
