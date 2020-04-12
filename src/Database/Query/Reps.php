<?php
namespace Database\Query;

use Database\Query;

class Reps extends Query
{
    protected const REPS_TABLE = 'reps';

    public function add($args, $table = self::REPS_TABLE)
    {
        \Utils\ErrorLog::print($args, $table);
        //parent::add($args, $table);
    }

    public function filter_args($args)
    {
        return $args;
    }
}
