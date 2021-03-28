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
    use \Traits\Attributes;
    use \Traits\AttributeActions;
    use \Traits\Messages;

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
