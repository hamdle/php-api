<?php

/*
 * Models/Rep.php: One round of an exercise
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Models;

class Rep
{
    use \Utils\Attributes;

    /*
     * The Rep attributes defined in the database are:
     *
     * id
     * entries_id
     * amount
     */

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }
}
