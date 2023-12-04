<?php

declare(strict_types=1);
namespace Akipe\AdventOfCode2023\Day03Part2\GearRatios;

class Digit
{
    public function __construct(
        readonly public string $value,
        readonly public Coordinate $coordinate,
    )
    {
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
