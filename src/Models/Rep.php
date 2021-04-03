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
