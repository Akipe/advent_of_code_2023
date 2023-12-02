<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023Test\Day02Part1\CubeConundrum\Cube;

use PHPUnit\Framework\TestCase;
use Akipe\AdventOfCode2023\Day02Part1\CubeConundrum\Cube\Cube;
use Akipe\AdventOfCode2023\Day02Part1\CubeConundrum\Cube\CubeColor;

final class CubeTest extends TestCase
{
    public function test_can_create_red_cube(): void
    {
        $cubeColor = new Cube(CubeColor::Red);

        $this->assertTrue($cubeColor->getColor() == CubeColor::Red);
    }
    public function test_can_create_green_cube(): void
    {
        $cubeColor = new Cube(CubeColor::Green);

        $this->assertTrue($cubeColor->getColor() == CubeColor::Green);
    }
    public function test_can_create_blue_cube(): void
    {
        $cubeColor = new Cube(CubeColor::Blue);

        $this->assertTrue($cubeColor->getColor() == CubeColor::Blue);
    }
}
