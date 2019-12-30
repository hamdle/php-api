<?php
namespace Controllers;

use Http\Response;

class AuthController implements ControllerInterface
{
    public function get($args = [])
    {
        // TODO
    }

    public function post($args = [])
    {
        $data = [
            'Eric' => 'Marty'
        ];

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
