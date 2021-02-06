<?php

/*
 * Utils/Router.php: match endpoints with the request's
 * uri path
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Utils;

use Http\Request;
use Controllers\Controller;

class Router
{
    /*
     * Return the controller of a matching endpoint if there's a match with the
     * URI.
     * @return \Controllers\Controller
     */
    public static function toController($endpoints)
    {
        $pathParts = Request::path();

        foreach (self::filterEndpoints($endpoints) as $key => $value) {
            $pass = true;
            $uriArgs = [];
            $keyParts = explode('/', $key);

            for ($n = 0; $n < count($pathParts); $n++) {
                if ($pathParts[$n] == $keyParts[$n]) {
                    continue;
                } else if (intval($pathParts[$n]) === 0) {
                    $pass = false;
                } else {
                    $argKey = str_replace(['{', '}'], '', $keyParts[$n]);
                    $uriArgs[$argKey] = intval($pathParts[$n]);
                }
            }

            if ($pass) {
                $parts = explode('.', $value);
                $class = $parts[0];
                $method = $parts[1];

                $args['uri'] = $uriArgs;
                $args['data'] = Request::data();
                $args['post'] = Request::post();

                return new Controller($class, $method, $args);
            }
        }

        return new Controller('ErrorController', 'get');
    }

    /*
     * Run basic test for matching request path with endpoints.
     * @return array
     */
    private static function filterEndpoints($endpoints)
    {
        $filteredEndpoints = [];
        $requestParts = Request::path();

        foreach ($endpoints as $uri => $controller) {
            $uriParts = explode('/', $uri);
            $controllerParts = explode('.', $controller);
            $class = $controllerParts[0];
            $method = $controllerParts[1];

            if (count($requestParts) === count($uriParts) &&
                ($method == strtolower(Request::method()))) {
                $filteredEndpoints[$uri] = $controller;
            }
        }

        return $filteredEndpoints;
    }
}
