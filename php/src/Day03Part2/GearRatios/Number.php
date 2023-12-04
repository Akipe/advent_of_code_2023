<?php
declare(strict_types=1);
namespace Akipe\AdventOfCode2023\Day03Part2\GearRatios;

use Akipe\AdventOfCode2023\Day03Part2\GearRatios\Digit;


class Number
{
    public function __construct(
        /** @var Digit[] */
        readonly public array $digits,
    )
    {
    }

    public function getValue(): string
    {
        $value = "";

        foreach($this->digits as $digit) {
            $value .= $digit->getValue();
        }

        return (string) $value;
    }
}
