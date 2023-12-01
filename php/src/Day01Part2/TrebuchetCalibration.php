<?php

namespace Akipe\AdventOfCode2023\Day01Part2;

use Akipe\AdventOfCode2023\Utils\File;

class TrebuchetCalibration
{
    public function __construct(
        private File $input,
    ) {
    }

    public function getValue(): int
    {
        $value = 0;

        foreach($this->input as $line) {
            $calibrationLine = new TrebuchetCalibrationLine($line);
            $value += (int) $calibrationLine->getValues();
        }

        return $value;
    }
}
