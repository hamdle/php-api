<?php

/*
 * Modules/Exercises/Model.php: handle exercise data needs
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Modules\Exercises;

use Database\MySQL\Query;

class Model extends Query
{
    protected const EXERCISE_TABLE = 'exercises';

    public function all()
    {
        return parent::filter_by([], self::EXERCISE_TABLE);
    }
}
