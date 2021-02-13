<?php

/*
 * Http/Controllers/Error.php: handle bad requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Http\Controllers;

use Http\Response;

class Error {
    public static function noControllerFound() {
        $response = new Response();
        return $response->send(Response::HTTP_404_NOT_FOUND, "404 not found");
    }
}
