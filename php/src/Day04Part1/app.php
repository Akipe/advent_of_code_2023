<?php

declare(strict_types=1);

use Akipe\AdventOfCode2023\Utils\File;

require_once '../../../vendor/autoload.php';

/**
 * @param string $line
 * @return array<{"winning":int[],"yourHand":int[]}>
 */
function getCardGameRoundParsed(string $line): array
{
    $separateCardId = explode(":", $line);
    $separateTypeCards = array_filter(explode("|", trim($separateCardId[1])));
    $cardParsed["winning"] = array_filter(explode(" ", trim($separateTypeCards[0])));
    $cardParsed["yourHand"] = array_filter(explode(" ", trim($separateTypeCards[1])));

    return $cardParsed;
}

function exerciseExample(): void
{
    $file = new File("../../../statement/Day04Part1/input_example.txt");
    $totalPoints = 0;

    foreach($file as $line) {
        $roundPoint = 0;
        $round = getCardGameRoundParsed($line);

        foreach($round["winning"] as $cardWinning) {
            foreach($round["yourHand"] as $cardOwned) {
                if ($cardWinning == $cardOwned) {
                    $roundPoint = $roundPoint == 0 ? 1 : $roundPoint * 2;
                }
            }
        }

        $totalPoints += $roundPoint;
    }

    echo $totalPoints . PHP_EOL; # Response : 13
}

function exerciseStatement(): void
{
    $file = new File("../../../statement/Day04Part1/input.txt");
    $totalPoints = 0;
    $allRounds = [];

    foreach($file as $line) {
        $roundPoint = 0;
        $round = getCardGameRoundParsed($line);
        $allRounds[] = $round;

        foreach($round["winning"] as $cardWinning) {
            foreach($round["yourHand"] as $cardOwned) {
                if ($cardWinning == $cardOwned) {
                    $roundPoint = $roundPoint == 0 ? 1 : $roundPoint * 2;
                }
            }
        }

        $totalPoints += (int) $roundPoint;
    }

    echo $totalPoints . PHP_EOL; # Response : 21568
}

function main(): void
{
    exerciseExample();
    exerciseStatement();
}

main();
