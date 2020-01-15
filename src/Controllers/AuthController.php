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
        //$users = new Users();
        //$user = $users->filter_by($args['post']);

        //$data = [
        //    'user' => $user->email
        //];

        $data = ['hello' => 'world'];

        \Utils\ErrorLog::print($args);

        $response = new Response();
        $response->send(Response::HTTP_200_OK, $data);
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
