<?php
namespace Models;

class Entry
{
    use \Utils\Attributes;
    /**
     * The Entry attributes defined by the database are:
     *
     * id
     * exercises_id
     * workout_id
     * user_id
     * sets
     * reps
     * feedback (up, down, none)
     *
     */

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }
}
