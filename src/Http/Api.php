<?php

/*
 * Http/Api.php: the API's main loop, run()
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Http;

use Utils\Router;

class Api
{
    /*
     * A map of routes to controllers.
     *
     * @var array
     */
    private $endpoints;

    /*
     * Resolve routes to controllers and send response.
     *
     * @return void
     */
    public function run()
    {
        ((new Router($this->endpoints))->getController())->sendResponse();
    }

    /*
     * Add a route, controller pair.
     *
     * @return void
     */
    public function endpoint($uri, $controller): void
    {
        $this->endpoints[$uri] = $controller;
    }
}
