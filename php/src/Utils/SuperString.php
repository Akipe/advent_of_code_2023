<?php

namespace Akipe\AdventOfCode2023\Utils;

use Exception;
use Iterator;

class SuperString
{
    public static function getLastChar(string $string): string
    {
        return mb_substr($string, -1);
    }
}
