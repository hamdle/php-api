<?php

/*
 * Http/Controllers/Error.php: handle bad requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Controllers;

use Http\Response;

class Error {
    public static function noControllerFound() {
        return Response::send(Response::HTTP_404_NOT_FOUND, "404 not found");
    }
}
