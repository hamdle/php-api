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

    public $fields = [];

    abstract public function table();
    abstract public function config();
    abstract public function transforms();

    public function __construct($fields = [])
    {
        $this->fields = $fields;
    }

    public function __get($field)
    {
        return $this->get($field);
    }

    public function __set($field, $value)
    {
        $this->fields[$field] = $value;
    }

    private function get($field)
    {
        if (array_key_exists($field, $this->fields ?? []))
            return $this->fields[$field];
        else
            return null;
    }

    /*
     * Save this record.
     * @return numeric ID of the inserted record or false
     */
    public function save()
    {
        $this->filter();
        $this->transform($this->transforms());

        $id = Query::insert(
            $this->table(),
            array_keys($this->fields),
            array_values($this->fields));

        return is_numeric($id);
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
     * Run fields through the config validation functions.
     * @return bool - false if one or many validatons failed
     */
    public function validation($config)
    {
        // Can this function call $this->config() directly? TODO
        if (!isset($this->fields))
            return false;

        $messages = [];
        foreach ($config as $key => $validator)
        {
            if (array_key_exists($key, $this->fields))
            {
                if (($validationResponse = $validator($this->fields[$key])) !== true)
                    $messages[$key] = $validationResponse;
            }
        }

        return empty($messages) ? true : $messages;
    }

    /*
     * Filter out fields that are not in the config.
     * @return void
     */
    public function filter()
    {
        foreach ($this->fields as $key => $field)
        {
            if (!array_key_exists($key, $this->config()))
                unset($this->fields[$key]);
        }
    }

    /*
     * Run fields through input transforms.
     * @return void
     */
    public function transform($transforms)
    {
        // use $this->transforms() now that it is required TODO
        foreach ($transforms as $key => $transform)
        {
            if (array_key_exists($key, $this->fields))
                $this->fields[$key] = $transform($this->fields[$key]);
        }
    }
}
