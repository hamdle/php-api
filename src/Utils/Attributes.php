<?php
namespace Utils;

trait Attributes
{
    protected $attributes = [];

    public function __get($attr)
    {
        return $this->get($attr);
    }

    public function __set($attr, $value)
    {
        // TODO Make this safe.
        $this->attributes[$attr] = $value;
    }

    private function get($attr)
    {
        if (array_key_exists($attr, $this->attributes))
        {
            return $this->attributes[$attr];
        }
        else
        {
            return null;
        }
    }
}

