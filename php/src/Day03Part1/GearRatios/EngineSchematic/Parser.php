<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic;

use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Matrix\Matrix;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Element\Number;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Element\Symbol;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Element\Element;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Matrix\Coordinates;

class Parser
{
    const REGEX_IS_SYMBOLE = '/[*|#|+|$|@|%|&|\-|=|\/|]/';
    // const REGEX_IS_SYMBOLE = '/[^A-Za-z0-9.]/i';

    public function __construct(
        private Matrix $engineSchematicMatrix,
    )
    {
    }

    /**
     * @return Element[]
     */
    public function getElements(): array
    {
        return $this->getElementsFromMatrix($this->engineSchematicMatrix);
    }

    /**
     * @param int $indexLine
     * @param int $startAtPositionLetter
     * @param array<string> $letters
     * @return Element[]
     */
    private function findElementsInLine(int $indexLine, array $letters, int $startAtPositionLetter = 0): array
    {
        $foundNumber = false;
        $positionCharNumber = 0;
        $number = '';
        $elementsFound = [];

        for ($positionLetter = $startAtPositionLetter; $positionLetter < count($letters); $positionLetter++) {

            if (!$foundNumber && is_numeric($letters[$positionLetter])) {
                $foundNumber = true;
                $positionCharNumber = $positionLetter;
                $number .= $letters[$positionLetter];
            } else if (is_numeric($letters[$positionLetter])) {
                $number .= $letters[$positionLetter];
            }
            if ($foundNumber && !is_numeric($letters[$positionLetter])) {
                $elementsFound[] = new Number(
                    new Coordinates($indexLine, $positionCharNumber),
                    $number[0],
                    $number
                );

                return array_merge($elementsFound, $this->findElementsInLine(
                    $indexLine,
                    $letters,
                    $positionLetter,
                ));
            }
            if ($this->isSymbole($letters[$positionLetter])) {
                $elementsFound[] = new Symbol(
                    new Coordinates($indexLine, $positionLetter),
                    $letters[$positionLetter]
                );
                return array_merge($elementsFound, $this->findElementsInLine(
                    $indexLine,
                    $letters,
                    $positionLetter + 1,
                ));
            }
        }

        return [];
    }

    /**
     * @param Matrix $matrix
     * @return Element[]
     */
    private function getElementsFromMatrix(Matrix $matrix): array
    {
        /** @var Number[] */
        $numbersFound = [];

        foreach($matrix as $numberLine => $lettersLine) {
            $numbersFound = array_merge(
                $numbersFound,
                $this->findElementsInLine($numberLine, $lettersLine)
            );
        }

        return $numbersFound;
    }

    // private function hasSymboleAt(EngineSchematicCoordinates $coordinates): bool
    // {

    // }

    private function isSymbole(string $letter): bool
    {
        return !empty(preg_match(self::REGEX_IS_SYMBOLE, $letter));
    }
}
