<?php

/*
 * Http/Controllers/App.php: handle App info requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Http\Controllers;

use Misc\Routing;
use Http\Response;

class App extends Routing\Registration {
    public static $registration = ["controller" => "App"];

    public static function version() {
        $response = new Response();
        return $response->send(Response::HTTP_200_OK, $_ENV['VERSION']);
    }
}
