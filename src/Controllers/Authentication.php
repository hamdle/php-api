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

class Authentication {
    public function login()
    {
        $user = new User();
        $user->authenticate();

        if ($user->login())
        {
            Response::cookie($user->getCookie());
            return Response::send(Response::HTTP_200_OK);
        }

        return Response::send(Response::HTTP_401_UNAUTHORIZED, $user->getMessages());

        /*
        $filteredArgs = array_map(function($item) {
                if (!is_null($item) && array_key_exists('password', $item)) 
                    $item['password'] = md5($item['password']);
                return $item;
            },
            $args
        );

        $users = new Users();
        $user = $users->filter_by($filteredArgs['post']);

        $id = $args[0];
        $user = new \Users\Entity($id);
        $user->update($filteredArgs);
        $user->getOrMakeCookie();
         */
    }

    public function authenticateUser()
    {
        $session = new Session();

        if ($session->verify())
            return Response::send(Response::HTTP_200_OK);

        return Response::send(Response::HTTP_401_UNAUTHORIZED);
    }
}
