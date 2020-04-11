<?php
namespace Models;

use Database\Query\Sessions;

class User
{
    use \Utils\Attributes;
    /**
     * The User attributes defined by the database are:
     *
     * id
     * email
     * password
     *
     */

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function cookie() {
        $sessions = new Sessions();
        $session = $sessions->filter_by(['user_id' => $this->id]);

        if ($session == null) {
            $key = md5(random_int(PHP_INT_MIN, PHP_INT_MAX));
            $value = md5($this->email.$_ENV['COOKIE_NOISE']);
            // TODO: This needs to verify it got a return and save return the key, value pair.
            $newSession = $sessions->save($this->id, $key, $value);
            return [$key => $value];
        }

        return [$session->key => $session->value];
    }
}
