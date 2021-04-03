<?php

/*
 * Models/Rep.php: One round of an exercise
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Models;

use Database\Record;

class Rep extends Record
{
    protected const REPS_TABLE = 'reps';

    public function validate()
    {
        return true;
    }

    public function save()
    {
        return true;
    }

    public function config()
    {
        return [];
    }

    public function transforms()
    {
        return [];
    }
}
