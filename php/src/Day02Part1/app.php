<?php

declare(strict_types=1);

use Akipe\AdventOfCode2023\Day02Part1\CubeConundrum\Formatter\InputFormatter;
use Akipe\AdventOfCode2023\Day02Part1\CubeConundrum\GameValidCalculator;
use Akipe\AdventOfCode2023\Utils\File;

require_once '../../vendor/autoload.php';

# Example data

// define("CALIBRATION_INPUT_EXAMPLE_PATH", "../../../statement/Day02Part1/input_example.txt");
// define("MAX_RED_CUBE_EXAMPLE", 12);
// define("MAX_GREEN_CUBE_EXAMPLE", 13);
// define("MAX_BLUE_CUBE_EXAMPLE", 14);

// $input = new File(CALIBRATION_INPUT_EXAMPLE_PATH);
// $inputFormatter = new InputFormatter($input);

// $entireGame = $inputFormatter->getEntireGame();
// $gameValidCalculator = new GameValidCalculator($entireGame);

// echo $gameValidCalculator->getSumIdGamesValid(
//     MAX_RED_CUBE_EXAMPLE,
//     MAX_GREEN_CUBE_EXAMPLE,
//     MAX_BLUE_CUBE_EXAMPLE
// ) . PHP_EOL; # 8

# Statement data

define("CALIBRATION_INPUT_PATH", "../../../statement/Day02Part1/input.txt");
define("MAX_RED_CUBE", 12);
define("MAX_GREEN_CUBE", 13);
define("MAX_BLUE_CUBE", 14);

$input = new File(CALIBRATION_INPUT_PATH);
$inputFormatter = new InputFormatter($input);

$entireGame = $inputFormatter->getEntireGame();
$entireGame;
$gameValidCalculator = new GameValidCalculator($entireGame);

echo $gameValidCalculator->getSumIdGamesValid(
    MAX_RED_CUBE,
    MAX_GREEN_CUBE,
    MAX_BLUE_CUBE
);

