<?php

/*
 * Models/Rep.php: One round of an exercise
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Models;

class Rep
{
    use \Traits\Attributes;

    /*
     * The Rep attributes defined in the database are:
     *
     * id
     * entries_id
     * amount
     */

    protected const REPS_TABLE = 'reps';

}
