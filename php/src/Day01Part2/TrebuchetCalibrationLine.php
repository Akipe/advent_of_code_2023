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
        foreach (DigitName::cases() as $case) {
            $index = $this->getPositionFirstOccurrence(strtolower($case->name));
            if ($index !== false) {
                $this->digitsFounds[$index] = $case->value;
            }
            $index = $this->getPositionLastOccurrence(strtolower($case->name));
            if ($index !== false) {
                $this->digitsFounds[$index] = $case->value;
            }
        }
    }

    private function findAllNumberDigit(): void
    {
        for ($digit = 0; $digit <= 9; $digit++) {
            $index = $this->getPositionFirstOccurrence((string) $digit);
            if ($index !== false) {
                $this->digitsFounds[$index] = $digit;
            }
            $index = $this->getPositionLastOccurrence($digit);
            if ($index !== false) {
                $this->digitsFounds[$index] = $digit;
            }
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
