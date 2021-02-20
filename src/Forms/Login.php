<?php

/*
 * Forms/Login.php: handle login form tasks
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Forms;

use Http\Request;

class Login
{
    use \Traits\Messages;

    private $config = [];

    public function __construct()
    {
        $this->config = [
            'email' => (function ($entry) {
                if (empty($entry))
                    return "Email address should not be empty.";
                return true;
            }),
            'password' => (function ($entry) {
                if (empty($entry))
                    return "Password should not be empty.";
                return true;
            }),
        ];
    }

    public function validate()
    {
        foreach ($this->config as $key => $validator)
        {
            if (array_key_exists($key, Request::post()))
            {
                if (($validationResponse = $validator(Request::post()[$key])) !== true)
                {
                    $this->messages[] = $validationResponse;
                }
            }
        }
        return empty($this->messages) ? true : false;
    }

    public function createUserFromInput()
    {
        // use array function to use only the keys from $config TODO
        return new \Models\User(\Http\Request::post());
    }
}
