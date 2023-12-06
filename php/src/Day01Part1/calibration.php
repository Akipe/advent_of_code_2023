<?php

namespace Akipe\AdventOfCode2023\Day01Part1;

use Akipe\AdventOfCode2023\Utils\File;
use Exception;

require_once '../../../vendor/autoload.php';

define("CALIBRATION_INPUT_EXAMPLE", "../../../statement/Day01Part1/input_example.txt");
define("CALIBRATION_INPUT_PATH", "../../../statement/Day01Part1/input.txt");

function getFirstDigit(string $line): int|false
{
    $digitLine = getOnlyDigit($line);

    if (strlen($digitLine) < 1) {
        return false;
    }

    return $digitLine[0];
}

function getLastDigit(string $line): int|false
{
    $digitLine = getOnlyDigit($line);

    if (strlen($digitLine) < 1) {
        return false;
    }

    $positionLastDigit = strlen($digitLine) - 1;

    return $digitLine[$positionLastDigit];
}

function getOnlyDigit(string $line): string
{
    return filter_var($line, FILTER_SANITIZE_NUMBER_INT);
}

function getCalibrationValue(File $calibrationInput): int
{
    $calibrationValue = 0;

    foreach($calibrationInput as $lineCalibration) {
        $digits = "";
        $digits .= getFirstDigit($lineCalibration);
        $digits .= getLastDigit($lineCalibration);
        $calibrationValue += (int) $digits;
    }

    return $calibrationValue;
}

function main()
{
    try {

        // $calibrationInput = new File(CALIBRATION_INPUT_EXAMPLE); # Result :142
        $calibrationInput = new File(CALIBRATION_INPUT_PATH); # Result : 55488
        echo getCalibrationValue($calibrationInput);

    } catch(Exception $exception) {
        echo "Error : ". $exception->getMessage();
    }
}

main();
