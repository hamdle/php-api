<?php

/*
 * Http/Router.php: match endpoints with the request's
 * uri path
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Http;

class Router
{
    /*
     * A verified list of controllers.
     * @var array
     */
    private static $controllers;

    /*
     * Add an Api request controllers.
     * @return null
     */
    public static function register($creds) {
        foreach ($creds as $controller => $name)
        {
            self::$controllers[$controller][] = $name;
        }
    }

    /*
     * Return the controller of a matching endpoint if there's a match with the
     * URI.
     * @return \Controllers\Controller
     */
    public static function toController($api)
    {
        $token = self::parseControllerToken($api);
        if (self::verifyControllerToken($token))
            return self::toCallableController($token);
    }

    private static function toCallableController($token)
    {
        $tokenParts = explode(".", $token);
        $exec = "\\Http\\Controllers\\".$tokenParts[1]."::".$tokenParts[2];
        return $exec;
    }

    private static function parseControllerToken($api)
    {
        $pathParts = Request::path();

        foreach ($api[Request::method()] ?? [] as $route)
        {
            foreach ($route as $key => $token)
            {
                if (array_key_exists(0, $pathParts) &&
                    $pathParts[0] == $key)
                {
                    return $token;
                }
            }
        }

        return "controller.Error.noControllerFound";
    }

    private static function verifyControllerToken($token)
    {
        $tokenParts = explode(".", $token);
        $controllers = self::$controllers[$tokenParts[0]];

        if (array_search($tokenParts[1], $controllers) === false)
        {
            return false;
        }

        return true;
    }

}
