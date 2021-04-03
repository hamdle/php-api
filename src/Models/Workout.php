<?php

/*
 * Models/Workout.php: Handle workout data for the Api
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Models;

use \Database\Query;
use \Utils\Date;

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
     * @return int - ID of the inserted record
     */
    public function save()
    {
        $this->filter($this->config());

        // Add workout query parts here TODO
        /*
        $results = Query::insert(
            self::WORKOUT_TABLE,
            ["user_id", "token"],
            [$this->user_id, $this->token]);
         */

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
            'user_id' => function ($entry) {
                return is_numeric($entry);
            },
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

    public function transforms()
    {
        return [
            'user_id' => function ($entry) {
                return (int) $entry;
            },
            'start' => function ($entry) {
                return Date::timestampToDatetime($entry);
            },
            'end' => function ($entry) {
                return Date::timestampToDatetime($entry);
            },
            'notes' => function ($entry) {
                return $entry;
            },
            'feel' => function ($entry) {
                return empty($entry) ? 'average' : $entry;
            },
        ];
    }
}
