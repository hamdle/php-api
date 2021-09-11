<?php

/*
 * Core/Api.php: holder of the ring
 *
 * The one class to control them all. The Api maintains an internal $api array
 * that maps endpoints to controller functions. The Api responds to a request.
 * And the Api knows how to route a request to an ($api) endpoint.
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Core;

use \Core\Http\Response;
use \Core\Http\Request;
use \Core\Http\Code;

class Api
{
    // The ring, an array of Api endpoints mapped to controllers.
    private static $api;

    // Change this to put the controllers in a different directory.
    private static $CONTROLLER_ROOT = "\\Controllers\\";

    /*
     * Public methods
     */

    public static function get($endpoint, $controller, $function)
    {
        self::$api["get"][] = [$endpoint => [$controller, $function]];
    }

    public static function post($endpoint, $controller, $function)
    {
        self::$api["post"][] = [$endpoint => [$controller, $function]];
    }

    // Invoke a controller using the request and Api. This is the surface,
    // uncaught exceptions can bubble up to here.
    // return = \Core\Http\Response
    public static function respond()
    {
        $controller = self::route(Request::path(), self::$api);

        if (is_null($controller))
            return Response::sendDefaultNotFound();

        $namespace = self::$CONTROLLER_ROOT.$controller[0];
        $function = $controller[1];

        try {
            if ($instantiatedController = [new $namespace, $function])
                return $instantiatedController();

            return Response::sendDefaultNotFound();
        }
        catch (\Throwable $e)
        {
            return Response::send
            (
                Code::INTERNAL_SERVER_ERROR_500,
                [
                    "error" => $e->getMessage(),
                ]
            );
        }
    }

    /*
     * Priate methods
     */

    // Given [$endpoint => $controller] match the $endpoint to the request and
    // return = $controller or null
    private static function route($path, $api)
    {
        // TODO can you reduce the complexity of this?
        foreach ($api[Request::method()] ?? [] as $route)
        {
            foreach ($route as $uri => $controller)
            {
                $uriParts = explode("/", $uri);
                $pass = true;

                for ($i = 0; $i < count($uriParts); $i++)
                {
                    if (!(isset($path[$i]) &&
                        isset($uriParts[$i]) &&
                        $path[$i] == $uriParts[$i]))
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
