<?php
declare(strict_types=1);
namespace Akipe\AdventOfCode2023\Day03Part2\GearRatios;

use Akipe\AdventOfCode2023\Utils\File;

class ParseInput
{
    public const GEAR_SYMBOL = ['*'];

    private array $numbers;

    public function __construct(
        public readonly File $file,
    ){
        $this->numbers = [];
    }

    public function getNumbersLinksToGears()
    {

    }

    public function getNumbersFile(): array
    {
        $this->resetNumbers();

        foreach ($this->file as $indexLine => $line) {
            $this->detectNumberLine($line, $indexLine);
        }

        return $this->numbers;
    }

    public function getNumbersLine(int $line): array
    {
        $this->resetNumbers();

        $this->detectNumberLine($this->file->getContentLine($line), 0);

        return $this->numbers;
    }

    private function detectNumberLine($line, $lineIndex)
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

    private function captureNumber($line, $lineIndexDetector, &$letterIndexDetector): Number
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

        return new Number($listDigit);
    }

    private function resetNumbers()
    {
        $this->numbers = [];
    }
}
