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
     * Controllers configuration.
     * @var array
     */
    private static $controllerConfig = [
        "controller" => [
            "namespace" => "Http\Controllers",
        ],
        "module" => [
            "namespace" => "Modules",
        ]
    ];

    /*
     * Add an Api request controllers.
     * @return null
     */
    public static function register($creds) {
        foreach ($creds as $controller => $name)
        {
            self::$controllers[$controller][] = $name;
            return $controller;
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
        // Handle failed verification TODO
    }

    /*
     * Parse controller token from request.
     * @return string
     */
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
                    // Verify token parts before returning TODO
                    return $token;
                }
            }
        }

        return "controller.Error.noControllerFound";
    }

    /*
     * Verify token was registered by a controller.
     * @return bool
     */
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

    /*
     * Create a callable function from a controller token.
     * @return callable string
     */
    private static function toCallableController($token)
    {
        $tokenParts = explode(".", $token);
        $exec = null;
        if ($tokenParts[0] === "controller")
        {
            $exec = "\\".self::$controllerConfig[$tokenParts[0]]['namespace']."\\".$tokenParts[1]."::".$tokenParts[2];
        }
        else if ($tokenParts[0] === "module")
        {
            $exec = "\\".self::$controllerConfig[$tokenParts[0]]['namespace']."\\".$tokenParts[1]."\\Controller::".$tokenParts[2];
        }
        return $exec;
    }
}
