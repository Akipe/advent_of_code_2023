<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Matrix;

class Coordinates
{
    public function __construct(
        private int $lineNumber,
        private int $letterNumber,
    )
    {}

    public function getLine(): int
    {
        return $this->lineNumber;
    }

    public function getLetter(): int
    {
        return $this->letterNumber;
    }

    public function isSame(Coordinates $coordinate): bool
    {
        return
            $this->lineNumber == $coordinate->lineNumber &&
            $this->letterNumber == $coordinate->letterNumber
        ;
    }

    /**
     *    -1-1 -1+0 -1+1
     *    +0-1 +0+0 +0+1
     *    +1-1 +1+0 +1+1
     *
     * @param Coordinates $coordinate
     * @return bool
     */
    public function isTouching(Coordinates $coordinate): bool
    {
        $curentLineMinus = $this->getLine() - 1;
        $curentLinePlus = $this->getLine() + 1;
        $curentLetterMinus = ($this->getLetter() - 1);
        $curentLetterPlus = ($this->getLetter() + 1);
        $otherLine = $coordinate->getLine();
        $otherLetter = $coordinate->getLetter();

        $boolLineMinus = $curentLineMinus <= $otherLine;
        $boolLinePlus = $curentLinePlus >= $otherLine;
        $boolLetterMinus =  $curentLetterMinus <= $otherLetter;
        $boolLetterPlus = $curentLetterPlus >= $otherLetter;

        return
            ($this->getLine() - 1) <= $coordinate->getLine() &&
            ($this->getLine() + 1) >= $coordinate->getLine() &&
            ($this->getLetter() - 1) <= $coordinate->getLetter() &&
            ($this->getLetter() + 1) >= $coordinate->getLetter()
        ;
    }
}
