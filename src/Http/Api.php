<?php
namespace Http;

use Http\Request;
use Utils\ErrorLog;

class Api
{
    private $endpoints;

    public function run()
    {
        //ErrorLog::print($this->endpoints);

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
        if ($controller == 'AuthController.post')
        {
            // Response example
            $data = [
                'Eric' => 'Marty'
            ];
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode($data);
        }
    }
}
