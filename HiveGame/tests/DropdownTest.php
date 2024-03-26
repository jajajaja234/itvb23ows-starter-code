<?php
include_once '../util.php';

function testPlayPieces($hand, $player)
{
    $actual_output = "";

    foreach ($hand[$player] as $tile => $ct) {
        if ($ct > 0) {
            $actual_output .= "<option value=\"$tile\">$tile</option>";
        }
    }

    $expected_output = "<option value=\"A\">A</option><option value=\"B\">B</option><option value=\"C\">C</option>";

    if ($actual_output === $expected_output) {
        echo "Test geslaagd: De foreach-lus geeft de juiste stenen terug.<br>";
    } else {
        echo "Test mislukt: De foreach-lus geeft niet de juiste stenen terug.<br>";
    }
}


function testCanPlaceAt($hand, $player, $board)
{
    $actual_output = "";

    $to = [];
    foreach ($GLOBALS['OFFSETS'] as $pq) {
        foreach (array_keys($board) as $pos) {
            $pq2 = explode(',', $pos);
            $to[] = ($pq[0] + $pq2[0]).','.($pq[1] + $pq2[1]);
        }
    }
    $to = array_unique($to);
    if (!count($to)) $to[] = '0,0';

    foreach ($to as $pos) {
        if (array_sum($hand[$player]) == 11) {
            $actual_output .= "<option value=\"$pos\">$pos</option>";
        }
        else if (neighboursAreSameColor($player, $pos, $board) == true && !(isset($board[$pos]))) {
            $actual_output .= "<option value=\"$pos\">$pos</option>";
        }
    }

    $expected_output = ""; 

    if ($actual_output === $expected_output) {
        echo "Test geslaagd: De foreach-lus geeft de juiste opties terug voor de to-dropdown.<br>";
    } else {
        echo "Test mislukt: De foreach-lus geeft niet de juiste opties terug voor de to-dropdown.<br>";
    }
}


function testCanMoveFrom($board, $player)
{
    $actual_output = "";
    foreach (array_keys($board) as $pos) {
        if (!empty($board[$pos]) && $board[$pos][0][0] == $player) {
            $actual_output .= "<option value=\"$pos\">$pos</option>";
        }
    }

    $expected_output = "<option value=\"1,2\">1,2</option><option value=\"3,4\">3,4</option>";

    if ($actual_output === $expected_output) {
        echo "Test geslaagd: De foreach-lus geeft de juiste opties terug voor de from-dropdown.<br>";
    } else {
        echo "Test mislukt: De foreach-lus geeft niet de juiste opties terug voor de from-dropdown.<br>";
    }
}


#dropdown 1
$_SESSION['hand'] = [
    'player1' => ['A' => 2, 'B' => 1, 'C' => 3],
    'player2' => ['X' => 1, 'Y' => 2, 'Z' => 0]
];
$player = 'player1';
testPlayPieces($_SESSION['hand'], $player);


#dropdown 2
$_SESSION['hand'] = [
    'player1' => ['A' => 2, 'B' => 1, 'C' => 3],
    'player2' => ['X' => 1, 'Y' => 2, 'Z' => 0]
];
$_SESSION['board'] = [
    '1,2' => [['player1', 'A'], ['player2', 'B']],
    '2,3' => [['player2', 'C']]
];
$player = 'player1';
testCanPlaceAt($_SESSION['hand'], $player, $_SESSION['board']);


#dropdown 3
$_SESSION['board'] = [
    '1,2' => [['player1', 'A'], ['player2', 'B']],
    '2,3' => [['player2', 'C']],
    '3,4' => [['player1', 'D']]
];
$player = 'player1';
testCanMoveFrom($_SESSION['board'], $player);
?>