<?php

@session_start();

$db_path = 'db/games';
$db = unserialize(file_get_contents($db_path));
$arena = $db[$_POST['game_id']]['arena'];

if ($_POST['action'] == 'move')
	$db[$_POST['game_id']]['speed_dice'] = mt_rand(1, 6);

if ($_POST['action'] == 'shoot')
	$db[$_POST['game_id']]['weapon_dice'] = mt_rand(1, 6);

file_put_contents($db_path, serialize($db));
fclose($fp);

// header('Location: index.php');
header('Location: index.php?id='.$_POST['game_id']);

?>