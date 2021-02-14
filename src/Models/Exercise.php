<?php

/*
 * Modules/Exercise.php: handle exercise data requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Models;

class Exercise
{
    use \Traits\Attributes;

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

    public const TABLE_NAME = 'exercises';

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }
}
