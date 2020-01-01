<?php
namespace Controllers;

use Http\Response;
use Database\MySQL;

class AuthController implements ControllerInterface
{
    public function get($args = [])
    {
        // TODO
    }

    public function post($args = [])
    {
        $mysql = new MySQL();
        $mysql->connect();
        $mysql->query();
        $mysql->close();
         
        $data = [
            'user' => 'admin@localhost'
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
