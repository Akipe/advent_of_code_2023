<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day03Part2\GearRatios;

class GearCalculator
{
    public const HOW_MANY_NUMBERS_PER_GEAR = 2;

    private int $result = 0;

    /**
     * @param Gear[] $gears
     * @return void
     */
    public function __construct(
        readonly public array $gears,
    ) {
    }

    public function calculateAllGearsRatios(): int
    {
        foreach($this->gears as $gear) {
            if (count($gear->getNearNumbers()) == self::HOW_MANY_NUMBERS_PER_GEAR) {
                $this->result += ($gear->getNearNumbers()[0]->getValue() * $gear->getNearNumbers()[1]->getValue());
            }
        }

        return $this->result;
    }
}
