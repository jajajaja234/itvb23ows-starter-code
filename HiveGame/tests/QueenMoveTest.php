<?php
include_once '../util.php';

// Mock $_SESSION variabelen
$board = [
    "0,0" => [[0, "Q"]],
    "1,0" => [[1, "Q"]],
];

$from = '0,0';
$to = '0,1';
$to2 = '0,4';

$result = slide($board, $from, $to);
$result2 = slide($board, $from, $to2);

// Verwachte resultaat
$expected_result = true;

// Testen of de resultaten overeenkomen
if ($result === $expected_result) {
    echo "Test geslaagd! De code geeft het verwachte resultaat terug.";
} else {
    echo "Test mislukt! De code geeft niet het verwachte resultaat terug.";
}

if ($result2 === !$expected_result) {
    echo "Test geslaagd! De code geeft het verwachte resultaat terug.";
} else {
    echo "Test mislukt! De code geeft niet het verwachte resultaat terug.";
}
?>