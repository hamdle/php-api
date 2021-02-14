<?php

/*
 * Http/Controllers/Exercise.php: handle exercise requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Controllers;

use Http\Response;
use Models\ExerciseType;

class ExerciseTypes
{
    public static function getAllExercises()
    {
        $exerciseType = new ExerciseType();
        return Response::send(Response::HTTP_200_OK, $exerciseType->selectAll());
    }
}
