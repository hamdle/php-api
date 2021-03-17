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
            return Response::send(Response::HTTP_422_UNPROCESSABLE_ENTITY, $user->getMessages());

        if (!$user->login())
            return Response::send(Response::HTTP_401_UNAUTHORIZED);

        return Response::send(Response::HTTP_201_CREATED);
    }

    /*
     * Handle authentication request. Users that have logged in will send a
     * authentication cookie that can be used to verify the user.
     * @return \Http\Response
     */
    public function authenticateUser()
    {
        $session = new Session();
        if (!$session->verify())
            return Response::send(Response::HTTP_401_UNAUTHORIZED);

        return Response::send(Response::HTTP_200_OK);
    }
}
