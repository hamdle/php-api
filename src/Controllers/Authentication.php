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
        // 1. validate the form or return error message
        $loginForm = new LoginForm();   // uses Request::post()

        if (!$loginForm->validate())
            return Response::send(Response::HTTP_400_BAD_REQUEST, $loginForm->getMessages()); 

        // 2. create user from form input or return error message
        if (!$user = $loginForm->createUserFromInput())
            return Response::send(Response::HTTP_401_UNAUTHORIZED, $loginForm->getMessages());

        // you need to do the database query next TODO
        // 3. login the user or return error message
        if (!$user->login())
            return Response::send(Response::HTTP_401_UNAUTHORIZED, $loginForm->getMessages());

        Response::cookie($user->getCookie());
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
