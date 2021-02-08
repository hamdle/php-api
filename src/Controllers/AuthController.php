<?php

/*
 * Controllers/AuthController.php: authorize user requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Controllers;

use Http\Response;
use Database\Query\Users;
use Database\Query\Sessions;

class AuthController implements ControllerInterface
{
    public static $api = [
        "get" => [
            "exercises" => "contollers.Exercise.getNew"
        ],
        "post" => [
            "login" => "conrollers.Authentication.authenticateUserLogin",
            "workouts/new" => "conrollers.Workout.saveWorkout"
        ]
    ];

    public function get($args = [])
    {
        $response = new Response();
        return $response->send(Response::HTTP_401_UNAUTHORIZED, "Unauthorized request.");

        /*
        $sessions = new Sessions();

        if ($sessions->verify())
            return $response->send(Response::HTTP_200_OK);

        return $response->send(Response::HTTP_401_UNAUTHORIZED);
         */
    }

    public function post($args = [])
    {
        $response = new Response();
        return $response->send(Response::HTTP_200_OK, "Unauthorized request.");

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

    public function put($args = [])
    {
        // TODO
    }

    public function patch($args = [])
    {
        // TODO
    }

    public function delete($args = [])
    {
        // TODO
    }
}
