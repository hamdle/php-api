<?php

/*
 * Http/Controllers/Authentication.php: authorize user requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Controllers;

use Http\Request;
use Http\Response;
use Models\User;
use Models\Session;
use Forms\Login as LoginForm;

class Authentication {
    public function login()
    {
        $loginForm = new LoginForm(Request::post());
        if (!$loginForm->validate())
            return Response::send(Response::HTTP_400_BAD_REQUEST, $loginForm->getMessages()); 

        $user = new User(Request::post());

        if (!$user->login())
            return Response::send(Response::HTTP_401_UNAUTHORIZED, $user->getMessages());

        return Response::send(Response::HTTP_200_OK);
    }

    public function authenticateUser()
    {
        return Response::send(Response::HTTP_403_FORBIDDEN);
        $session = new Session();

        if (!$session->verify())
            return Response::send(Response::HTTP_401_UNAUTHORIZED);

        return Response::send(Response::HTTP_200_OK);
    }
}
