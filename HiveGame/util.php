<?php
include_once 'moveFunctions.php';

$GLOBALS['OFFSETS'] = [[0, 1], [0, -1], [1, 0], [-1, 0], [-1, 1], [1, -1]];


function isNeighbour($a, $b) {
    $a = explode(',', $a);
    $b = explode(',', $b);
    if ($a[0] == $b[0] && abs($a[1] - $b[1]) == 1) return true;
    if ($a[1] == $b[1] && abs($a[0] - $b[0]) == 1) return true;
    if ($a[0] + $a[1] == $b[0] + $b[1]) return true;
    return false;
}

function hasNeighBour($a, $board) {
    foreach (array_keys($board) as $b) {
        if (isNeighbour($a, $b)) return true;
    }
}

function neighboursAreSameColor($player, $a, $board) {
    foreach ($board as $b => $st) {
        if (!$st) continue;
        $c = $st[count($st) - 1][0];
        if ($c != $player && isNeighbour($a, $b)) return false;
    }
    return true;
}

function len($tile) {
    return $tile ? count($tile) : 0;
}

function slide($board, $from, $to) {
    if (!hasNeighBour($to, $board)) return false;
    if (!isNeighbour($from, $to)) return false;
    $b = explode(',', $to);
    $common = [];
    foreach ($GLOBALS['OFFSETS'] as $pq) {
        $p = $b[0] + $pq[0];
        $q = $b[1] + $pq[1];
        if (isNeighbour($from, $p.",".$q)) $common[] = $p.",".$q;
    }
    if (!isset($board[$common[0]]) && !isset($board[$common[1]]) && !isset($board[$from]) && !isset($board[$to])) return false;
    return min(len($board[$common[0]]), len($board[$common[1]])) <= max(len($board[$from]), len($board[$to]));
}

function canPlayerPlaceStone($player, $hand, $to, $board) {
    foreach ($hand[$player] as $tile => $ct) {
        if ($ct > 0) {
            foreach ($to as $pos) {
                if (array_sum($hand[$player]) == 11) {
                    return true;
                } elseif (neighboursAreSameColor($player, $pos, $board) && !(isset($board[$pos]))) {
                    return true;
                }
            }
        }
    }
    return false;
}

function canPlayerMoveStone($player, $board, $to) {
    foreach (array_keys($board) as $pos) {
        if ($board[$pos][0][0] == $player) {
            foreach ($to as $new_pos) {
                $tile = $board[$pos][count($board[$pos])-1];
                if (isset($board[$new_pos])) continue;
                if ($tile[1] == "Q" || $tile[1] == "B") {
                    if (slide($board, $pos, $new_pos)) {
                        return true;
                    }
                } elseif ($tile[1] == "G") {
                    if (validGrasshopper($board, $pos, $new_pos)) {
                        return true;
                    }
                } elseif ($tile[1] == "S") {
                    if (validSpider($board, $pos, $new_pos)) {
                        return true;
                    }
                } elseif ($tile[1] == "A") {
                    if (!isPositionFullyOccupied($new_pos, $board)) {
                        return true;
                    }
                }
            }
        }
    }
    return false;
}

function checkwin($board) {
    $player0QueenSurrounded = false;
    $player1QueenSurrounded = false;

    // Zoek alle Q stenen op het bord
    foreach ($board as $pos => $tile) {
        foreach ($tile as $piece) {
            if ($piece[1] === "Q") {
                // Controleer of de gevonden Q stenen volledig omsingeld zijn
                $isSurrounded = true;
                foreach ($GLOBALS['OFFSETS'] as $offset) {
                    error_reporting(E_ERROR | E_PARSE);
                    $neighborPos = ($pos[0] + $offset[0]) . ',' . ($pos[1] + $offset[1]);
                    if (!isset($board[$neighborPos])) {
                        $isSurrounded = false;
                        break;
                    }
                }
                // Bepaal of de Q steen van speler 0 of speler 1 omsingeld is
                if ($isSurrounded) {
                    if ($tile[0][0] === 0) {
                        $player0QueenSurrounded = true;
                    } elseif ($tile[0][0] === 1) {
                        $player1QueenSurrounded = true;
                    }
                }
            }
        }
    }

    // Bepaal de winnaar op basis van de omsingelde Q stenen
    if (!$player0QueenSurrounded && !$player1QueenSurrounded) {
        return 0; // Geen winnaar
    } elseif ($player0QueenSurrounded && !$player1QueenSurrounded) {
        return 1; // Speler 1 heeft gewonnen
    } elseif (!$player0QueenSurrounded && $player1QueenSurrounded) {
        return 2; // Speler 0 heeft gewonnen
    } else {
        return "draw"; // Gelijkspel
    }
}
