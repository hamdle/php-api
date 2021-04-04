<?php

/*
 * Database/Record.php: a record from the database
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Database;

abstract class Record
{
    use \Traits\Messages;

    public $attributes = [];

    abstract public function table();
    abstract public function config();
    abstract public function transforms();

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

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
     * Save this record.
     * @return int - ID of the inserted record
     */
    public function save()
    {
        $this->filter();
        $this->transform($this->transforms());

        $results = Query::insert(
            $this->table(),
            array_keys($this->attributes),
            array_values($this->attributes));

        return true;
    }

    /*
     * Run the validation and return error messages.
     * @return bool - false if one or many validatons failed
     */
    public function validate()
    {
        if (($results = $this->validation($this->config())) !== true)
        {
            $this->messages[] = $results;
            return false;
        }

        return true;
    }

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
