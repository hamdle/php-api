<?php

/*
 * Controllers/AppInfo.php: get information about the app
 *
 * The purpose of this controller is to provide information about the Api,
 * typically these requests are public and available to anyone willing to ask.
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Controllers;

use Core\Http\Response;
use Core\Http\Code;

class AppInfo {
    public function version()
    {
        return Response::send
        (
            Code::OK_200,
            [
                "version" => $_ENV["VERSION"],
                "code" => 200,
            ]
        );
    }

    public function teapot()
    {
        return Response::send
        (
            Code::IM_A_TEAPOT_418,
            [
                "message" => "I'm a teapot",
                "code" => 418,
            ]
        );
    }
}
