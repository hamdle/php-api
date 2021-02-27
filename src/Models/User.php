<?php

/*
 * Models/User.php: a workout app user
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Models;

use \Http\Response;
use \Database\Query;

class User
{
    use \Traits\Attributes;
    use \Traits\Messages;

    /*
     * The User attributes defined in the database are:
     *
     * id
     * email
     * password
     */

    private const USER_TABLE = 'users';
    private $config = [];

    public function __construct($attributes = [])
    {
        $this->config = [
            'email' => function ($entry) {
                return $entry;
            },
            'password' => function ($entry) {
                return md5($entry);
            },
        ];
        $this->attributes = $attributes;
    }

    /*
     * Filter out attributes that are not in the config.
     * @return void
     */
    private function filter($attributes)
    {
        foreach ($attributes as $key => $attribute)
        {
            if (array_key_exists($key, $this->config))
                $this->attributes[$key] = $attribute;
        }
    }

    /*
     * Run attributes through input transforms.
     * @return void
     */
    public function transform()
    {
        foreach ($this->config as $key => $transform)
        {
            $this->attributes[$key] = $transform($this->attributes[$key]);
        }
    }

    public function load()
    {
        $this->filter($this->attributes);
        $this->transform();

        // Find in database
        $str = [];
        foreach ($this->attributes as $key => $attribute)
        {
            $str[] = $key . " = '" . $attribute . "'";
        }

        // This should happen so this whole thing needs to be moved into Query
        // $str[1] = $mysqli->real_escape_string($str[1]);
        $results = Query::run(
            "select * from ".self::USER_TABLE.
            " where ".$str[0]." and ".$str[1]);

        if (array_key_exists(0, $results))
        {
            // Add to attributes
            foreach ($results[0] as $key => $value)
            {
                $this->attributes[$key] = $value;
            }
        }
        else
        {
            $this->message[] = "User not found.";
            return false;
        }

        return true;
    }

    /*
     * Login user by verifying user and creating cookie. This funciton will
     * add the cookie to the Response.
     * @return bool
     */
    public function login()
    {
        if ($this->load())
        {
            Response::addCookie($this->getOrMakeCookie());
            return true;
        }

        return false;
    }

    /*
     * Return the users cookie his function assumes the user has been loaded
     * @return string - cookie
     */
    public function getOrMakeCookie()
    {
        return [md5(random_int(PHP_INT_MIN, PHP_INT_MAX)),
                md5($this->email.$_ENV['COOKIE_NOISE'])];

        /*
         * The new code
        $cookie = new Session($this->id);
        if (!$cookie->load() || $cookie->expired())
        {
            $cookie->delete();

            $newCookie = new Session([
                'key' => md5(random_int(PHP_INT_MIN, PHP_INT_MAX)),
                'value' => md5($this->email.$_ENV['COOKIE_NOISE'])]);
            $newCookie->save();

            return $newCookie->toArray();
        }

        return $cookie->toArray();
         */

        /*
         * The old code
        // 1. search for a session (cookie) that already exists
        $sessions = new Sessions();
        $session = $sessions->filter_by(['user_id' => $this->id]);

        // 2. or make a new cookie
        if ($session == null) {
        $key = md5(random_int(PHP_INT_MIN, PHP_INT_MAX));
         $value = md5($this->email.$_ENV['COOKIE_NOISE']);
         // TODO: How do we know if this fails?
        // 3. save the new cookie into sessions
         $sessions->save($this->id, $key, $value);
         return [$key => $value];
         }
        // 4. return the cookie to be sent with request
        return [$session->key => $session->value];
         */
    }

    /** 
     * Query the users table, return a User object or null.
     * @param map is a key, value array.
     * @return \Models\User
     */
    public function filter_by($map, $table = self::USER_TABLE)
    {
        /*
        $queryResults = parent::filter_by($map, $table);
        if ($queryResults == null) {
            return null;
        }
        return new User($queryResults[0]);
         */
    }
}
