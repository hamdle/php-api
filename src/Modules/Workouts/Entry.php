<?php

/*
 * Models/Workout.php: a workout
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Models;

class Workout
{
    use \Utils\Attributes;

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

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }
}
