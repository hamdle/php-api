<?php

/*
 * Controllers/Exercise.php: handle exercise (type) requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Controllers;

use Http\Response;
use Models\ExerciseType;

class ExerciseTypes
{
    /*
     * Handle request to get a list of all available exercies.
     * @return \Http\Response
     */
    public function getAllExercises()
    {
        return Response::send(Response::HTTP_200_OK, (new ExerciseType())->selectAll());
    }
}
