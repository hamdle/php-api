<?php

/*
 * Traits/AttributeActions.php: handle validation and filtering tasks
 *
 * validation = applying functions to an array of attributes
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Traits;

trait AttributeActions
{
    /*
     * Run attributes through the config validation functions.
     * @return bool - false if one or many validatons failed
     */
    public function validation($config)
    {
        // Can this function call $this->config() directly? TODO
        if (!isset($this->attributes))
            return false;

        $messages = [];
        foreach ($config as $key => $validator)
        {
            if (array_key_exists($key, $this->attributes))
            {
                if (($validationResponse = $validator($this->attributes[$key])) !== true)
                    $messages[$key] = $validationResponse;
            }
        }

        return empty($messages) ? true : $messages;
    }

    /*
     * Filter out attributes that are not in the config.
     * @return void
     */
    public function filter()
    {
        foreach ($this->attributes as $key => $attribute)
        {
            if (!array_key_exists($key, $this->config()))
                unset($this->attributes[$key]);
        }
    }

    /*
     * Run attributes through input transforms.
     * @return void
     */
    public function transform($transforms)
    {
        foreach ($transforms as $key => $transform)
        {
            if (array_key_exists($key, $this->attributes))
                $this->attributes[$key] = $transform($this->attributes[$key]);
        }
    }
}
