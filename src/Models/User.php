<?php
namespace Models;

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
        $key = md5(random_int(PHP_INT_MIN, PHP_INT_MAX));
        $value = md5($this->email.$_ENV['COOKIE_NOISE']);

        return [$key => $value];
    }
}
