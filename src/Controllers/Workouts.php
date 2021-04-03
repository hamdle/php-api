<?php

/*
 * Controllers/Workouts.php: handle workout requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Controllers;

use Http\Response;
use Http\Request;
use Models\Session;
use Models\Workout;
use Models\Rep;
use Models\Exercise;

class Workouts
{
    /*
     * Handle request to save a workout.
     * @return \Http\Response
     */
    public function saveWorkout()
    {
        $session = new Session();
        if (!$session->verify())
            return Response::send(\Http\Code::UNAUTHORIZED_401);

        $workout = new Workout(Request::complexData());
        $workout->user_id = $session->user->id;

        if (!$workout->validate())
            return Response::send(\Http\Code::UNPROCESSABLE_ENTITY_422, $workout->getMessages());

        if (!$workout->save())
            return Response::send(\Http\Code::INTERNAL_SERVER_ERROR_500);

        foreach ($workout->entries ?? [] as $exerciseEntry)
        {
            $exercise = new Exercise($exerciseEntry);
            $exercise->workout_id = $workout->id;
            $exercise->user_id = $session->user->id;

            if (!$exercise->validate())
                return Response::send(\Http\Code::UNPROCESSABLE_ENTITY_422, $exercise->getMessages());

            if (!$exercise->save())
                return Response::send(\Http\Code::INTERNAL_SERVER_ERROR_500);

            foreach ($exerciseEntry['reps'] ?? [] as $repEntry)
            {
                $rep = new Rep($repEntry);
                $rep->exercise_id = $exercise->id;

                if (!$rep->validate())
                    return Response::send(\Http\Code::UNPROCESSABLE_ENTITY_422, $rep->getMessages());

                if (!$rep->save())
                    return Response::send(\Http\Code::INTERNAL_SERVER_ERROR_500);
            }
        }

        return Response::send(\Http\Code::CREATED_201);
    }
}
