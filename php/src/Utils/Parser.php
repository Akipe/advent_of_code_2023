<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Utils;

class Parser
{
    /**
     *
     * @param string $sentence
     * @return array<string>
     */
    public static function getArrayAllChar(string $sentence): array
    {
        return str_split($sentence);
    }
}
