<?php

/*
 * Models/Rep.php: a single round of an exercise
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Models;

use Database\Record;

class Rep extends Record
{
    public function table()
    {
        return 'reps';
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
