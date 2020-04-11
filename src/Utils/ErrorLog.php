<?php
namespace Utils;

class ErrorLog {

    public static function print($object = null, $tag = '')
    {
        /*
        if ($object == null)
        {
            $object = "null";   // be explicit for print_r
        }
         */

        $content = '';

        ob_start();
        print("\n###START $tag\n");
        print_r($object);
        print("\n###END $tag\n");
        $contents = ob_get_contents();
        ob_end_clean();

        error_log($contents);
    }

}
