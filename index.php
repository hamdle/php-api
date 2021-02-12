<?php

/*
 * index.php: entry point of the API
 *
 * Copyright (C) 2021 Eric Marty
 */

require __DIR__.'/src/autoload.php';

use Http\Api;

// Api format::
// alias.class.function
Api::get("auth", "controller.Authentication.authenticateUser");
Api::get("exercises", "module.ExerciseTypes.getAllExercises");

Api::get("version", "http.App.version");
Api::get("ping", "http.App.pong");

Api::post("login", "controller.Authentication.login");
Api::post("workouts/new", "module.Workouts.saveWorkout");

Api::respond();

?>
