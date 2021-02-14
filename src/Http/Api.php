<?php

/*
 * Http/Api.php: the API's main loop, run()
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Http;

use \Http\Router;

class Api
{
    /*
     * A map of routes to controllers.
     * @var array
     */
    private static $api;

    /*
     * Add get request to the Api.
     * @return void
     */
    public static function get($path, $controller)
    {
        self::$api['get'][] = [$path => $controller];
    }

    /*
     * Add post request to the Api.
     * @return void
     */
    public static function post($path, $controller)
    {
        self::$api['post'][] = [$path => $controller];
    }

    /*
     * Resolve controller from endpoints to send response.
     * @return void
     */
    public static function respond()
    {
        $controller = Router::parseController(self::$api);

        if (is_callable($controller))
            return call_user_func($controller);

        return Response::defaultResponse();
    }
}
