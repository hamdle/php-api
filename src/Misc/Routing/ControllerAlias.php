<?php

namespace Misc\Routing;

class ControllerAlias {
    public static $alias;

    public static function registerAlias() {
        return static::$alias;
    }
}
