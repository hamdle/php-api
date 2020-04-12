<?php
namespace Database\Query;

use Database\Query;

class Entries extends Query
{
    protected const ENTRIES_TABLE = 'entries';

    public function add($args, $table = self::ENTRIES_TABLE)
    {
        \Utils\ErrorLog::print($args, $table);
        //parent::add($args, $table);
    }

    public function filter_args($args)
    {
        $filtered_args = $args;
        // TODO:
        // 1. Add exercise_id.
        // 2. Add workout_id.
        // 3. Add user_id.
        // 4. Count reps and update/verify it.
        
        return $filtered_args;
    }
}
