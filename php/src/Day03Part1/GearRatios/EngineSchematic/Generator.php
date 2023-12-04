<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic;

use Akipe\AdventOfCode2023\Utils\File;
use Akipe\AdventOfCode2023\Utils\Parser;
use Akipe\AdventOfCode2023\Day03Part1\GearRatios\EngineSchematic\Matrix\Matrix;

class Generator
{
    public function __construct(
        private File $file
    ) {

    }

    public function getMatrix(): Matrix
    {
        return new Matrix(
            $this->getCompleteMatrix($this->file),
        );
    }

    /**
     * @param File $file
     * @return array<array<string>>
     * @throws Exception
     */
    private function getCompleteMatrix(File $file): array
    {
        /** @var array<array<string>> */
        $engineSchematicMatrix = [];

        for ($lineNumber = 0; $lineNumber < $file->getNumberLines(); $lineNumber++) {
            if (!empty($file->getContentLine($lineNumber))) {
                $engineSchematicMatrix[$lineNumber] =
                $this->getLineMatrix(
                    $file->getContentLine($lineNumber)
                );
            }
        }

        return $engineSchematicMatrix;
    }

    /**
     * @param string $line
     * @return array<string>
     */
    private function getLineMatrix(string $line): array
    {
        return Parser::getArrayAllChar($line);
    }
}
