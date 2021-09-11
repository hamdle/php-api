<?php

/*
 * Core/Utils/Random.php: generate random numbers
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Core\Utils;

class Random {
    // return = integer
    public static function number()
    {
        return rand();
    }
}
