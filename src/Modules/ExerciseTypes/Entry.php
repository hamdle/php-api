<?php

/*
 * Modules/Entry.php: an exercise entry, performing an exercise
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Modules\ExerciseTypes;

class Entry
{
    use \Misc\Traits\Attributes;

    /*
     * The Entry attributes defined in the database are:
     *
     * id
     * exercises_id
     * workout_id
     * user_id
     * sets
     * feedback 
     */

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }
}
