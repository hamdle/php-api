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
     * Define a default controller.
     * @var string
     */
    const DEFAULT_CONTROLLER = "controller.Error.noControllerFound";

    /*
     * A verified list of controllers.
     * @var array
     */
    private static $registeredControllers;

    /*
     * Controllers configuration.
     * @var array
     */
    private static $controllerConfig = [
        "controller" => [
            "callable" => "\Http\Router::controllerToCallable"
        ],
        "module" => [
            "callable" => "\Http\Router::moduleToCallable"
        ]
    ];

    /*
     * Add an Api request controllers.
     * @return null
     */
    public static function register($creds) {
        foreach ($creds as $controller => $name)
        {
            self::$registeredControllers[$controller][] = $name;
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
        return self::toCallableController($token);
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

        return self::DEFAULT_CONTROLLER;
    }

    /*
     * Attempt to register the controller using the token string, then verify
     * that the requested function was registered.
     * @return bool
     */
    public static function verifyControllerToken($token)
    {
        $tokenParts = explode(".", $token);
        if (count($tokenParts) != 3)
            return false;

        // Register the controller
        $controllerParts = explode("::", self::$controllerConfig[$tokenParts[0]]['callable']($tokenParts));
        Router::register($controllerParts[0]::registration());

        // Verify a registered domain (controller, module) registered the
        // requested controller (Authentication, ExerciseTypes, etc).
        $controllers = self::$registeredControllers[$tokenParts[0]];
        if (in_array($tokenParts[1], $controllers) === false)
            return false;

        return true;
    }

    /*
     * Create a callable function from a controller token.
     * @return callable string
     */
    private static function toCallableController($token)
    {
        $tokenParts = explode(".", $token);
        if (count($tokenParts) != 3)
            return null;

        return self::$controllerConfig[$tokenParts[0]]['callable']($tokenParts);
    }

    /*
     * Create a callable \Http\Controllers controller from token parts.
     * @return string - callable function
     */
    private static function controllerToCallable($tokenParts)
    {
        return "\\Http\\Controllers\\".$tokenParts[1]."::".$tokenParts[2];
    }

    /*
     * Create a callable \Modules controller from token parts.
     * @return string - callable function
     */
    private static function moduleToCallable($tokenParts)
    {
        return "\\Modules\\".$tokenParts[1]."\\Controller::".$tokenParts[2];
    }
}
