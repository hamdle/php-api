<?php

/*
 * Http/Controllers/App.php: handle bad requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Http\Controllers;

use Http\Response;

class App {
    public static function version() {
        $response = new Response();
        return $response->send(Response::HTTP_200_OK, "0.5");
    }
}
