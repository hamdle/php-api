<?php
require __DIR__.'/src/autoload.php';

use Http\Api;

$api = new Api();

$api->endpoint('login', 'AuthController.post');
$api->endpoint('{userId}/workouts/new', 'WorkoutController.get');

$api->run();

