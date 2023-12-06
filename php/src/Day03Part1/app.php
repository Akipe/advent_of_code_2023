<?php

declare(strict_types=1);

use Akipe\AdventOfCode2023\Utils\File;

require_once '../../../vendor/autoload.php';

define("ENGINE_SCHEMATIC_INPUT", "../../../statement/Day03Part1/input.txt");
define("ENGINE_SCHEMATIC_INPUT_EXAMPLE", "../../../statement/Day03Part1/input_example.txt");
define("ENGINE_SCHEMATIC_SYMBOLS",  ['*','=','/','%','#','-','+','@','$','&']);

function getSumNumbersWithSymbol(File $file): int
{
    $sumOfNumbersNearSymbol = 0;

    foreach($file as $lineIndex => $line) {
        $letterIndex = 0;

        while ($letterIndex < strlen($line)) {
            $numberInfo = getNumberWithInfo($line, $lineIndex, $letterIndex);

            if (!empty($numberInfo)) {
                $numberInfoNearSymbol =
                    filterNumbersTouchingSymbol(
                        $numberInfo,
                        $file,
                    )
                ;

                if (!empty($numberInfoNearSymbol)) {
                    $sumOfNumbersNearSymbol += getNumberFromNumberInfo($numberInfoNearSymbol);
                }
            }
        }
    }

    return $sumOfNumbersNearSymbol;
}

/**
 * @param string $line
 * @param int $lineIndex
 * @param int $letterIndex
 * @return array<<{"indexLine":int,"indexLetter":int,"value":string}>>
 */
function getNumberWithInfo(string $line, int $lineIndex, int &$letterIndex): array
{
    $numberWithInfo = [];

    do {
        if (is_numeric($line[$letterIndex])) {
            $numberWithInfo[] = [
                "indexLine" => $lineIndex,
                "indexLetter" => $letterIndex,
                "value" => $line[$letterIndex]
            ];
        }
    } while (isset($line[++$letterIndex]) && is_numeric($line[$letterIndex]));

    return $numberWithInfo;
}

/**
 *
 * @param array<<{"indexLine":int,"indexLetter":int,"value":string}>> $numberWithInfo
 * @param File $file
 * @return array<<{"indexLine":int,"indexLetter":int,"value":string}>>
 */
function filterNumbersTouchingSymbol(array $numberWithInfo, File $file): array
{
    $indexLineToCheck = getUpperOrBelowIndexSymbolLineBetweenNumberDependOfOverflow($numberWithInfo);

    while(isIndexSymboleLineIsAboveOrBelow($indexLineToCheck, $numberWithInfo)) {

        if (isSymboleLineIndexOverflow($indexLineToCheck, $file)) {
            return [];
        }

        $indexLetterCheck = getLeftmostExternalIndexSymbol($numberWithInfo);

        while(
            isSymbolIndexLetterBetweenNumberLimit($indexLetterCheck, $numberWithInfo) &&
            isSymbolIndexLetterDoesNotOverflowLine($file ,$indexLetterCheck)
        ) {
            $letterToCheck = $file->getLines()[$indexLineToCheck][$indexLetterCheck];

            if (checkIfLetterIsSymbol($letterToCheck)) {
                return $numberWithInfo;
            }

            $indexLetterCheck++;
        }

        $indexLineToCheck += 2;
    }

    if (checkIfLetterIsSymbol(
        getExternalLetterLeftToNumber($file, $numberWithInfo))
    ) {
        return $numberWithInfo;
    }

    if (checkIfLetterIsSymbol(
        getExternalLetterRightToNumber($file, $numberWithInfo)
    )) {
        return $numberWithInfo;
    }

    return [];
}

function isSymbolIndexLetterDoesNotOverflowLine(File $file, int $indexLetterCheck): bool
{
    return
        $indexLetterCheck < strlen($file->getLines()[0]) &&
        $indexLetterCheck >= 0
    ;
}

