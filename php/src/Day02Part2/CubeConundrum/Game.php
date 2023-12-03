<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day02Part1\CubeConundrum;

class Game
{
    public function __construct(
        private int $id,
        private array $rounds,
        private int $maxRedCube = 0,
        private int $maxGreenCube = 0,
        private int $maxBlueCube = 0,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMaxRedCube()
    {
        return $this->maxRedCube;
    }

    public function getMaxGreenCube()
    {
        return $this->maxGreenCube;
    }

    public function getMaxBlueCube()
    {
        return $this->maxBlueCube;
    }
}
