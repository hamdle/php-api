<?php

/*
 * Models/User.php: a workout app user
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Models;

// should the user be able to build itself, or should a user represent data
// from the database, aka no database entry, no user
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

    public function login($args = null)
    {
        return true;

        /*
        // The form can do this now
        $filteredArgs = array_map(function($item) {
                if (!is_null($item) && array_key_exists('password', $item)) 
                    $item['password'] = md5($item['password']);
                return $item;
            },
            $args
        );

        $users = new Users();
        $user = $users->filter_by($filteredArgs['post']);

        $id = $args[0];
        $user = new \Users\Entity($id);
        $user->update($filteredArgs);
        $user->getOrMakeCookie();
         */
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