/**
 * @param int $indexToCheck
 * @param array<<{"indexLine":int,"indexLetter":int,"value":string}>> $numberWithInfo
 * @return bool
 */
function isSymbolIndexLetterBetweenNumberLimit(int $indexToCheck, array $numberWithInfo): bool
{
    return
        $indexToCheck <= end($numberWithInfo)["indexLetter"] + 1 &&
        $indexToCheck >= $numberWithInfo[0]["indexLetter"] - 1
    ;
}

/**
 * @param array<<{"indexLine":int,"indexLetter":int,"value":string}>> $numberInfo
 * @return int
 */
function getNumberFromNumberInfo(array $numberInfo): int
{
    $number = "";

    foreach ($numberInfo as $digit) {
        $number .= $digit["value"];
    }

    return (int) $number;
}

function checkIfLetterIsSymbol(array|string $string): bool
{
        return in_array(
            $string,
            ENGINE_SCHEMATIC_SYMBOLS
        );

    return false;
}

/**
 * @param File $file
 * @param array<<{"indexLine":int,"indexLetter":int,"value":string}>> $numberWithInfo
 * @return mixed
 */
function getExternalLetterLeftToNumber(File $file, array $numberWithInfo)
{
    if (isset($file->getLines()[$numberWithInfo[0]["indexLine"]][$numberWithInfo[0]["indexLetter"] - 1])) {
        return $file->getLines()[$numberWithInfo[0]["indexLine"]][$numberWithInfo[0]["indexLetter"] - 1];
    }

    return [];
}

/**
 * @param File $file
 * @param array<<{"indexLine":int,"indexLetter":int,"value":string}>> $numberWithInfo
 * @return mixed
 */
function getExternalLetterRightToNumber(File $file, array $numberWithInfo)
{
    if (isset($file->getLines()[$numberWithInfo[0]["indexLine"]][end($numberWithInfo)["indexLetter"] + 1])) {
        return $file->getLines()[$numberWithInfo[0]["indexLine"]][end($numberWithInfo)["indexLetter"] + 1];
    }

    return [];
}

/**
 * @param array<<{"indexLine":int,"indexLetter":int,"value":string}>> $numberWithInfo
 * @return mixed
 */
function getUpperOrBelowIndexSymbolLineBetweenNumberDependOfOverflow(array $numberWithInfo)
{
    $belowIndexLine = $numberWithInfo[0]["indexLine"] - 1;

    return $belowIndexLine >= 0 ? $belowIndexLine : $numberWithInfo[0]["indexLine"] + 1;
}

/**
 * @param int $indexLine
 * @param array<<{"indexLine":int,"indexLetter":int,"value":string}>> $numberWithInfo
 * @return bool
 */
function isIndexSymboleLineIsAboveOrBelow(int $indexLine, array $numberWithInfo): bool
{
    return $indexLine >= $numberWithInfo[0]["indexLine"] - 1 &&
        $indexLine <= $numberWithInfo[0]["indexLine"] + 1;
}

/**
 * @param array<<{"indexLine":int,"indexLetter":int,"value":string}>> $numberWithInfo
 * @return int
 */
function getLeftmostExternalIndexSymbol(array $numberWithInfo): int
{
    $mostLeftSymbolPossible = $numberWithInfo[0]["indexLetter"] - 1;

    return $mostLeftSymbolPossible >= 0 ? $mostLeftSymbolPossible : 0;
}

function isSymboleLineIndexOverflow(int $lineIndex, File $file): bool
{
    return $lineIndex >= $file->getNumberLines();
}

function main(): void
{
    $file = new File(ENGINE_SCHEMATIC_INPUT_EXAMPLE);

    $numbersSum = getSumNumbersWithSymbol($file);

    echo $numbersSum . PHP_EOL; # Result : 4361

    $file = new File(ENGINE_SCHEMATIC_INPUT);

    $numbersSum = getSumNumbersWithSymbol($file);

    echo $numbersSum; # Result : 543867
}

main();
