<?php

namespace App\Utils;

class ID
{
    public static function fromString(string $value)
    {
        return trim(str_replace(' ', '-', strtolower($value)));
    }
}