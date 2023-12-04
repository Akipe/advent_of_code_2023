<?php

declare(strict_types=1);

use Akipe\AdventOfCode2023\Utils\File;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Parser;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Generator;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Element\Number;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\PartNumberCalculator;

require_once '../../vendor/autoload.php';

# Example input

define("ENGINE_SCHEMATIC_EXAMPLE_INPUT", "../../../statement/Day03Part1/input_example.txt");

$generator = new Generator(
    new File(ENGINE_SCHEMATIC_EXAMPLE_INPUT)
);

$parser = new Parser($generator->getMatrix());

$partNumberCalculator = new PartNumberCalculator($parser->getElements());

echo PHP_EOL . PHP_EOL . $partNumberCalculator->getValue() . PHP_EOL; # 4361

# Statement input

define("ENGINE_SCHEMATIC_INPUT", "../../../statement/Day03Part1/input.txt");

$generator = new Generator(
    new File(ENGINE_SCHEMATIC_INPUT)
);

$parser = new Parser($generator->getMatrix());

$partNumberCalculator = new PartNumberCalculator($parser->getElements());

echo PHP_EOL . PHP_EOL . $partNumberCalculator->getValue() . PHP_EOL; # 540324 ?

function getAllSpecialChar(File $file): array
{
    $specialsCharsFound = [];

    foreach($file as $line) {
        $lineWithoutPoint = str_replace(".", "", $line);
        $lineWithoutNumbers = preg_replace('/[0-9]+/', '', $lineWithoutPoint);
        $specialsCharsFound = array_merge($specialsCharsFound, str_split($lineWithoutNumbers));
    }

    return array_unique($specialsCharsFound);
}

$debugSpecialChar = getAllSpecialChar(new File(ENGINE_SCHEMATIC_INPUT));
