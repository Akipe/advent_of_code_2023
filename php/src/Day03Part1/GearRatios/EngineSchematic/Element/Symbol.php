<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Element;

use Iterator;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Element\Element;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Matrix\Coordinates;

class Symbol implements Element //implements Iterator
{
    public function __construct(
        private Coordinates $coordinateFirstDigit,
        private string $symbol,
    )
    {}

    public function getValue(): string
    {
        return $this->symbol;
    }

    public function getType(): ElementType
    {
        return ElementType::Symbol;
    }

    public function getCoordinatesLetter(): Coordinates
    {
        return $this->coordinateFirstDigit;
    }

    // public function current(): mixed { }

    // public function next(): void { }

    // public function key(): mixed { }

    // public function valid(): bool { }

    // public function rewind(): void { }
}
