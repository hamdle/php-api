<?php
require __DIR__.'/src/autoload.php';

use Http\Api;
use Utils\EnvLoader;

$env = new EnvLoader();
$env->load();

$api = new Api();
$api->endpoint('authenticate', 'AuthController.post');
$api->endpoint('{userId}/programs/new', 'ProgramController.get');
$api->run();

