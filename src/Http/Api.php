<?php
namespace Http;

use Utils\ErrorLog;

class Api {

    public function run() {

        ErrorLog::print($_SERVER['REQUEST_METHOD'], "METHOD###");
        ErrorLog::print($_SERVER['REQUEST_URI'], "URI###");
        ErrorLog::print($_POST, "POST###");
        ErrorLog::print(json_decode(file_get_contents('php://input'), true), "FILE###");
 
        $data = [
            'Eric' => 'Marty'
        ];
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($data);
    }

}
