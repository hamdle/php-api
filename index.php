<?php

/*
 * index.php: define the Api here
 *
 * This framework uses a simple mental model and works like so:
 *
 * Endpoints map to functions that handle them in the root Controllers
 * directory. The Api responds by matching the request to an endpoint and
 * calling the endpoint's controller function. Use Models, located in the root
 * Models directory, to interact with the database. Support functions, like
 * date and debug helpers, can be found in \Core\Utils. And that's about it.
 * For more details check out the individual file(s) you're interested in.
 *
 * Copyright (C) 2021 Eric Marty
 */

require __DIR__.'/src/autoload.php';

use Core\Api;

Api::get('version', 'Cats', 'verifySession');
Api::get('auth', 'Authentication', 'verifySession');
Api::get('exercises', 'Workouts', 'exerciseTypes');
Api::get('workouts', 'Workouts', 'allWorkouts');
Api::post('login', 'Authentication', 'login');
Api::post('workouts/new', 'Workouts', 'save');
/*
Api::get('version', function() {
    return Response::send(Code::OK_200, ["version" => $_ENV['VERSION']]);
});
Api::get('coffee', function() {
    return Response::send(Code::IM_A_TEAPOT_418, ["message" => "418 I'm a teapot"]);
});
 */

return Api::respond();
