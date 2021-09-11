<?php

/*
 * Core/Http/Api.php: holder of the ring
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Core;

use \Core\Http\Response;
use \Core\Http\Router;

class Api
{
    /*
     * The ring, an array of Api endpoints keyed by request method.
     * @var array
     */
    private static $api;

    /*
     * Add GET request to the Api.
     * @return void
     */
    public static function get($path, $controller)
    {
        self::$api['get'][] = [$path => $controller];
    }

    /*
     * Add POST request to the Api.
     * @return void
     */
    public static function post($path, $controller)
    {
        self::$api['post'][] = [$path => $controller];
    }

    /*
     * Route the request in to a Controller and execute it to return a response.
     * @return \Http\Response
     */
    public static function respond()
    {
        $controller = Router::requestToController(self::$api);

        if (is_callable($controller))
            return $controller();

        if (is_array($controller) &&
            count($controller) == 2 &&
            ($invokedController = [new $controller[0](), $controller[1]]) &&
            is_callable($invokedController))
        {
            return $invokedController();
        }

        return Response::sendDefault();
    }
}
