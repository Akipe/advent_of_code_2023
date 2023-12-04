<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Element;

use Iterator;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Element\Element;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Matrix\Coordinates;

class Number implements Element //implements Iterator
{
    public function __construct(
        private Coordinates $coordinateFirstDigit,
        private string $digit,
        private string $number,
    )
    {}

    public function getCoordinatesLetter(): Coordinates
    {
        return $this->coordinateFirstDigit;
    }

    /**
     * @return Number[]
     */
    public function getAllDigitsAsNumber(): array
    {
        $numberDigits = strlen((string) $this->number);
        /** @var Number[] */
        $digitsAsNumbers = [];
        $digitsAsNumbers[] = $this;

        for ($digitIndex = 1; $digitIndex < $numberDigits; $digitIndex++) {
            $a = $this->number[$digitIndex];
            $digitsAsNumbers[] = new Number(
                new Coordinates(
                    $this->coordinateFirstDigit->getLine(),
                    $this->coordinateFirstDigit->getLetter() + $digitIndex
                ),
                $this->number[$digitIndex],
                $this->number
            );
        }

        return $digitsAsNumbers;
    }

    public function getType(): ElementType
    {
        return ElementType::Number;
    }

    public function getValue(): string
    {
        return $this->digit;
    }

    public function getEntireNumber(): string
    {
        return $this->number;
    }

    // public function current(): mixed { }

    // public function next(): void { }

    // public function key(): mixed { }

    // public function valid(): bool { }

    // public function rewind(): void { }
}
