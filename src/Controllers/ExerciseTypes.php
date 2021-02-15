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
    public function getAllExercises()
    {
        return Response::send(Response::HTTP_200_OK, (new ExerciseType())->selectAll());
    }
}
