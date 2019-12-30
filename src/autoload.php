<?php

class Autoload {
    public static function register() {
        spl_autoload_register('Autoload::loadFile');
    }

    public static function loadFile() {
        // TODO
    }
}

Autoload::register();
