<?php

/*
 * Utils/Configuration.php: Some fun stuff
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Utils;

class Configuration
{
    public static function __callStatic($fn, $args)
    {
        return (new Configuration())->fulful($fn, $args);
    }

    private function fulful($fn, $args)
    {
        if ($fn == "workout")
        {
            return [
                'start' => function ($entry) {
                    return is_numeric($entry);
                },
                'end' => function ($entry) {
                    return is_numeric($entry);
                },
                'notes' => function ($entry) {
                    return true;
                },
                'feel' => function ($entry) {
                    return true;
                },
                'entries' => function ($entry) {
                    return is_array($entry);
                },
            ];
        }
        if ($fn = "login")
        {
            return [
                'email' => function ($entry) {
                    if (empty($entry))
                        return "Email address should not be empty.";
                    return true;
                },
                'password' => function ($entry) {
                    if (empty($entry))
                        return "Password should not be empty.";
                    return true;
                },
            ];
        }
    }
}
