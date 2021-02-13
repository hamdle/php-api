<?php

/*
 * Http/Controllers/Authentication.php: authorize user requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Controllers;

use Http\Response;

class Authentication {
    public static function login()
    {
        return Response::send(Response::HTTP_200_OK, "Login request");

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

        \Users\Model::filterBy($filters);
        \Users\Model::fromId($filteredArgs['userId']);

        if ($user == null) {
            $response = new Response();
            return $response->send(Response::HTTP_401_UNAUTHORIZED);
        } else {
            $response = new Response();
            $response->cookie($user->cookie());
            return $response->send(Response::HTTP_200_OK);
        }
         */
    }

    public static function authenticateUser()
    {
        return Response::send(Response::HTTP_200_OK, "Authentication request");

        /*
        $sessions = new Sessions();

        if ($sessions->verify())
            return $response->send(Response::HTTP_200_OK);

        return $response->send(Response::HTTP_401_UNAUTHORIZED);
         */
    }
}
