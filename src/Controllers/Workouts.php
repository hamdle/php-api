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
            return Response::send(\Http\Code::UNAUTHORIZED_401);

        $workout = new Workout(Request::complexData());
        $workout->user_id = $session->user->id;

        if (!$workout->validate())
            return Response::send(\Http\Code::UNPROCESSABLE_ENTITY_422, $workout->getMessages());

        if (!$workout->save())
            return Response::send(\Http\Code::INTERNAL_SERVER_ERROR_500);

        foreach (Request::complexData()['exercises'] ?? [] as $exerciseEntry)
        {
            $exercise = new Exercise($exerciseEntry);
            $exercise->workout_id = $workout->id;
            $exercise->user_id = $session->user->id;
            // Saving the exercise will unset `reps` since it's not a field in
            // the `exercises` table. So we need to get the reps from this
            // exercise before saving it.
            $reps = $exerciseEntry['reps'] ?? [];

            if (!$exercise->validate())
                return Response::send(\Http\Code::UNPROCESSABLE_ENTITY_422, $exercise->getMessages());

            if (!$exercise->save())
                return Response::send(\Http\Code::INTERNAL_SERVER_ERROR_500);

            foreach ($reps as $repEntry)
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

    /*
     * Handle request to get a list of all available exercie types.
     * @return \Http\Response
     */
    public function exerciseTypes()
    {
        return Response::send(\Http\Code::OK_200, (new ExerciseType())->all());
    }

    /*
     * Handle request to a get a list of all workouts for a user.
     * @return \Http\Response
     */
    public function allWorkouts($limit = self::ALL_WORKOUTS_LIMIT)
    {
        $session = new Session();
        if (!$session->verify())
            return Response::send(\Http\Code::UNAUTHORIZED_401);

        $workouts = \Database\Query::run("
            select *
            from workouts
            where workouts.user_id = {$session->user->id}
            limit " . $limit
        );
        $exercises = \Database\Query::run("
            select *
            from exercises
            where exercises.workout_id in
            (".implode(", ", array_column($workouts, 'id')).")"
        );
        $reps = \Database\Query::run("
            select *
            from reps
            where reps.exercise_id in
            (".implode(", ", array_column($exercises, 'id')).")"
        );

        $data = [];
        foreach ($workouts as $workout)
        {
            $data[$workout['id']] = $workout;
        }
        foreach ($exercises as $exercise)
        {
            $data[$exercise['workout_id']]['exercises'][$exercise['id']] = $exercise;
        }
        foreach ($reps as $rep)
        {
            $data[$exercise['workout_id']]['exercises'][$rep['exercise_id']]['reps'][$rep['id']] = $rep;
        }

        return Response::send(\Http\Code::OK_200, $data);
    }
}
