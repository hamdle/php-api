<?php

/*
 * Http/Controllers/Exercise.php: handle exercise requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Modules\ExerciseTypes;

use Misc\Routing;
use Http\Response;

class Controller extends Routing\Registration {
    public static $registration = ["module" => "ExerciseTypes"];

    public static function getAllExercises() {
        $exercises = new Model();
        $all = $exercises->all();

        $response = new Response();
        return $response->send(Response::HTTP_200_OK, $all);
    }
}
