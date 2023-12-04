<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day03Part2\GearRatios;

use Exception;
use Akipe\AdventOfCode2023\Utils\File;
use Akipe\AdventOfCode2023\Day03Part2\GearRatios\Gear;
use Akipe\AdventOfCode2023\Day03Part2\GearRatios\Number;

class ParseInput
{
    public const GEAR_SYMBOL = ['*'];

    /**
     * @var Number[]
     */
    private array $numbers;
    /**
     *
     * @var Gear[]
     */
    private array $allGearsFounds;

    public function __construct(
        public readonly File $file,
    ) {
        $this->numbers = [];
        $this->allGearsFounds = [];
    }

    public function getNumbersLinksToGears()
    {

    }

    /**
     * @return void
     */
    private function generateNumbersFromFile(): void
    {
        $this->resetNumbers();

        foreach ($this->file as $indexLine => $line) {
            $this->detectNumberLine($line, $indexLine);
        }

        // return $this->numbers;
    }

    /**
     * @return Number[]
     */
    public function getNumbersLine(int $line): array
    {
        $this->resetNumbers();

        $this->detectNumberLine($this->file->getContentLine($line), 0);

        return $this->numbers;
    }

    private function detectNumberLine(string $line, int $lineIndex): void
    {
        for ($letterIndexDetector = 0; $letterIndexDetector < strlen($line); $letterIndexDetector++) {
            if ($this->isLetterDigit($line[$letterIndexDetector])) {
                $this->numbers[] = $this->captureNumber($line, $lineIndex, $letterIndexDetector);
            }
        }
    }

    private function isLetterDigit(string $letter): bool
    {
        return is_numeric($letter);
    }

    private function captureNumber(string $line, int $lineIndexDetector, int &$letterIndexDetector): Number
    {
        $listDigit = [];

        do {
            $listDigit[] = new Digit(
                $line[$letterIndexDetector],
                new Coordinate(
                    $lineIndexDetector,
                    $letterIndexDetector,
                ),
            );

            $letterIndexDetector++;
        } while(
            isset($line[$letterIndexDetector]) &&
            $this->isLetterDigit($line[$letterIndexDetector])
        );

        $number = new Number($listDigit);

        $this->attachGearLinkedToNumber($number, self::GEAR_SYMBOL);

        return $number;
    }

    private function resetNumbers(): void
    {
        $this->numbers = [];
    }

    /**
     * @param Number $number
     * @param array<string> $patterns
     * @return void
     * @throws Exception
     */
    private function attachGearLinkedToNumber(Number &$number, array $patterns): void
    {
        $searchLineIndex = $number->getUpperLineIndex();
        $searchLastLineIndex = $number->getBottomLineIndex($this->file->getNumberLines());
        $searchLetterIndex = $number->getBeforeNumberLetterIndex();
        $searchLastLetterIndex = $number->getAfterNumberLetterIndex($this->file->getLengthLine(1));

        if ($searchLineIndex === false) {
            $searchLineIndex = $number->getLineIndex();
        }
        if ($searchLastLineIndex === false) {
            $searchLastLineIndex = $number->getLineIndex();
        }
        if ($searchLetterIndex === false) {
            $searchLetterIndex = $number->getFirstDigitLetterIndex();
        }
        if ($searchLastLetterIndex === false) {
            $searchLastLetterIndex = $number->getLastDigitLetterIndex();
        }

        $minimumSearchLetterIndex = $searchLetterIndex;

        while($searchLineIndex <= $searchLastLineIndex) {
            while($searchLetterIndex <= $searchLastLetterIndex) {
                $letter = $this->file->getContentLine($searchLineIndex)[$searchLetterIndex];
                if (in_array($letter, $patterns)) {
                    $isSame = false;
                    $gear = clone new Gear(
                        $letter,
                        new Coordinate(
                            $searchLineIndex,
                            $searchLetterIndex,
                        )
                    );
                    foreach ($this->allGearsFounds as $previousGear) {
                        if ($previousGear->isSame($gear)) {
                            $number->addLinkedElement($previousGear);
                            $isSame = true;
                        }
                    }

                    if (!$isSame) {
                        $number->addLinkedElement($gear);
                        $this->allGearsFounds[] = $gear;
                    }
                }

                $searchLetterIndex++;
            }

            $searchLetterIndex = $minimumSearchLetterIndex;
            $searchLineIndex++;
        }
    }

    /**
     * @return Gear[]
     */
    public function getAllGearsFound(): array
    {
        $this->generateNumbersFromFile();

        return $this->allGearsFounds;
    }
}
