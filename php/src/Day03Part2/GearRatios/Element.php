<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day03Part2\GearRatios;

interface Element
{
    public function getValue(): string;
    public function getCoordinate(): Coordinate;
    public function setNearNumber(Number $number): void;
    public function isSame(Element $element): bool;
    public function getId(): string;
    /**
     * @return Number[]
     */
    public function getNearNumbers(): array;
}
