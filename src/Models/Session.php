<?php

/*
 * Models/Session.php: user session log
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Models;

class Session
{
    use \Utils\Attributes;

    /*
     * The Entry attributes defined in the database are:
     *
     * id
     * user_id
     * key
     * value
     */

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }
}
