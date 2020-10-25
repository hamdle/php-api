<?php

/*
 * Http/Request.php: http request information
 *
 * Copyright (C) 2020 Eric Marty
 */

namespace Http;

class Request
{
    public static function
    uri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public static function
    path(): array
    {
        $arr = array_filter(
            explode('/', self::uri()),
            function($part)
            {
                if (empty(trim($part)) || $part == 'api')
                    return 0;
                return 1;
            }
        );

        return array_values($arr);
    }

    public static function
    method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function
    data() /* : mixed */
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    public static function
    post(): string
    {
        return $_POST;
    }

    public static function
    cookie(): string
    {
        return $_COOKIE;
    }
}
