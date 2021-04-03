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
    use \Traits\AttributeActions;
    use \Traits\Messages;

    /*
     * The Rep attributes defined in the database are:
     *
     * id
     * entries_id
     * amount
     */

    protected const REPS_TABLE = 'reps';

    public function validate()
    {
        return true;
    }

    public function save()
    {
        return true;
    }
}
