<?php

/*
 * index.php: entry point of the API
 *
 * Copyright (C) 2021 Eric Marty
 */

require __DIR__.'/src/autoload.php';

use Http\Api;
use Http\Response;

Api::get('ping', function() {
    return Response::send(\Http\Response::HTTP_200_OK, 'ping');
});
Api::get('version', function() {
    return Response::send(\Http\Response::HTTP_200_OK, $_ENV['VERSION']);
});
Api::get('auth', [new \Controllers\Authentication(), 'authenticateUser']);
Api::get('exercises', [new \Controllers\ExerciseTypes(), 'getAllExercises']);
Api::post('login', [new \Controllers\Authentication(), 'login']);
Api::post('workouts/new', [new \Controllers\Workouts(), 'saveWorkout']);

Api::respond();

?>
