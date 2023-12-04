<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Element;

use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Matrix\Coordinates;

interface Element
{
    public function getCoordinatesLetter(): Coordinates;
    public function getValue(): string;
    public function getType(): ElementType;
}
