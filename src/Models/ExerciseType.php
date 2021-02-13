<?php

/*
 * Modules/ExerciseTypes/Model.php: handle exerciseType data requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Modules\ExerciseTypes;

use Database\MySQL\Query;

class Model
{
    protected const EXERCISE_TYPES_TABLE = 'exerciseTypes';

    public function all()
    {
        $query = new Query();
        return $query->execute([], self::EXERCISE_TYPES_TABLE);
    }
}
