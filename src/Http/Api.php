<?php

/*
 * Http/Api.php: the API's main loop, run()
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Http;

use Http\Router;

class Api
{
    /*
     * A map of routes to controllers.
     * @var array
     */
    private static $api;

    /*
     * Resolve controller from endpoints to send response.
     * @return void
     */
    public static function respond()
    {
        $controller = Router::toController(self::$api);
        return self::run($controller);
    }

    public static function run($controller)
    {
        return $controller();
    }

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

    public static function controllers($registrars)
    {
        try
        {
            foreach ($registrars as $registrar)
            {
                if (class_exists($registrar))
                    Router::register($registrar::registration());
                else 
                    throw new \Exception("Unable to register controller ".$registrar);
            }
        } 
        catch (\Exception $e)
        {
            $response = new Response();
            $response->sendAndExit(Response::HTTP_400_BAD_REQUEST, $e->getMessage());
        }
    }
}
