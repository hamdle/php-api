<?php

/*
 * Forms/Workout.php: handle workout tasks
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Forms;

class Workout
{
    use \Traits\Attributes;
    use \Traits\Messages;

    public function __construct($attributes = [])
    {
        $this->config = [
            'start' => function ($entry) {
                return true;
            },
            'end' => function ($entry) {
                return true;
            },
            'notes' => function ($entry) {
                return true;
            },
            'feel' => function ($entry) {
                return true;
            },
            'entries' => function ($entry) {
                return true;
            },
        ];
        $this->attributes = $attributes;
        $this->filter();
    }

    /*
     * Run attributes through the config validation functions.
     * @return bool - false if one or many validatons failed
     */
    public function validate()
    {
        if (!isset($this->attributes))
            return false;

        foreach ($this->config as $key => $validator)
        {
            if (array_key_exists($key, $this->attributes))
            {
                if (($validationResponse = $validator($this->attributes[$key])) !== true)
                    $this->messages[$key] = $validationResponse;
            }
        }

        return empty($this->messages) ? true : false;
    }

    public function save($user)
    {
        return false;
    }
}
