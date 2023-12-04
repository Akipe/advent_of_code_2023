<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day03Part2\GearRatios;

class Gear implements Element
{
    /**
     * @var Numbers[]
     */
    private array $nearNumbers;
    private string $id;
    private static int $custom = 0;
    private int $custom2;

    public function __construct(
        readonly public string $value,
        readonly public Coordinate $coordinate,
    ) {
        $this->nearNumbers = [];
        $this->id = $this->getCoordinate()->getLetter() .
        $this->getCoordinate()->getLine();
        $this->custom2 = self::$custom;
        self::$custom++;
    }

    public function isSame(Element $element): bool
    {
        return $element->getId() == $this->getId();
    }

    public function setNearNumber(Number $number): void
    {
        foreach ($this->nearNumbers as $nearNumber) {
            if ($nearNumber->getId() == $number->getId()) {
                return;
            }
        }

        $this->nearNumbers[] = $number;
    }

    public function getNearNumbers(): array
    {
        return $this->nearNumbers;
    }

    public function getCoordinate(): Coordinate
    {
        return $this->coordinate;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getId(): string
    {
        return $this->getCoordinate()->getLetter() .
            $this->getCoordinate()->getLine();
    }
}
