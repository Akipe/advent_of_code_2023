<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day03Part2\GearRatios;

use InvalidArgumentException;

class Coordinate
{
    public readonly int $line;
    public readonly int $letter;

    public function __construct(
        int $line,
        int $letter,
    ) {
        if ($line < 0 || $letter < 0) {
            throw new InvalidArgumentException("Axes can't be negatives");
        }
        $this->line = $line;
        $this->letter = $letter;
    }

    public function getLine(): int
    {
        return $this->line;
    }

    public function getLetter(): int
    {
        return $this->letter;
    }

    public function isSameAs(Coordinate $coordinate): bool
    {
        return $this->getLetter() == $coordinate->getLetter() &&
            $this->getLine() == $this->getLine();
    }
}
