<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Matrix;

use Iterator;

class Matrix implements Iterator
{
    private int $currentIndexNavigation;

    /**
     * @param array<array<string>> $matrix
     * @return void
     */
    public function __construct(
        private array $matrix,
    )
    {
        $this->initCurrentIndexNavigation();
    }

    /**
     * @return array<string>
     */
    public function current(): array
    {
        return $this->matrix[$this->currentIndexNavigation];
    }

    public function next(): void
    {
        $this->currentIndexNavigation++;
    }

    public function key(): int
    {
        return $this->currentIndexNavigation;
    }

    public function valid(): bool
    {
        return $this->hasNumberLine($this->currentIndexNavigation);
    }

    public function rewind(): void
    {
        $this->initCurrentIndexNavigation();
    }

    public function getMinNumberLines(): int
    {
        return 0;
    }

    public function getMaxNumberLines(): int
    {
        return count($this->matrix);
    }

    public function getMinNumberElementsInLine(): int
    {
        return 0;
    }

    public function getMaxNumberElementsInLine(): int
    {
        return count($this->matrix[0]);
    }

    private function initCurrentIndexNavigation(): void
    {
        $this->currentIndexNavigation = 0;
    }

    public function hasNumberLine(int $numberLine): bool
    {
        return $numberLine < $this->getMaxNumberLines();
    }
}
