<?php

/*
 * Models/ExerciseType.php: handle exerciseType data requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Models;

use Database\Query;

class ExerciseType
{
    public const TABLE_NAME = 'exerciseTypes';

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function selectAll()
    {
        return Query::select(self::TABLE_NAME, "*");
    }
}
