<?php
include_once 'util.php';


#Winnaar Unit Tests
function testNoWinner() {
    $board = [
        "0,0" => [[0, "Q"]],
        "1,0" => [[1, "B"]],
        "0,1" => [[1, "B"]],
        "2,0" => [[0, "A"]],
        "2,1" => [[1, "G"]],
    ];

    $result = checkwin($board);
    if ($result == 0) {
        echo "Test No Winner: Passed<br>";
    } else {
        echo "Test No Winner: Failed<br>";
    }
}

function testWinnerPlayer1() {
    $board = [
        "0,0" => [[0, "Q"]],
        "0,1" => [[0, "B"]],
        "0,-1" => [[0, "B"]],
        "1,0" => [[1, "A"]],
        "-1,0" => [[0, "G"]],
        "-1,1" => [[1, "A"]],
        "1,-1" => [[0, "G"]],
    ];

    $result = checkwin($board);
    if ($result == 1) {
        echo "Test Winner is Player 1: Passed<br>";
    } else {
        echo "Test Winner is Player 1: Failed<br>";
    }
}

function testWinnerPlayer0() {
    $board = [
        "0,0" => [[1, "Q"]],
        "0,1" => [[0, "B"]],
        "0,-1" => [[0, "B"]],
        "1,0" => [[1, "A"]],
        "-1,0" => [[0, "G"]],
        "-1,1" => [[1, "A"]],
        "1,-1" => [[0, "G"]],
    ];

    $result = checkwin($board);
    if ($result == 2) {
        echo "Test Winner is Player 0: Passed<br>";
    } else {
        echo "Test Winner is Player 0: Failed<br>";
    }
}

function testDraw() {
    $board = [
        "0,0" => [[0, "Q"]],
        "1,0" => [[1, "Q"]],
        "0,1" => [[0, "B"]],
        "0,-1" => [[1, "B"]],
        "-1,0" => [[1, "A"]],
        "-1,1" => [[1, "B"]],
        "1,-1" => [[1, "A"]],
        "1,1" => [[1, "B"]],
        "2,0" => [[1, "A"]],
        "2,-1" => [[1, "B"]],
    ];

    $result = checkwin($board);
    if ($result == "draw") {
        echo "Test Draw: Passed<br>";
    } else {
        echo "Test Draw: Failed<br>";
    }
}


echo "<strong>Winnaar Unit Tests</strong><br>";
testNoWinner();
testWinnerPlayer1();
testWinnerPlayer0();
testDraw();
?>

