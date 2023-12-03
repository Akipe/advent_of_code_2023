<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day02Part2\CubeConundrum;

use Akipe\AdventOfCode2023\Day02Part2\CubeConundrum\Cube\CubeColor;

class Round
{
    private int $numberRedCubes;
    private int $numberGreenCubes;
    private int $numberBlueCubes;

    public function __construct()
    {
        $this->numberRedCubes = 0;
        $this->numberGreenCubes = 0;
        $this->numberBlueCubes = 0;
    }

    public function addCube(CubeColor $color, int $number)
    {
        if ($color == CubeColor::Red) {
            $this->numberRedCubes = $number;
        }
        if ($color == CubeColor::Green) {
            $this->numberGreenCubes = $number;
        }
        if ($color == CubeColor::Blue) {
            $this->numberBlueCubes = $number;
        }
    }

    public function getNumberRedCube(): int
    {
        return $this->numberRedCubes;
    }

    public function getNumberGreenCube(): int
    {
        return $this->numberGreenCubes;
    }

    public function getNumberBlueCube(): int
    {
        return $this->numberBlueCubes;
    }
}
