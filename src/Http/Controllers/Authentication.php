<?php

/*
 * Http/Controllers/Authentication.php: authorize user requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Http\Controllers;

use Misc\Routing;
use Http\Response;

class Authentication extends Routing\Registration {
    public static $registration = ["controller" => "Authentication"];

    public static function login() {
        $response = new Response();
        return $response->send(Response::HTTP_200_OK, "Login...");
    }
}
