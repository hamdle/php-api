<?php
namespace Controllers;

use Http\Response;

class ErrorController implements ControllerInterface
{
    public function get($args = [])
    {
        $this->errorResponse();
    }

    public function post($args = [])
    {
        $this->errorResponse();
    }

    public function put($args = [])
    {
        $this->errorResponse();
    }

    public function patch($args = [])
    {
        $this->errorResponse();
    }

    public function delete($args = [])
    {
        $this->errorResponse();
    }

    private function errorResponse()
    {
        $response = new Response();
        return $response->send(Response::HTTP_404_NOT_FOUND, []);
    }
}
