<?php
session_start();

$db = include 'database.php';

// Zoek de laatste zet in de database
$stmt = $db->prepare('SELECT * FROM moves WHERE game_id = ? ORDER BY id DESC LIMIT 1');
$stmt->bind_param('i', $_SESSION['game_id']);
$stmt->execute();
$result = $stmt->get_result()->fetch_array();

// Controleer of er een zet gevonden is
if ($result) {
    set_state($result['state']);

    $stmt = $db->prepare('DELETE FROM moves WHERE id = ?');
    $stmt->bind_param('i', $result['id']);
    $stmt->execute();

    $_SESSION['last_move'] = $result['previous_id'];
}

header('Location: index.php'); 

?>
