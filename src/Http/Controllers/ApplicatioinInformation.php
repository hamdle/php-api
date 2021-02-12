<?php

/*
 * Http/Controllers/App.php: handle bad requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Http\Controllers;

use Misc\Routing;
use Http\Response;

class App extends Routing\ControllerAlias {
    public static $alias = ["controller" => "App"];

    public static function version() {
        $response = new Response();
        return $response->send(Response::HTTP_200_OK, "0.5");
    }
}
