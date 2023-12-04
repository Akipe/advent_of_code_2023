<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day03Part2\GearRatios;

use Akipe\AdventOfCode2023\Day03Part2\GearRatios\Digit;
use Akipe\AdventOfCode2023\Day03Part2\GearRatios\Element;

class Number
{
    /**
     * @var Element[]
     */
    private array $elementsLinked;

    /**
     * @param Digit[] $digits
     * @return void
     */
    public function __construct(
        readonly public array $digits,
    ) {
        $this->elementsLinked = [];
    }

    public function getValue(): string
    {
        $value = "";

        foreach($this->digits as $digit) {
            $value .= $digit->getValue();
        }

        return (string) $value;
    }

    public function addLinkedElement(Element $newElement): void
    {
        if ($this->hasElementsLinked()) {
            foreach ($this->elementsLinked as $element) {
                if ($element->getId() == $newElement->getId()) {
                    return;
                }
            }
        }

        $this->elementsLinked[] = $newElement;

        $newElement->setNearNumber($this);
    }

    public function getLineIndex(): int
    {
        return $this->digits[0]->getCoordinate()->getLine();
    }

    public function getFirstDigitLetterIndex(): int
    {
        return $this->digits[0]->getCoordinate()->getLetter();
    }

    public function getLastDigitLetterIndex(): int
    {
        return $this->digits[count($this->digits) - 1]->getCoordinate()->getLetter();
    }

    public function getUpperLineIndex(): int|false
    {
        if ($this->digits[0]->getCoordinate()->getLine() <= 0) {
            return false;
        }

        return $this->digits[0]->getCoordinate()->getLine() - 1;
    }

    public function getBottomLineIndex(int $maxLineIndex): int|false
    {
        if ($this->digits[0]->getCoordinate()->getLine() + 1 == $maxLineIndex) {
            return false;
        }

        return $this->digits[0]->getCoordinate()->getLine() + 1;
    }

    public function getBeforeNumberLetterIndex(): int|false
    {
        if ($this->digits[0]->getCoordinate()->getLetter() <= 0) {
            return false;
        }

        return $this->digits[0]->getCoordinate()->getLetter() - 1;
    }

    public function getAfterNumberLetterIndex(int $maxLetterIndex): int|false
    {
        if ($this->digits[count($this->digits)-1]->getCoordinate()->getLetter() + 1 >= $maxLetterIndex) {
            return false;
        }

        return $this->digits[count($this->digits)-1]->getCoordinate()->getLetter() + 1;
    }

    // public function shareSameGearWith(Number $number): bool
    // {
    //     if ($this->hasElementsLinked() && $number->hasElementsLinked()) {
    //         foreach ($this->elementsLinked as $elementThisNumber) {
    //             foreach ($number->elementsLinked as $elementOtherNumber)
    //             if ($elementThisNumber
    //                 ->getCoordinate()
    //                 ->isCoordinateSameAs($elementOtherNumber->getCoordinate())
    //             ) {
    //                 return true;
    //             }
    //         }
    //     }

    //     return false;
    // }

    public function hasElementsLinked(): bool
    {
        return count($this->elementsLinked) > 0;
    }

    /**
     * @return Element[]
     */
    public function getElementsLinked(): array
    {
        return $this->elementsLinked;
    }

    public function getId(): string
    {
        return $this->digits[0]->getCoordinate()->getLetter() .
            $this->digits[0]->getCoordinate()->getLine();
    }
}
