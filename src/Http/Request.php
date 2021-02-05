<?php

/*
 * Http/Request.php: http request information
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Http;

class Request
{
    /*
     * Get URI.
     *
     * @return string
     */
    public static function uri()
    {
        return $_SERVER['REQUEST_URI'];
    }

    /*
     * Return API path parts.
     *
     * @return array
     */
    public static function path()
    {
        $parts = array_filter(
            explode('/', self::uri()),
            function($part)
            {
                if (empty(trim($part)) || $part == 'api')
                    return 0;
                return 1;
            }
        );

        return array_values($parts);
    }

    /*
     * Get HTTP request method.
     *
     * @return string
     */
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /*
     * Get file upload data.
     *
     * @return mixed
     */
    public static function data()
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    /*
     * Get post information.
     *
     * @return array
     */
    public static function post()
    {
        return $_POST;
    }

    /*
     * Get cookie information.
     *
     * @return array
     */
    public static function cookie()
    {
        return $_COOKIE;
    }
}
