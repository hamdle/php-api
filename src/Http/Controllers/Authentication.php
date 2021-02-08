<?php

/*
 * Http/Controllers/Authentication.php: authorize user requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Http\Controllers;

use Misc\Routing;
use Http\Response;

class Authentication extends Routing\Registration {
    public static $registration = ["controller" => "Authentication"];

    public static function login()
    {
        $response = new Response();
        return $response->send(Response::HTTP_200_OK, "Login request");

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

        $user = new \Users\Entity($args[0]);
        $user->update($filteredArgs);

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
        $response = new Response();
        return $response->send(Response::HTTP_200_OK, "Authentication request");

        /*
        $sessions = new Sessions();

        if ($sessions->verify())
            return $response->send(Response::HTTP_200_OK);

        return $response->send(Response::HTTP_401_UNAUTHORIZED);
         */
    }
}
