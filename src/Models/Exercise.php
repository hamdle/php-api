<?php
namespace Models;

class Exercise
{
    use \Utils\Attributes;
    /**
     * The Exercise attributes defined by the database are:
     *
     * id
     * title
     * default_sets
     * default_reps
     * wait_time
     * category (bmb, core)
     *
     */

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }
}
