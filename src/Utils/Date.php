<?php
namespace Utils;

class Date
{
    public static function timestampToDatetime($timestamp)
    {
        return date('Y-m-d H:i:s', $timestamp);
    }
}
