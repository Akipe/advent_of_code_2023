<?php

// declare(strict_types=1);

use Akipe\AdventOfCode2023\Utils\File;

require_once '../../../vendor/autoload.php';

/**
 * @param string $line
 * @return array<{"winning":int[],"yourHand":int[]}>
 */
function getParsedCards(File $file): array
{
    $allCardsParsed = [];

    foreach($file as $line) {
        $separateCardId = explode(":", $line);
        $separateTypeCards = array_filter(explode("|", trim($separateCardId[1])));
        $cardParsed["winning"] = array_filter(explode(" ", trim($separateTypeCards[0])));
        $cardParsed["yourHand"] = array_filter(explode(" ", trim($separateTypeCards[1])));
        $allCardsParsed[] = $cardParsed;
    }

    return $allCardsParsed;
}

/**
 * @param array<{"winning":int[],"yourHand":int[]}> $allCardsInfo
 * @param int $cardId
 * @param int $numberCardsPlayed
 * @return int
 */
function getNumberCardPlayed(
    array $allCardsInfo,
    int $cardId = 0,
    int $numberCardsPlayed = 0
): int {
    // All cards are read at least once
    if ($cardId == 0) {
        for ($idCard = 1; $idCard <= count($allCardsInfo); $idCard++) {
            $numberCardsPlayed = getNumberCardPlayed(
                $allCardsInfo,
                $idCard,
                $numberCardsPlayed
            );
        }
    } else {
        // We process current card
        $numberCardsPlayed++;

        // Get how many numbers are wining
        $howManyMatches = count(
            array_intersect(
                $allCardsInfo[$cardId - 1]["winning"],
                $allCardsInfo[$cardId - 1]["yourHand"]
            )
        );

        // Reroll cards depends of matches
        for (
            $cardIdToPlay = $cardId + 1;
            $cardIdToPlay <= $howManyMatches + $cardId;
            $cardIdToPlay++
        ) {
            $numberCardsPlayed = getNumberCardPlayed(
                $allCardsInfo,
                $cardIdToPlay,
                $numberCardsPlayed
            );
        }
    }

    return $numberCardsPlayed;
}

function exerciseExample(): void
{
    $cardsParse = getParsedCards(
        new File("../../../statement/Day04Part2/input_example.txt")
    );

    echo getNumberCardPlayed($cardsParse) . PHP_EOL; # Response : 30
}

function exerciseStatement(): void
{
    $cardsParse = getParsedCards(
        new File("../../../statement/Day04Part2/input.txt")
    );

    echo getNumberCardPlayed($cardsParse) . PHP_EOL; # Response : 11827296
}

function main(): void
{
    exerciseExample();
    exerciseStatement();
}

main();
