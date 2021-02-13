<?php

/*
 * Http/Controllers/Exercise.php: handle exercise requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Controllers;

use Http\Response;

class ExerciseTypes {
    public static function getAllExercises() {
        //$exercise = new Exercise();
        //$all = $exercises->all();

        return Response::send(Response::HTTP_200_OK, "All exercises");
    }
}
