<?php
namespace Controllers;

use Http\Response;
use Database\Query;

class AuthController implements ControllerInterface
{
    public function get($args = [])
    {
        // TODO
    }

    public function post($args = [])
    {
        $sql = 'select * from users';
        $query = new Query();
        $results = $query->run($sql);
        \Utils\ErrorLog::print($results);

        //$mysql = new MySQL();
        //$mysql->connect();
        //$mysql->query();
        //$mysql->close();
         
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
