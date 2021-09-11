<?php

/*
 * index.php: define the Api here
 *
 * This framework uses an easy to understand framework that works like so:
 *
 * Use the Api to map endpoints to controller functions by request type. When
 * the Api responds it will route the request to the Api-defined function in
 * the controller. The Controllers use Models to read and write data and return
 * a Response. The Core contains general classes for handling data and Http
 * requests along with helper functions in Utils.
 *
 * Which leads to a simple file structure like this:
 *
 * src/
 *   Controllers/   - Put functions that use data to respond to requests here
 *   Modules/       - Database related classes go here, typically one per table
 *   Core/          - General functions along with Utils and Http helpers
 *
 * Copyright (C) 2021 Eric Marty
 */

require __DIR__."/src/autoload.php";

use Core\Api;

Api::get("auth", "Authentication", "verifySession");
Api::get("exercises", "Workouts", "exerciseTypes");
Api::get("workouts", "Workouts", "allWorkouts");
Api::get("version", "AppInfo", "version");
Api::get("coffee", "AppInfo", "teapot");
Api::get("roll", "Dice", "d20");

Api::post("login", "Authentication", "login");
Api::post("workouts/new", "Workouts", "save");

return Api::respond();
