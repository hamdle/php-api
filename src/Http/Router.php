<?php

/*
 * Http/Router.php: match endpoints with the request's uri path
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Http;

class Router
{
    /*
     * Match an Api endpoint with the request to find a Controller.
     * @return string - a callable Controller
     */
    public static function requestToController($api)
    {
        $pathParts = Request::path();

        foreach ($api[Request::method()] ?? [] as $route)
        {
            foreach ($route as $uri => $controller)
            {
                $uriParts = explode("/", $uri);
                $pass = true;

                for ($i = 0; $i < count($uriParts); $i++)
                {
                    if (!(isset($pathParts[$i]) &&
                        isset($uriParts[$i]) &&
                        $pathParts[$i] == $uriParts[$i]))
                    {
                        $pass = false;
                    }
                }

                if ($pass)
                    return $controller;
            }
        }

        return null;
    }
}
