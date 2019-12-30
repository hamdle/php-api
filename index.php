<?php
require __DIR__.'/src/autoload.php';
require_once __DIR__.'/src/Http/Api.php';

use Http\Api;

$api = new Api();

// Add API endpoints
// $api->endpoint('/authenticate', 'AuthController.post');
// $api->endpoint('/{userId}/programs/new', 'ProgramController.get');

$api->run();

