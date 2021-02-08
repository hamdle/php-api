<?php

/*
 * Http/Controllers/Exercise.php: handle exercise requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Http\Controllers;

use Misc\Routing;
use Modules\Exercises;
use Http\Response;

class Exercise extends Routing\Registration {
    public static $registration = ["controller" => "Exercise"];

    public static function getAllExercises() {
        $exercises = new Exercises\Model();
        $all = $exercises->all();

        $response = new Response();
        return $response->send(Response::HTTP_200_OK, $all);
    }
}
