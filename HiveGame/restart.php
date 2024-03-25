<?php

session_start();

// Leeg de sessie variabelen
$_SESSION['board'] = [];
$_SESSION['hand'] = [0 => ["Q" => 1, "B" => 2, "S" => 2, "A" => 3, "G" => 3], 1 => ["Q" => 1, "B" => 2, "S" => 2, "A" => 3, "G" => 3]];
$_SESSION['player'] = 0;

// Maak de database van zetten leeg
$db = include_once 'database.php';
$db->query('TRUNCATE TABLE moves');
$db->query('TRUNCATE TABLE games');

// Maak een nieuw spel aan
$db->prepare('INSERT INTO games VALUES ()')->execute();
$_SESSION['game_id'] = $db->insert_id;

header('Location: index.php'); 



?>