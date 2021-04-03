<?php

/*
 * Controllers/Authentication.php: handle user authentication requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Controllers;

use Http\Request;
use Http\Response;
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
            return Response::send(\Http\Code::UNPROCESSABLE_ENTITY_422, $user->getMessages());

        if (!$user->login())
            return Response::send(\Http\Code::UNAUTHORIZED_401);

        return Response::send(\Http\Code::CREATED_201);
    }

    /*
     * Handle authentication request. Users that have logged in will send a
     * authentication cookie automatically.
     * @return \Http\Response
     */
    public function authenticateUser()
    {
        if (!(new Session())->verify())
            return Response::send(\Http\Code::UNAUTHORIZED_401);

        return Response::send(\Http\Code::OK_200);
    }
}
