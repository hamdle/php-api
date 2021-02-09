<?php

/*
 * index.php: entry point of the API
 *
 * Copyright (C) 2021 Eric Marty
 */

require __DIR__.'/src/autoload.php';

use Http\Api;

Api::get("auth", "controller.Authentication.authenticateUser");
Api::post("login", "controller.Authentication.login");
Api::get("exercises", "module.ExerciseTypes.getAllExercises");
Api::post("workouts/new", "module.Workouts.saveWorkout");

Api::respond();

?>
