<?php

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
