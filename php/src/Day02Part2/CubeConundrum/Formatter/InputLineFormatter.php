<?php

declare(strict_types=1);

namespace Akipe\AdventOfCode2023\Day02Part2\CubeConundrum\Formatter;

use Akipe\AdventOfCode2023\Day02Part2\CubeConundrum\Cube\CubeColor;
use Akipe\AdventOfCode2023\Day02Part2\CubeConundrum\Game;
use Akipe\AdventOfCode2023\Day02Part2\CubeConundrum\Round;

class InputLineFormatter
{
    public const ID_SEPARATOR = ":";
    public const ROUND_SEPARATOR = ";";
    public const CUBE_SEPARATOR = ",";
    public const CUBE_INFO_SEPARATOR = " ";

    public int $maxRedCube;
    public int $maxGreenCube;
    public int $maxBlueCube;

    public function __construct(
        readonly private string $lineInput,
    ) {
        $this->initMaxCube();
    }

    public function getGame(): Game
    {
        $lineIdSeperate = explode(self::ID_SEPARATOR, trim($this->lineInput));

        $id = (int) trim($lineIdSeperate[0], " \n\r\t\v\x00Game");
        $allRounds = $this->getRoundsFromLineWithoutId($lineIdSeperate[1]);

        $game = new Game(
            $id,
            $allRounds,
            $this->maxRedCube,
            $this->maxGreenCube,
            $this->maxBlueCube
        );
        $this->initMaxCube();

        return $game;
    }

    /**
     *
     * @param string $line
     * @return Round[]
     */
    private function getRoundsFromLineWithoutId(string $line): array
    {
        $allRounds = [];

        $lineRoundsSeperate = explode(self::ROUND_SEPARATOR, trim($line));

        foreach($lineRoundsSeperate as $singleRound) {
            $round = $this->getCubesFromRoundLine(trim($singleRound));
            $this->setMaxCubeAllColor($round);
            $allRounds[] = $round;
        }

        return $allRounds;
    }

    private function getCubesFromRoundLine(string $line): Round
    {
        $round = new Round();

        $lineCubesSeperate = explode(self::CUBE_SEPARATOR, trim($line));

        foreach($lineCubesSeperate as $singleCube) {
            $result = $this->getCubeNumberAndColorInfo(trim($singleCube));
            $round->addCube($result["color"], (int) $result["howMany"]);
        }

        return $round;
    }

    /**
     *
     * @param string $line
     * @return array{"color":CubeColor,"howMany":int}
     */
    private function getCubeNumberAndColorInfo(string $line): array
    {
        $lineCubeInfoSeperate = explode(self::CUBE_INFO_SEPARATOR, trim($line));

        $howMany = $lineCubeInfoSeperate[0];
        $color = CubeColor::from($lineCubeInfoSeperate[1]);

        return [
            "color" => $color,
            "howMany" => $howMany,
        ];
    }

    private function setMaxCubeAllColor(Round $round): void
    {
        $this->changeMaxCubeCategoryIfNeeded(
            $this->maxRedCube,
            $round->getNumberRedCube(),
        );
        $this->changeMaxCubeCategoryIfNeeded(
            $this->maxGreenCube,
            $round->getNumberGreenCube(),
        );
        $this->changeMaxCubeCategoryIfNeeded(
            $this->maxBlueCube,
            $round->getNumberBlueCube(),
        );
    }

    private function changeMaxCubeCategoryIfNeeded(
        &$currentMaxCubCategory,
        $cubeCategory,
    ) {
        if ($currentMaxCubCategory < $cubeCategory && $cubeCategory != 0) {
            $currentMaxCubCategory = $cubeCategory;
        }
    }

    private function initMaxCube()
    {
        $this->maxRedCube = 0;
        $this->maxGreenCube = 0;
        $this->maxBlueCube = 0;
    }
}
