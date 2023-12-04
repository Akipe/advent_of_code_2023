<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Element;

enum ElementType : string
{
    case Number = "number";
    case Symbol = "symbol";
}
