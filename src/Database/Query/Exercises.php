<?php
namespace Database\Query;

use Database\Query;

class Exercises extends Query
{
    protected const EXERCISE_TABLE = 'exercises';

    public function all()
    {
        return parent::filter_by([], self::EXERCISE_TABLE);
    }
}
