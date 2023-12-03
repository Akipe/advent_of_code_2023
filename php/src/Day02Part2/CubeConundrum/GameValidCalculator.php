<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day02Part2\CubeConundrum;

class GameValidCalculator
{
    public function __construct(
        readonly private EntireGame $entireGame,
    ) {
    }

    public function getSumIdGamesValid(
        int $maxRedCude,
        int $maxGreenCube,
        int $maxBlueCude,
    ): int {
        $sumIdGamesValid = 0;

        foreach($this->entireGame->getGames() as $game) {
            if ($this->isGameIsValid(
                $maxRedCude,
                $maxGreenCube,
                $maxBlueCude,
                $game,
            )) {
                $sumIdGamesValid += $game->getId();
            }
        }

        return $sumIdGamesValid;
    }

    private function isGameIsValid(
        int $maxRedCude,
        int $maxGreenCube,
        int $maxBlueCude,
        Game $game,
    ): bool {
        return
            $maxRedCude >= $game->getMaxRedCube() &&
            $maxGreenCube >= $game->getMaxGreenCube() &&
            $maxBlueCude >= $game->getMaxBlueCube()
        ;
    }

    public function getSumMinimumCubeMultiply(): int
    {
        $result = 0;

        foreach($this->entireGame->getGames() as $game) {
            $result += $this->multiplyMinimumCubeEachColor($game);
        }

        return $result;
    }

    private function multiplyMinimumCubeEachColor(Game $game): int
    {
        return
            $game->getMaxRedCube() *
            $game->getMaxGreenCube() *
            $game->getMaxBlueCube()
        ;
    }
}
