<?php
function validGrasshopper($board, $from, $to) {
    $fromExploded = explode(',', $from);
    $toExploded = explode(',', $to);
    $direction = Direction($fromExploded, $toExploded);

    $p = $fromExploded[0] + $direction[0];
    $q = $fromExploded[1] + $direction[1];
    $pos = $p . "," . $q;
    $posExploded = [$p, $q];

    if ($direction == null) {
        return false;
    }

    while (isset($board[$pos])) {
        $p = $posExploded[0] + $direction[0];
        $q = $posExploded[1] + $direction[1];

        $pos = $p . "," . $q;
        $posExploded = [$p, $q];
    }

    if ($pos == $to) {
        return true;
    }
    return false;
}

function Direction($fromExploded, $toExploded) {
    $from1 = $fromExploded[0];
    $from2 = $fromExploded[1];
    $to1 = $toExploded[0];
    $to2 = $toExploded[1];

    $dx = $to1 - $from1;
    $dy = $to2 - $from2;

    if ($dx == 0 && $dy != 0) {
        return [$dx, $dy > 0 ? 1 : -1];
    } elseif ($dy == 0 && $dx != 0) {
        return [$dx > 0 ? 1 : -1, $dy];
    } elseif (abs($dx) == abs($dy)) {
        return [$dx > 0 ? 1 : -1, $dy > 0 ? 1 : -1];
    } else {
        return null;
    }
}

function isPositionFullyOccupied($position, $board) {
    $neighbours = [[0, 1], [0, -1], [1, 0], [-1, 0], [-1, 1], [1, -1]];

    $positionExploded = explode(',', $position);
    $position0 = $positionExploded[0];
    $position1 = $positionExploded[1];

    foreach ($neighbours as $offset) {
        $neighbourPosition0 = $position0 + $offset[0];
        $neighbourPosition1 = $position1 + $offset[1];

        $neighbourPosition = "{$neighbourPosition0},{$neighbourPosition1}";

        if (!isset($board[$neighbourPosition])) {
            return false;
        }
    }

    return true;
}

function validSpider($board, $from, $to) {
    $fromExploded = explode(',', $from);
    $toExploded = explode(',', $to);
    $direction = Direction($fromExploded, $toExploded);

    if ($direction == null) {
        return false; 
    }

    $steps = 0;
    $currentPosition = $from;

    while ($steps < 3) {
        $p = $fromExploded[0] + $direction[0];
        $q = $fromExploded[1] + $direction[1];
        $nextPosition = "$p,$q";

        if ($nextPosition == $to || !isset($board[$nextPosition])) {
            $currentPosition = $nextPosition;
            $steps++;

            if (!hasNeighBour($currentPosition, $board)) {
                return false; 
            }
        } else {
            return false; 
        }
    }

    return $currentPosition == $to;
} 


function isValidMove($newLocation, $start, $path, $board) {
    if ($newLocation == $start) {
        return false;
    }
 
    if (in_array($newLocation, $path)) {
        return false;
    }

    $newLocationString = implode(',', $newLocation);
    if (!hasNeighBour($newLocationString, $board)) {
        return false;
    }

    if (isset($board[$newLocationString])) {
        return false;
    }

    return true;
}

function findAllPaths($board, $current, $destination, $path = [], $depth = 0, $maxDepth = 3) {
    $start = $current;
 
    if ($current == $destination && count($path) == 3) {
        return [$path];
    }
    

    if ($depth >= $maxDepth) {
        return [];
    }

    $allPaths = [];

    foreach ($GLOBALS['OFFSETS'] as $offset) {
        $newLocation = [$current[0] + $offset[0], $current[1] + $offset[1]];

        if (isValidMove($newLocation, $start, $path, $board)) {
            $newPath = $path;
            $newPath[] = $newLocation;

            $subPaths = findAllPaths($board, $newLocation, $destination, $newPath, $depth + 1, $maxDepth);

            if (!empty($subPaths)) {
                $allPaths = array_merge($allPaths, $subPaths);
            }
        }
    }

    return $allPaths;
} 


?>