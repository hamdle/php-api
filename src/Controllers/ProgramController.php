<?php
namespace Controllers;

use Http\Response;

class ProgramController implements ControllerInterface
{
    public function get($args = [])
    {
        $data = [
            'program' => '<ul><li>Push ups</li><li>Chin ups</li></ul>'
        ];

        $response = new Response();
        $response->send(Response::HTTP_200_OK, $data);
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
