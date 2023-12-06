<?php

namespace Akipe\AdventOfCode2023\Day01Part2;

use Akipe\AdventOfCode2023\Utils\File;

require_once '../../../vendor/autoload.php';

define("CALIBRATION_INPUT_EXAMPLE_PATH", "../../../statement/Day01Part2/input_example.txt"); # 281
define("CALIBRATION_INPUT_PATH", "../../../statement/Day01Part2/input.txt"); # 55614

// $calibration = new TrebuchetCalibration(new File(CALIBRATION_INPUT_EXAMPLE_PATH));
$calibration = new TrebuchetCalibration(new File(CALIBRATION_INPUT_PATH));

echo $calibration->getValue();
