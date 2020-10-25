<?php

/*
 * Http/Api.php: the API's main loop, run()
 *
 * Copyright (C) 2020 Eric Marty
 */

namespace Http;

use Utils\Router;

class Api
{
    private $endpoints;

    public function
    run(): void
    {
        ((new Router($this->endpoints))->routeToController())->sendResponse();
    }

    public function
    endpoint($uri, $controller): void
    {
        $this->endpoints[$uri] = $controller;
    }
}
