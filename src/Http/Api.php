<?php
namespace Http;

use Http\Request;
use Http\Response;
use Controllers\Controller;
use Utils\ErrorLog;

class Api
{
    private $endpoints;

    public function run()
    {
        $request = Request::get();
        $controller = $this->getController($request);
        $controller->respond();
    }

    public function endpoint($uri, $controller) 
    {
        $this->endpoints[$uri] = $controller;
    }

    private function getController($request)
    {
        // Get parts from the request
        // Find out which endpoint matches the parts
        // Return the endpoint
        $value = $this->endpoints['authenticate'];
        $parts = explode('.', $value);
        $class= $parts[0];
        $method = $parts[1];

        return new Controller($class, $method);
    }

    private function respond($controller)
    {
        // TODO
        // 1. Invoke the controller
        // 2. Send error Response if controller invoke fails
 
        if ($controller == 'AuthController.post')
        {
            $data = [
                'Eric' => 'Marty'
            ];
            $response = new Response();
            $response->send(Response::HTTP_200_OK, $data);
            //header('Content-Type: application/json');
            //http_response_code(200);
            //echo json_encode($data);
        }
    }
}
