<?php
namespace Models;

class Workout
{
    use \Utils\Attributes;
    /**
     * The Workout attributes defined by the database are:
     *
     * id
     * user_id
     * start
     * end
     * notes
     * feel (weak, good, strong)
     *
     */

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }
}
