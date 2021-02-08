<?php

/*
 * Models/User.php: a workout app user
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Models;

use Database\Query\Sessions;

class User
{
    use \Utils\Attributes;

    /*
     * The User attributes defined in the database are:
     *
     * id
     * email
     * password
     */

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    /*
     * Create or return a user session cookie.
     * @return array - key, value pair
     */
    public function cookie() {
        $sessions = new Sessions();
        $session = $sessions->filter_by(['user_id' => $this->id]);
        //\Modules\Sessions\Model::cookie($this->id);

        if (is_null($session))
        {
            $key = md5(random_int(PHP_INT_MIN, PHP_INT_MAX));
            $value = md5($this->email.$_ENV['COOKIE_NOISE']);
            $sessions->save($this->id, $key, $value);

            return [$key => $value];
        }

        return [$session->key => $session->value];
    }
}
