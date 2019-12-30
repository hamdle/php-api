<?php
require_once __DIR__.'/src/Utils/ErrorLog.php';

use Utils\ErrorLog;

ErrorLog::print($_SERVER['REQUEST_METHOD'], "METHOD###");
ErrorLog::print($_SERVER['REQUEST_URI'], "URI###");
ErrorLog::print($_POST, "POST###");
ErrorLog::print(json_decode(file_get_contents('php://input'), true), "FILE###");

function send_test_response() {
    $data = [
        'Eric' => 'Marty'
    ];
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode($data);
}

send_test_response();

?>
