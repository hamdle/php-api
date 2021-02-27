<?php

/*
 * Traits/Attributes.php: Create dynamic attributes trait
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Traits;

trait Attributes
{
    protected $attributes = [];

    public function __get($attr)
    {
        return $this->get($attr);
    }

    public function __set($attr, $value)
    {
        $this->attributes[$attr] = $value;
    }

    private function get($attr)
    {
        if (array_key_exists($attr, $this->attributes))
            return $this->attributes[$attr];
        else
            return null;
    }
}

