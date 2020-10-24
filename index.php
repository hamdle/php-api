<?php

/*
 * index.php: entry point of the API
 *
 * Copyright (C) 2020 Eric Marty
 */

require __DIR__.'/src/autoload.php';

use Http\Api;

$api = new Api();

$api->endpoint("login", "AuthController.post");
$api->endpoint("auth", "AuthController.get");
$api->endpoint("workouts/new", "WorkoutController.post");
$api->endpoint("exercises", "ExerciseController.get");
// URI variables are supported using brackets, i.e.,
// $api->endpoint("{userId}/workouts/new", "WorkoutController.get");

$api->run();

?>
