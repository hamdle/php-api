<?php

/*
 * index.php: entry point of the API
 *
 * Copyright (C) 2021 Eric Marty
 */

require __DIR__.'/src/autoload.php';

use Http\Api;

Api::endpoint("login", "AuthController.post");
Api::endpoint("auth", "AuthController.get");
Api::endpoint("workouts/new", "WorkoutController.post");
Api::endpoint("exercises", "ExerciseController.get");
// URI variables are supported using brackets, i.e.,
// Api::endpoint("{userId}/workouts/new", "WorkoutController.get");

Api::run();

?>
