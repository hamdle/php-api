<?php

function var_error_log($object = null, $tag = '') {
    if ($object == null) {
        $object = "null";   // be explicit for print_r
    }

    ob_start();
    print("\n###START $tag\n");
    print_r($object);
    print("\n###END $tag\n");
    $contents = ob_get_contents();
    ob_end_clean();
    error_log($contents);
}

var_error_log($_SERVER['REQUEST_METHOD'], "REQUEST------");

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
