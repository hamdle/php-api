<?php
namespace Http;

use Utils\ErrorLog;

class Api {

    private $request;
    private $endpoints;

    public function __construct()
    {
        //$request = new Request();
    }

    public function run()
    {
        ErrorLog::print($this->endpoints);
        /*
        // Request info example
        ErrorLog::print($_SERVER['REQUEST_METHOD'], "METHOD###");
        ErrorLog::print($_SERVER['REQUEST_URI'], "URI###");
        ErrorLog::print($_POST, "POST###");
        ErrorLog::print(json_decode(file_get_contents('php://input'), true), "FILE###");
        */

        $this->respond();

        // 1. Get the request
        // 2. Parse the request and get a Controller to run
        // 3. Run the Controller
        // 3.5 The Controller will return a Response
        // 3.6 The Response will print to buffer and die
    }

    public function endpoint($uri, $controller) 
    {
        $this->endpoints[$uri] = $controller;
    }

    private function respond() 
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
