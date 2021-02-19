<?php

/*
 * Models/User.php: a workout app user
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Models;

class User
{
    use \Traits\Attributes;

    /*
     * The User attributes defined in the database are:
     *
     * id
     * email
     * password
     */

    protected const USER_TABLE = 'users';

    private $messages = [];

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function getCookie()
    {
        return "";
    }

    public function authenticate()
    {
        // This function loads a user based on input arguments. The inputs 
        // need to be sanatized as the may come from user inputs.
        // If a user can't be found it should log errors, or other messages,
        // that can be sent back with the response.
        \Http\Request::post()
    }

    public function getMessages()
    {
        return $messages;
    }

    public function login($args = null)
    {
        return true;
    }

    /**
     * Return a single User object from an id.
     * @param $id - a user id
     * @return \Models\User
     */
    public function get($id, $table = self::USER_TABLE)
    {
        $queryResults = parent::get($id, $table);
        $user = new User($queryResults[0]);
        return $user;
    }

    /** 
     * Query the users table, return a User object or null.
     * @param map is a key, value array.
     * @return \Models\User
     */
    public function filter_by($map, $table = self::USER_TABLE)
    {
        $queryResults = parent::filter_by($map, $table);
        if ($queryResults == null) {
            return null;
        }
        return new User($queryResults[0]);
    }
}
