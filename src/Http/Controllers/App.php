<?php

/*
 * Http/Controllers/App.php: handle App info requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Http\Controllers;

use Misc\Routing;
use Http\Response;

class App extends Routing\ControllerAlias {
    public static $alias = ["http" => "App"];

    public static function version() {
        return (new Response())->send(Response::HTTP_200_OK, $_ENV['VERSION']);
    }

    public static function pong() {
        return (new Response())->send(Response::HTTP_200_OK, "pong");
    }
}
