<?php
namespace Database\Query;

use Database\Query;
use Database\Query\Exercises;
use Models\Workout;

class Workouts extends Query
{
    protected const WORKOUT_TABLE = 'workouts';

    public function add($args, $table = self::WORKOUT_TABLE)
    {
        return parent::add($args, $table);
    }

    public function filter_args($args)
    {
        $filtered_args = $args;
        // 'entries' and 'reps' are not processed here.
        unset($filtered_args['entries']);
        
        return $filtered_args;
    }
}
