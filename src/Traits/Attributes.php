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
    protected $config = [];

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
        if (array_key_exists($attr, $this->attributes ?? []))
            return $this->attributes[$attr];
        else
            return null;
    }

    /*
     * Filter out attributes that are not in the config.
     * @return void
     */
    public function filter()
    {
        foreach ($this->attributes as $key => $attribute)
        {
            if (!array_key_exists($key, $this->config))
            {
                unset($this->attributes);
            }
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
            if (array_key_exists($key, $this->attributes))
                $this->attributes[$key] = $transform($this->attributes[$key]);
        }
    }
}
