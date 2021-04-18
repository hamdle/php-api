<?php

/*
 * index.php: define the Api here
 *
 * Copyright (C) 2021 Eric Marty
 */

require __DIR__.'/src/autoload.php';

use Http\Api;
use Http\Response;

Api::get('version', function() {
    return Response::send(\Http\Code::OK_200, ["version" => $_ENV['VERSION']]);
});
Api::get('auth', ['\Controllers\Authentication', 'verifySession']);
Api::get('exercises', ['\Controllers\Workouts', 'exerciseTypes']);
Api::get('workouts', ['\Controllers\Workouts', 'allWorkouts']);
Api::post('login', ['\Controllers\Authentication', 'login']);
Api::post('workouts/new', ['\Controllers\Workouts', 'save']);

Api::respond();
