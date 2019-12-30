<?php
namespace Http;

use Http\Request;
use Http\Response;
use Utils\ErrorLog;

class Api
{
    private $endpoints;

    public function run()
    {
        ErrorLog::print($this->endpoints);

        $request = Request::get();
        $controller = $this->getController($request);
        $this->respond($controller);
    }

    public function endpoint($uri, $controller) 
    {
        $this->endpoints[$uri] = $controller;
    }

    private function getController($request)
    {
        return 'AuthController.post';
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
