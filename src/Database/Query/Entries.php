<?php
namespace Database\Query;

use Database\Query;

class Entries extends Query
{
    protected const ENTRIES_TABLE = 'entries';

    public function add($args, $table = self::ENTRIES_TABLE)
    {
        return parent::add($args, $table);
    }

    public function filter_args($args)
    {
        $filtered_args = $args;
        // 'reps' are not processed here.
        unset($filtered_args['reps']);
        
        return $filtered_args;
    }
}
