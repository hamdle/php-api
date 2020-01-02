<?php
require __DIR__.'/src/autoload.php';

use Http\Api;

$api = new Api();

$api->endpoint('authenticate', 'AuthController.post');
$api->endpoint('{userId}/programs/new', 'ProgramController.get');

$api->run();

