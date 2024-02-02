<?php

session_start();

include_once 'util.php';
include_once 'moveFunctions.php';

$from = $_POST['from'];
$to = $_POST['to'];

$player = $_SESSION['player'];
$board = $_SESSION['board'];
$hand = $_SESSION['hand'][$player];
unset($_SESSION['error']);

if (!isset($board[$from]))
    $_SESSION['error'] = 'Board position is empty';
elseif ($board[$from][count($board[$from])-1][0] != $player)
    $_SESSION['error'] = "Tile is not owned by player";
elseif ($hand['Q'])
    $_SESSION['error'] = "Queen bee is not played";
else {
    $tile = array_pop($board[$from]);
    if (!hasNeighBour($to, $board))
        $_SESSION['error'] = "Move would split hive";
    else {
        $all = array_keys($board);
        $queue = [array_shift($all)];
        while ($queue) {
            $next = explode(',', array_shift($queue));
            foreach ($GLOBALS['OFFSETS'] as $pq) {
                list($p, $q) = $pq;
                $p += $next[0];
                $q += $next[1];
                if (in_array("$p,$q", $all)) {
                    $queue[] = "$p,$q";
                    $all = array_diff($all, ["$p,$q"]);
                }
            }
        }
        if ($all) {
            $_SESSION['error'] = "Move would split hive";
        } else {
            if ($from == $to) $_SESSION['error'] = 'Tile must move';
            elseif (isset($board[$to]) && $tile[1] != "B") $_SESSION['error'] = 'Tile not empty';
            elseif ($tile[1] == "Q" || $tile[1] == "B") {
                if (!slide($board, $from, $to))
                    $_SESSION['error'] = 'Tile must slide';
            }
            elseif ($tile[1] == "G") {
                if (!validGrasshopper($board, $from, $to)) {
                    $_SESSION['error'] = 'Unvalid move for Grasshopper'; 
                }
            }
            elseif ($tile[1] == "A") {
                    if (isPositionFullyOccupied($from, $board) == true || isPositionFullyOccupied($to, $board) == true) {
                    $_SESSION['error'] = 'Unvalid move for Soldier-Ant'; 
                }
            }
            elseif ($tile[1] == "S") {

                #$start = [0, 0];
                $start = [0, -1];
                $end = [1, 0];
                
                $paths = findAllPaths($board, $start, $end);
                
                foreach ($paths as $path) {
                    echo "Path: ";
                    foreach ($path as $step) {
                        echo "[" . implode(", ", $step) . "] ";
                    }
                    echo "\n";
                }

                if (!validSpider($board, $from, $to)) {
                    $_SESSION['error'] = 'Invalid move for Spider';
                }
            }
            
        }
    }
    if (isset($_SESSION['error'])) {
        if (isset($board[$from])) array_push($board[$from], $tile);
        else $board[$from] = [$tile];
    } else {
        if (isset($board[$to])) array_push($board[$to], $tile);
        else $board[$to] = [$tile];
        $_SESSION['player'] = 1 - $_SESSION['player'];
        $db = include 'database.php';
        $stmt = $db->prepare('insert into moves (game_id, type, move_from, move_to, previous_id, state) values (?, "move", ?, ?, ?, ?)');
        $stmt->bind_param('issis', $_SESSION['game_id'], $from, $to, $_SESSION['last_move'], get_state());
        $stmt->execute();
        $_SESSION['last_move'] = $db->insert_id;
        unset($board[$from]);
    }
    $_SESSION['board'] = $board;
}

header('Location: index.php');

?>