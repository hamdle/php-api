<?php

/*
 * Controllers/Authentication.php: handle user authentication requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Controllers;

use Core\Http\Request;
use Core\Http\Response;
use Core\Http\Code;
use Models\User;
use Models\Session;

class Authentication {
    /*
     * Handle login request. Vaildate the form and attempt to log the user in.
     * @return \Http\Response
     */
    public function login()
    {
        $user = new User(Request::post());
        if (!$user->validate())
            return Response::send(Code::UNPROCESSABLE_ENTITY_422, $user->getMessages());

        if ($user->login())
            return Response::send(Code::CREATED_201);

        return Response::send(Code::UNAUTHORIZED_401);
    }

    /*
     * Handle authentication request. Users that have logged in will send a
     * authentication cookie automatically.
     * @return \Http\Response
     */
    public static function verifySession()
    {
        $session = new Session();
        if ($session->verify())
            return Response::send(Code::OK_200);

        return Response::send(Code::UNAUTHORIZED_401);
    }
}
