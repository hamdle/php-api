<?php
namespace Controllers;

use Http\Response;
use Database\Query\Users;

class AuthController implements ControllerInterface
{
    public function get($args = [])
    {
        // TODO
    }

    public function post($args = [])
    {
        $filteredArgs = array_map(function($item) {
                if (!is_null($item) && array_key_exists('password', $item)) {
                    $item['password'] = md5($item['password']);
                }
                return $item;
            },
            $args
        );
        $users = new Users();
        $user = $users->filter_by($filteredArgs['post']);

        if ($user == null) {
            $response = new Response();
            $response->send(Response::HTTP_401_UNAUTHORIZED);
        } else {
            $response = new Response();
            $response->cookie($user->cookie());
            $response->send(Response::HTTP_200_OK);
        }
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
