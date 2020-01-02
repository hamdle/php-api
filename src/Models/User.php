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
}
