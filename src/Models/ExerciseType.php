<?php

/*
 * Models/ExerciseType.php: handle exerciseType data requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Models;

use Database\Record;
use Database\Query;

class ExerciseType extends Record
{
    public const TABLE_NAME = 'exerciseTypes';

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function all()
    {
        return Query::select(self::TABLE_NAME, "*");
    }
}
