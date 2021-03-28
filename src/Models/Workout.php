<?php

/*
 * Models/Workout.php: Handle workout data for the Api
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Models;

use Database\Query;

class Workout
{
    use \Traits\Attributes;
    use \Traits\AttributeActions;
    use \Traits\Messages;

    /*
     * The Workout attributes defined in the database are:
     *
     * id
     * user_id
     * start
     * end
     * notes
     * feel
     */

    protected const WORKOUT_TABLE = 'workouts';

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    /*
     * Save a new workout.
     * @param $user - this user should be verified already. The best place to
     * get a verified user is directly from a session that has been verified().
     * @return bool - true, able to build and save the workout to the database
     */
    public function save($user)
    {
        $this->filter($this->config());

        Query::insert(
            self::WORKOUT_TABLE,
            ["user_id", "token"],
            [$user->id, $this->token]);

        return true;
    }

    public function validate()
    {
        if (($results = $this->validation($this->config())) !== true)
        {
            $this->messages[] = $results;
            return false;
        }

        return true;
    }

    public function config()
    {
        return [
            'start' => function ($entry) {
                return is_numeric($entry);
            },
            'end' => function ($entry) {
                return is_numeric($entry);
            },
            'notes' => function ($entry) {
                return true;
            },
            'feel' => function ($entry) {
                return true;
            },
        ];
    }
}
