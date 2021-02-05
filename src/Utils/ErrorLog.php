<?php

/*
 * Utils/ErrorLog.php: print error log messages
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Utils;

class ErrorLog {

    public static function print($object = null, $tag = '')
    {
        ob_start();
        print("\n###START $tag\n");
        print_r($object);
        print("\n###END $tag\n");
        $buffer = ob_get_contents();
        ob_end_clean();

        error_log($buffer);
    }

}
