<?php

/*
 * index.php: define the Api here
 *
 * Copyright (C) 2021 Eric Marty
 */

require __DIR__.'/src/autoload.php';

use Core\Api;
use Core\Http\Response;
use Core\Http\Code;

// TODO Update api to accept simpler three argument functions
//Api::get('version', 'Ping', 'version');
//Api::get('coffee', 'Ping', 'teapot');
//Api::get('auth', 'Authentication', 'verifySession');
//Api::get('exercises', 'Workouts', 'exerciseTypes');
//Api::get('workouts', 'Workouts', 'allWorkouts');
//Api::post('login', 'Authentication', 'login');
//Api::post('workouts/new', 'Workouts', 'save');

Api::get('version', function() {
    return Response::send(Code::OK_200, ["version" => $_ENV['VERSION']]);
});
Api::get('coffee', function() {
    return Response::send(Code::IM_A_TEAPOT_418, ["message" => "418 I'm a teapot"]);
});
Api::get('auth', ['\Controllers\Authentication', 'verifySession']);
Api::get('exercises', ['\Controllers\Workouts', 'exerciseTypes']);
Api::get('workouts', ['\Controllers\Workouts', 'allWorkouts']);
Api::post('login', ['\Controllers\Authentication', 'login']);
Api::post('workouts/new', ['\Controllers\Workouts', 'save']);

Api::respond();
