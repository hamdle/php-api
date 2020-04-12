<?php
namespace Database\Query;

use Database\Query;

class Entries extends Query
{
    protected const ENTRIES_TABLE = 'entries';

    public function add($args, $table = self::ENTRIES_TABLE)
    {
        parent::add($args, $table);
    }

    public function filter_args($args)
    {
        return $args;
    }
}
