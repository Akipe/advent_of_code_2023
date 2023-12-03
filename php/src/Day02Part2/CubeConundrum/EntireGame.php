<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day02Part1\CubeConundrum;

class EntireGame
{
    /** @var Game[] */
    private array $games;

    public function __construct()
    {
        $this->games = [];
    }

    public function addGame(Game $game)
    {
        $this->games[] = $game;
    }

    /**
     *
     * @return Game[]
     */
    public function getGames(): array
    {
        return $this->games;
    }
}
