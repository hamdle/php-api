<?php

/*
 * Core/Utils/Date.php: Date helper functions
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Core\Utils;

class Date
{
    /*
     * Format timestamp to datetime.
     * @return string
     */
    public static function timestampToDatetime($timestamp)
    {
        return date("Y-m-d H:i:s", $timestamp);
    }
}
