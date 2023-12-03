<?php

declare(strict_types=1);

use Akipe\AdventOfCode2023\Day02Part2\CubeConundrum\Formatter\InputFormatter;
use Akipe\AdventOfCode2023\Day02Part2\CubeConundrum\GameValidCalculator;
use Akipe\AdventOfCode2023\Utils\File;

require_once '../../vendor/autoload.php';

# Example data

define("CALIBRATION_INPUT_EXAMPLE_PATH", "../../../statement/Day02Part2/input_example.txt");

$input = new File(CALIBRATION_INPUT_EXAMPLE_PATH);
$inputFormatter = new InputFormatter($input);

$entireGame = $inputFormatter->getEntireGame();
$gameValidCalculator = new GameValidCalculator($entireGame);
echo $gameValidCalculator->getSumMinimumCubeMultiply() . PHP_EOL; # Result : 2286

# Statement data

define("CALIBRATION_INPUT_PATH", "../../../statement/Day02Part2/input.txt");

$input = new File(CALIBRATION_INPUT_PATH);
$inputFormatter = new InputFormatter($input);

$entireGame = $inputFormatter->getEntireGame();
$gameValidCalculator = new GameValidCalculator($entireGame);
echo $gameValidCalculator->getSumMinimumCubeMultiply() . PHP_EOL; # Result : 67335
