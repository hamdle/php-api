<?php
require __DIR__.'/src/autoload.php';

use Http\Api;

$api = new Api();

// Add API endpoints
$api->endpoint('authenticate', 'AuthController.post');

$api->run();

