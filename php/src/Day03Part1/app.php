<?php

declare(strict_types=1);

use Akipe\AdventOfCode2023\Utils\File;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Parser;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Generator;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Element\Number;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\PartNumberCalculator;

require_once '../../vendor/autoload.php';

define("ENGINE_SCHEMATIC_INPUT", "../../../statement/Day03Part1/input.txt");
$signes = ['*','=','/','%','#','-','+','@','$','&'];

$file = new File(ENGINE_SCHEMATIC_INPUT);
$lines = $file->getLines();
$numbersSum = 0;
$maxLines = count($lines);

for ($lineIndex = 0; $lineIndex < $maxLines; $lineIndex++) {
    $numberFound = "";
    $numberHasSymbolNear = false;

    for ($letterIndex = 0; $letterIndex < strlen($lines[$lineIndex]); $letterIndex++) {

        if (is_numeric($lines[$lineIndex][$letterIndex])) {
            $numberFound .= (string) $lines[$lineIndex][$letterIndex];

            if (!$numberHasSymbolNear) {
                for(
                    $lineIndexNear = $lineIndex - 1;
                    $lineIndexNear <= $lineIndex + 1;
                    $lineIndexNear++
                ) {
                    for (
                        $letterIndexNear = $letterIndex - 1;
                        $letterIndexNear <= $letterIndex + 1;
                        $letterIndexNear++
                    ){
                        if (
                            isset($lines[$lineIndexNear][$letterIndexNear])
                            && in_array($lines[$lineIndexNear][$letterIndexNear], $signes)
                        ) {
                            $numberHasSymbolNear = true;
                        }
                    }
                }
            }
        } else {
            if ($numberHasSymbolNear) {
                echo $numberFound . PHP_EOL;
                $numbersSum += (int) $numberFound;
                $numberHasSymbolNear = false;
            }
            $numberFound = "";
        }
        if (!isset($lines[$lineIndex][$letterIndex + 1])) {
            if ($numberHasSymbolNear) {
                echo $numberFound . PHP_EOL;
                $numbersSum += (int) $numberFound;
                $numberHasSymbolNear = false;
            }
        }
    }
}

echo $numbersSum; # Result : 543867
