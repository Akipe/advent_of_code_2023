<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day02Part2\CubeConundrum\Formatter;

use Akipe\AdventOfCode2023\Day02Part2\CubeConundrum\EntireGame;
use Akipe\AdventOfCode2023\Utils\File;

class InputFormatter
{
    public function __construct(
        private File $input,
    ) {
    }

    public function getEntireGame(): EntireGame
    {
        $entireGame = new EntireGame();

        foreach($this->input as $line) {
            if (!empty($line)) {
                $lineFormatter = new InputLineFormatter($line);
                $entireGame->addGame($lineFormatter->getGame());
            }
        }

        return $entireGame;
    }
}
