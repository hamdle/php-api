<?php

require_once __DIR__.'/Utils/Env.php';

use Utils\Env;

class Autoload {
    public static function register()
    {
        $env = new Env();
        $env->load();

        spl_autoload_register('Autoload::loadFile');
    }

    public static function loadFile($class)
    {
        $file = __DIR__.DIRECTORY_SEPARATOR.
            str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';

        if (file_exists($file))
        {
            require_once $file;
            return true;
        }

        return false;
    }
}

Autoload::register();
