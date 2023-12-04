<?php

declare(strict_types=1);

use Akipe\AdventOfCode2023\Day03Part2\GearRatios\ParseInput;
use Akipe\AdventOfCode2023\Utils\File;

require_once '../../vendor/autoload.php';

// define("ENGINE_SCHEMATIC_INPUT", "../../../statement/Day03Part1/input.txt");
define("ENGINE_SCHEMATIC_INPUT_EXAMPLE", "../../../statement/Day03Part2/input_example.txt");
define("ENGINE_SCHEMATIC_INPUT", "../../../statement/Day03Part2/input.txt");

// $inputFile = new File(ENGINE_SCHEMATIC_INPUT_EXAMPLE);
$inputFile = new File(ENGINE_SCHEMATIC_INPUT);

$parser = new ParseInput($inputFile);

$numbers = $parser->getNumbersFile();

foreach ($numbers as $number) {
    echo $number->getValue() . PHP_EOL;
}
