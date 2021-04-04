<?php

/*
 * Models/ExerciseType.php: handle exercise type data requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Models;

use Database\Record;
use Database\Query;

class ExerciseType extends Record
{
    public function table()
    {
        return 'exercise_types';
    }

    public function all()
    {
        return Query::select($this->table(), "*");
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
