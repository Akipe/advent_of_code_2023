<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic;

use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Element\Number;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Element\Symbol;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Element\Element;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Element\ElementType;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Matrix\Coordinates;

class PartNumberCalculator
{
    /**
     * @var Number[]
     */
    private array $numbers;
    /**
     * @var Symbol[]
     */
    private array $symbols;

    public function __construct(
        /** @var Element[] */
        array $elements,
    )
    {
        $this->numbers = [];
        $this->symbols = [];

        foreach($elements as $element) {
            if ($element->getType() == ElementType::Number) {
                $this->numbers[] = $element;
            }
            if ($element->getType() == ElementType::Symbol) {
                $this->symbols[] = $element;
            }
        }
    }

    public function getValue(): int
    {
        $value = 0;
        /** @var Number[] */
        $touched = [];
        /** @var Number[] */
        $notTouched = [];

        foreach ($this->numbers as $number) {
            if ($this->isNumberTouchSymbol($number, $this->symbols)) {
                $touched[] = $number;
                $value += (int) $number->getEntireNumber();
            } else {
                $notTouched[] = $number;
            }
        }

        foreach ($touched as $touch) { echo "TOUCH|N=". $touch->getEntireNumber() . ";L=" . $touch->getCoordinatesLetter()->getLine() .";C=" . $touch->getCoordinatesLetter()->getLetter() . PHP_EOL; }
        echo PHP_EOL . PHP_EOL . PHP_EOL;
        foreach ($notTouched as $nottouch) { echo "NOPE|N=". $nottouch->getEntireNumber() . ";L=" . $nottouch->getCoordinatesLetter()->getLine() .";C=" . $nottouch->getCoordinatesLetter()->getLetter() . PHP_EOL; }

        return $value;
    }

    /**
     * @param Number $number
     * @param Symbol[] $symbols
     * @return bool
     */
    private function isNumberTouchSymbol(Number $number, array $symbols): bool
    {
        foreach ($this->symbols as $symbol) {
            foreach($number->getAllDigitsAsNumber() as $digit) {
                if ($digit->getCoordinatesLetter()->isTouching($symbol->getCoordinatesLetter())) {
                    return true;
                }
            }
        }

        return false;
    }
}
