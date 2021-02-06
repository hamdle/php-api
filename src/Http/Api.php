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
     * @var array
     */
    private static $endpoints;

    /*
     * Resolve controller from endpoints to send response.
     * @return void
     */
    public static function run()
    {
        Router::toController(self::$endpoints)->sendResponse();
    }

    /*
     * Add a route, controller pair.
     * @return void
     */
    public static function endpoint($uri, $controller)
    {
        self::$endpoints[$uri] = $controller;
    }
}
