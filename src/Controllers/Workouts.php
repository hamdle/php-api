<?php

/*
 * Controllers/Workouts.php: handle workout requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Controllers;

use Core\Http\Response;
use Core\Http\Request;
use Core\Http\Code;
use Core\Database\Query;
use Models\Session;
use Models\Workout;
use Models\Rep;
use Models\Exercise;
use Models\ExerciseType;

class Workouts
{
    /*
     * The default limit of workouts to query for a user. See allWorkouts().
     */
    const ALL_WORKOUTS_LIMIT = 20;

    /*
     * Handle request to save a workout.
     * @return \Http\Response
     */
    public function save()
    {
        $session = new Session();

        if (!$session->verify())
            return Response::send(Code::UNAUTHORIZED_401);

        $workout = new Workout(Request::complexData());
        $workout->user_id = $session->user->id;

        if (!$workout->validate())
            return Response::send(Code::UNPROCESSABLE_ENTITY_422, $workout->getMessages());

        if (!$workout->save())
            return Response::send(Code::INTERNAL_SERVER_ERROR_500);

        foreach (Request::complexData()["exercises"] ?? [] as $exerciseEntry)
        {
            $exercise = new Exercise($exerciseEntry);
            $exercise->workout_id = $workout->id;
            $exercise->user_id = $session->user->id;
            // Saving the exercise will unset `reps` since it"s not a field in
            // the `exercises` table. So we need to get the reps from this
            // exercise before saving it.
            $reps = $exerciseEntry["reps"] ?? [];

            if (!$exercise->validate())
                return Response::send(Code::UNPROCESSABLE_ENTITY_422, $exercise->getMessages());

            if (!$exercise->save())
                return Response::send(Code::INTERNAL_SERVER_ERROR_500);

            foreach ($reps as $repEntry)
            {
                $rep = new Rep($repEntry);
                $rep->exercise_id = $exercise->id;

                if (!$rep->validate())
                    return Response::send(Code::UNPROCESSABLE_ENTITY_422, $rep->getMessages());

                if (!$rep->save())
                    return Response::send(Code::INTERNAL_SERVER_ERROR_500);
            }
        }

        return Response::send(Code::CREATED_201);
    }

    /*
     * Handle request to get a list of all available exercie types.
     * @return \Http\Response
     */
    public function exerciseTypes()
    {
        $exerciseTypes = new ExerciseType();
        // TODO should we send a different response if the database fails
        return Response::send(Code::OK_200, $exerciseTypes->all());
    }

    /*
     * Handle request to a get a list of all workouts for a user.
     * @return \Http\Response
     */
    public function allWorkouts($limit = self::ALL_WORKOUTS_LIMIT)
    {
        $session = new Session();
        if (!$session->verify())
            return Response::send(Code::UNAUTHORIZED_401);

        $exerciseTypes = Query::run("
            select *
            from exercise_types
        ");

        $exerciseTypesByKey = [];
        foreach ($exerciseTypes as $exerciseType)
        {
            $exerciseTypesByKey[$exerciseType["id"]] = $exerciseType;
        }

        $workouts = Query::run("
            select *
            from workouts
            where workouts.user_id = {$session->user->id}
            limit " . $limit
        );
        $exercises = Query::run("
            select *
            from exercises
            where exercises.workout_id in
            (".implode(", ", array_column($workouts, "id")).")
        ");
        $reps = Query::run("
            select *
            from reps
            where reps.exercise_id in
            (".implode(", ", array_column($exercises, "id")).")
        ");

        $data = [];
        foreach ($workouts as $workout)
        {
            $data[$workout["id"]] = $workout;
        }

        foreach ($exercises as $exercise)
        {
            $data[$exercise["workout_id"]]["exercises"][$exercise["id"]] = $exercise;
            $data[$exercise["workout_id"]]["exercises"][$exercise["id"]]["exercise_type"] = $exerciseTypesByKey[$exercise["exercise_type_id"]];
            foreach ($reps as $rep)
            {
                if ($rep["exercise_id"] == $exercise["id"])
                {
                    $data[$exercise["workout_id"]]["exercises"][$exercise["id"]]["reps"][$rep["id"]] = $rep;
                    unset($reps[$rep["id"]]);
                }
            }
        }

        return Response::send(Code::OK_200, $data);
    }
}
