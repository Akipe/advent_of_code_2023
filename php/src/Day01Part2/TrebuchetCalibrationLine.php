<?php

namespace Akipe\AdventOfCode2023\Day01Part2;

class TrebuchetCalibrationLine
{
    /** @var array<int,int> */
    private array $digitsFounds;
    private string $content;

    public function __construct(
        string $content,
    ) {
        $this->content = strtolower($content);
        $this->digitsFounds = [];
    }

    private function findAllNameDigit(): void
    {
        foreach (DigitName::cases() as $digitName) {
            $this->saveDigitPatternIfFound(
                $digitName->value,
                $this->getPositionFirstOccurrence((string) strtolower($digitName->name))
            );
            $this->saveDigitPatternIfFound(
                $digitName->value,
                $this->getPositionLastOccurrence((string) strtolower($digitName->name))
            );
        }
    }

    private function findAllNumberDigit(): void
    {
        for ($digit = 0; $digit <= 9; $digit++) {
            $this->saveDigitPatternIfFound(
                $digit,
                $this->getPositionFirstOccurrence((string) $digit)
            );
            $this->saveDigitPatternIfFound(
                $digit,
                $this->getPositionLastOccurrence((string) $digit)
            );
        }
    }

    private function saveDigitPatternIfFound(string $digitPattern, int|false $position): void
    {
        if ($position !== false) {
            $this->digitsFounds[$position] = $digitPattern;
        }
    }

    private function getPositionFirstOccurrence(string $digit): int|false
    {
        return strpos($this->content, $digit);
    }

    private function getPositionLastOccurrence(string $digit): int|false
    {
        return strripos($this->content, $digit);
    }

    public function getValues(): string
    {
        $this->findAllNameDigit();
        $this->findAllNumberDigit();

        ksort($this->digitsFounds);

        return (string)
            reset($this->digitsFounds)
            ."".
            end($this->digitsFounds)
        ;
    }
}
