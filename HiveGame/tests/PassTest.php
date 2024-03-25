<?php
include_once '../util.php';

function canPassTest($player, $board, $hand, $to) {
    $can_place_stone = canPlayerPlaceStone($player, $hand, $to, $board);
    $can_move_stone = canPlayerMoveStone($player, $board, $to);

    echo "Test voor Pass: ";
    if ($can_place_stone || $can_move_stone) {
        echo "Pass<br>";
    } else {
        echo "Fail<br>";
    }
    echo "<br>";
}

function canNotPassTest($player, $board, $hand, $to) {
    $can_place_stone = canPlayerPlaceStone($player, $hand, $to, $board);
    $can_move_stone = canPlayerMoveStone($player, $board, $to);

    echo "Test voor Pass: ";
    if (!$can_place_stone && !$can_move_stone) {
        echo "Pass<br>";
    } else {
        echo "Fail<br>";
    }
    echo "<br>";
}

// Mock data can pass
$player = 0; 
$board = array(
    '0,0' => array(array(0, 'Q')), 
    '1,1' => array(array(1, 'B')),
);
$hand = array(
    0 => array('Q' => 1), 
    1 => array('B' => 1), 
);
$to = array('0,1', '1,0', '0,0'); 

// Run test
canPassTest($player, $board, $hand, $to);

// Mock data can not pass
$hand = array(
    0 => array(),
    1 => array('B' => 1), 
);
$to = array(); 

// Run test
canNotPassTest($player, $board, $hand, $to);
?>
