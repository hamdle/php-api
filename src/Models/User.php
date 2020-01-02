<?php
namespace Models;

class User
{
    use \Utils\Attributes;

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }
}
