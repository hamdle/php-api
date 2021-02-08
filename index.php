<?php

/*
 * index.php: entry point of the API
 *
 * Copyright (C) 2021 Eric Marty
 */

require __DIR__.'/src/autoload.php';

use Http\Api;

// URI variables are supported using brackets, i.e.,
// Api::endpoint("{userId}/workouts/new", "WorkoutController.get");

Api::controllers(
    [
        'Http\Controllers\Authentication',
        'Http\Controllers\Exercise',
        'Http\Controllers\Error',
    ]);

Api::get("auth", "controller.Authentication.authenticateUser");
Api::post("login", "controller.Authentication.login");
Api::get("exercises", "controller.Exercise.getAllExercises");
Api::post("workouts/new", "contoller.Workout.saveWorkout");

Api::respond();

?>
