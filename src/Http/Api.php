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
     * A map of controller keys to namespaces.
     * @var array
     */
    private static $controllerNamespaces;

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
        if (Router::verifyControllerToken($controller))
            self::$api['get'][] = [$path => $controller];
        else
            throw new \Exception("Unable to verify 'get' Api endpoint for token \"".$controller."\".");
    }

    /*
     * Add post request to the Api.
     * @return void
     */
    public static function post($path, $controller)
    {
        if (Router::verifyControllerToken($controller))
            self::$api['post'][] = [$path => $controller];
        else
            throw new \Exception("Unable to verify 'post' Api endpoint for token \"".$controller."\".");
    }

    /*
     * Add post request to the Api.
     * @param $registrars - array of strings
     * @return void
     */
    public static function controllers($registrars)
    {
        try
        {
            foreach ($registrars as $registrar)
            {
                if (class_exists($registrar))
                {
                    $domain = Router::register($registrar::registration());
                    self::$controllerNamespaces[] = [$domain => $registrar];
                }
                else 
                {
                    throw new \Exception("Unable to register controller ".$registrar);
                }
            }
        } 
        catch (\Exception $e)
        {
            $response = new Response();
            $response->sendAndExit(Response::HTTP_400_BAD_REQUEST, $e->getMessage());
        }
    }
}
