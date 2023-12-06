<?php

declare(strict_types=1);

use Akipe\AdventOfCode2023\Day03Part2\GearRatios\ParseInput;
use Akipe\AdventOfCode2023\Utils\File;
use Akipe\AdventOfCode2023\Day03Part2\GearRatios\GearCalculator;

require_once '../../../vendor/autoload.php';

# Example

define("ENGINE_SCHEMATIC_INPUT_EXAMPLE", "../../../statement/Day03Part2/input_example.txt");

$inputFile = new File(ENGINE_SCHEMATIC_INPUT_EXAMPLE);

$parser = new ParseInput($inputFile);

$calculator = new GearCalculator($parser->getAllGearsFound());

echo $calculator->calculateAllGearsRatios() . PHP_EOL; # 467835

# Statement

define("ENGINE_SCHEMATIC_INPUT", "../../../statement/Day03Part2/input.txt");

$inputFile = new File(ENGINE_SCHEMATIC_INPUT);

$parser = new ParseInput($inputFile);

$calculator = new GearCalculator($parser->getAllGearsFound());

echo $calculator->calculateAllGearsRatios() . PHP_EOL; # 79613331
