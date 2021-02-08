<?php

/*
 * Models/Exercise/Entry.php: an exercise entry object, a single exercise
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Modules\Exercises;

class Entry
{
    use \Misc\Traits\Attributes;

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
