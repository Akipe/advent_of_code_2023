<?php
declare(strict_types=1);
namespace Akipe\AdventOfCode2023\Day03Part2\GearRatios;

class Coordinate
{
    public function __construct(
        readonly public int $line,
        readonly public int $letter,
    )
    {
    }
}
