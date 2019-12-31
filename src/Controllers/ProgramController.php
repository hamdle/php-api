<?php
namespace Controllers;

use Http\Response;

class ProgramController implements ControllerInterface
{
    public function get($args = [])
    {
        $response = new Response();
        $response->send(Response::HTTP_200_OK, []);
    }

    public function post($args = [])
    {
        // TODO
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
