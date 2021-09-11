<?php

/*
 * Core/Utils/Log.php: print messages to the PHP's error log
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Core\Utils;

class Log {
    /*
     * Print message to error log.
     * @return null
     */
    public static function error($value = null, $tag = "")
    {
        error_log("__".($tag ?? "START")."__< ".print_r($value, true)." >__".
            ($tag ?? "END")."__");
    }

    /*
     * Print message to error log and exit program.
     * @return null
     */
    public static function errorAndExit($value = null, $tag = "")
    {
        self::error($value, $tag);
        exit;
    }
}
