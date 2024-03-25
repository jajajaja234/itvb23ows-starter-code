<?php
include_once '../util.php';

function validGrasshopperTest($board, $testCases) {
    foreach ($testCases as $testCase) {
        $from = $testCase["from"];
        $to = $testCase["to"];
        $expected = $testCase["expected"];

        $result = validGrasshopper($board, $from, $to);

        echo "Test voor move van $from naar $to: ";
        if ($result === $expected) {
            echo "Pass<br>";
        } else {
            echo "Fail<br>";
            echo "Verwacht: " . ($expected ? "true" : "false") . ", Kreeg: " . ($result ? "true" : "false") . "<br>";
        }
    }
    echo "<br>";
}

function validAntTest($board, $testCases) {
    foreach ($testCases as $testCase) {
        $from = $testCase["from"];
        $to = $testCase["to"];
        $expected = $testCase["expected"];

        $result = isPositionFullyOccupied($to, $board);

        echo "Test voor move van $from naar $to: ";
        if ($result === $expected) {
            echo "Pass<br>";
        } else {
            echo "Fail<br>";
            echo "Verwacht: " . ($expected ? "true" : "false") . ", Kreeg: " . ($result ? "true" : "false") . "<br>";
        }
    }
    echo "<br>";
}

function validSpiderTest($board, $testCases) {
    foreach ($testCases as $testCase) {
        $from = $testCase["from"];
        $to = $testCase["to"];
        $expected = $testCase["expected"];

        $result = validSpider($board, $from, $to);

        echo "Test voor move van $from naar $to: ";
        if ($result === $expected) {
            echo "Pass<br>";
        } else {
            echo "Fail<br>";
            echo "Verwacht: " . ($expected ? "true" : "false") . ", Kreeg: " . ($result ? "true" : "false") . "<br>";
        }
    }
    echo "<br>";
}

$board = array(
    "0,-2" => [["0", "S"]],
    "0,-1" => [["1", "A"]],
    "0,0" => [["1", "Q"]],
    "0,1" => [["0", "B"]],
    "0,2" => [["0", "S"]],
    "0,3" => [["0", "G"]],
    "1,0" => [["1", "A"]],
    "1,1" => [["0", "S"]],
    "-1,1" => [["0", "Q"]],
    "-1,2" => [["0", "S"]]
);

// Testgevallen
$testCasesGrasshopper = array(
    array("from" => "0,3", "to" => "0,-3", "expected" => true),
    array("from" => "0,3", "to" => "0,-4", "expected" => false), 
    array("from" => "0,3", "to" => "0,5", "expected" => false), 
    array("from" => "0,3", "to" => "2,2", "expected" => false), 
    array("from" => "0,3", "to" => "-8,5", "expected" => false), 
);

$testCasesAnt= array(
    array("from" => "1,0", "to" => "1,2", "expected" => false),
    array("from" => "1,0", "to" => "0,4", "expected" => false), 
    array("from" => "1,0", "to" => "0,1", "expected" => true), 
);

$testCasesSpider = array(
    array("from" => "0,-2", "to" => "1,-1", "expected" => true),
    array("from" => "0,-2", "to" => "-1,-1", "expected" => true), 
    array("from" => "0,-2", "to" => "-1,0", "expected" => false), 
    array("from" => "0,-2", "to" => "-2,0", "expected" => false), 
    array("from" => "0,-2", "to" => "8,5", "expected" => false), 
);


// Testen uitvoeren
echo "Grasshopper:<br>";
validGrasshopperTest($board, $testCasesGrasshopper);
echo "Ant:<br>";
validAntTest($board, $testCasesAnt);
echo "Spider:<br>";
validSpiderTest($board, $testCasesSpider);
?>