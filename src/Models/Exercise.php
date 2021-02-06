<?php

/*
 * Models/Exercise.php: an exercise that can be performed
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Models;

class Exercise
{
    use \Utils\Attributes;

    /*
     * The Exercise attributes defined in the database are:
     *
     * id
     * title
     * default_sets
     * default_reps
     * wait_time
     * category
     */

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }
}
