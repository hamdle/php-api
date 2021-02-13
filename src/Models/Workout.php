<?php

/*
 * Models/Workout.php: Handle workout data for the Api
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Models\Workout;

class Workout
{
    use \Traits\Attributes;

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
}
