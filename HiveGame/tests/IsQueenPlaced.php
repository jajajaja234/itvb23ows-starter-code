<?php

// Functie die de conditie test
function testCondition($piece, $hand) {
    return ($piece != 'Q' && array_sum($hand) <= 8 && $hand['Q']);
}

// Testgevallen
function runTests() {
    $testCases = [
        ["piece" => "K", "hand" => ["Q" => 1, "K" => 2, "P" => 3], "expected" => true],
        ["piece" => "B", "hand" => ["K" => 1, "Q" => 2, "P" => 3], "expected" => true],
        ["piece" => "Q", "hand" => ["Q" => 1, "K" => 2, "P" => 3], "expected" => false], #mag
        ["piece" => "R", "hand" => ["P" => 0, "K" => 2, "P" => 3], "expected" => false], #mag
        ["piece" => "R", "hand" => ["Q" => 1, "K" => 2, "P" => 3, "K" => 4, "P" => 5, "K" => 6, "P" => 7, "K" => 8, "P" => 9], "expected" => false], #mag
        ["piece" => "Q", "hand" => ["Q" => 1, "K" => 2, "P" => 3, "B" => 1, "K" => 4, "P" => 5, "K" => 6], "expected" => false], #mag
    ];

    foreach ($testCases as $testCase) {
        $result = testCondition($testCase["piece"], $testCase["hand"]);
        $expected = $testCase["expected"];
        $status = $result === $expected ? "Passed" : "Failed";
        echo "Test case: Piece = {$testCase["piece"]}, Hand = " . json_encode($testCase["hand"]) . " => $status<br>";
        die;
    }
}

runTests();
?>