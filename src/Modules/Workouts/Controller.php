<?php

/*
 * Modules/Workouts/Controller.php: handle workout requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Modules\Workouts;

use Misc\Routing;
use Http\Response;

class Controller extends Routing\ControllerAlias {
    public static $alias = ["module" => "Workouts"];

    public static function saveWorkout() {
        $response = new Response();
        return $response->send(Response::HTTP_200_OK);

        /*
        $response = new Response();
        $sessions = new Sessions();
        $data_args = $args['data'];

        $user = $sessions->verify(); 
        if ($user) {
            $workouts = new Workouts();
            $entries = new Entries();
            $reps = new Reps();

            // Save workout to database.
            $data_args['user_id'] = $user->id;
            $data_args['start'] = \Utils\Date::timestampToDatetime($data_args['start']);
            $data_args['end'] = \Utils\Date::timestampToDatetime($data_args['end']);
            // TODO: Filter 'feel' properly.
            $data_args['feel'] = 'average';
            $workout_id = $workouts->add($workouts->filter_args($data_args));
            if ($workout_id == null) {
                return $response->send(Response::HTTP_400_BAD_REQUEST, 'There was a database error creating the workout.');
            }

            $entries_args = $data_args['entries'];

            for ($index = 0; $index < count($entries_args); $index++) {
                // Save entries to database.
                $entries_args[$index]['user_id'] = $user->id;
                $entries_args[$index]['workout_id'] = $workout_id;
                // TODO: Filter 'feedback' properly.
                $entries_args[$index]['feedback'] = 'none';
                $entries_id = $entries->add($entries->filter_args($entries_args[$index]));
                if ($entries_id == null) {
                    return $response->send(Response::HTTP_400_BAD_REQUEST, 'There was a database error creating an exercise entry.');
                }

                $reps_args = $entries_args[$index]['reps'];
                foreach ($reps_args as $rep) {
                    // Save reps to database.
                    $rep['entries_id'] = $entries_id;
                    $reps_id = $reps->add($reps->filter_args($rep));
                    if ($reps_id == null) {
                        return $response->send(Response::HTTP_400_BAD_REQUEST, 'There was a database error creating a rep.');
                    }
                }
            }

            return $response->send(Response::HTTP_200_OK, 'Workout saved sucessfully.');
        }

        return $response->send(Response::HTTP_401_UNAUTHORIZED);
        */
    }
}
