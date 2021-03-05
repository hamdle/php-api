<?php

/*
 * Forms/Login.php: handle login form tasks
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Forms;

class Login
{
    use \Traits\Attributes;
    use \Traits\Messages;

    public function __construct($attributes = [])
    {
        $this->config = [
            'email' => function ($entry) {
                if (empty($entry))
                    return "Email address should not be empty.";
                return true;
            },
            'password' => function ($entry) {
                if (empty($entry))
                    return "Password should not be empty.";
                return true;
            },
        ];
        $this->filter($attributes);
    }

    /*
     * Run attributes through the config validation functions.
     * @return bool - false if one or many validatons failed
     */
    public function validate()
    {
        foreach ($this->config as $key => $validator)
        {
            if (array_key_exists($key, $this->attributes))
            {
                if (($validationResponse = $validator($this->attributes[$key])) !== true)
                    $this->messages[] = $validationResponse;
            }
        }

        return empty($this->messages) ? true : false;
    }
}
