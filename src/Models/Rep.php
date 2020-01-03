<?php
namespace Models;

class Rep
{
    use \Utils\Attributes;
    /**
     * The Rep attributes defined by the database are:
     *
     * id
     * entries_id
     * amount
     *
     */

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }
}
