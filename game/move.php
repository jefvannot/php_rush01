<?php

include_once('Arena.class.php');
include_once('ScoutOfHorror.class.php');
include_once('Obstacle.class.php');

include_once('getShipByName.php');

session_start();

if ($_POST['move'] == 'up') {
	$dx = 0;
	$dy = -1;
}
if ($_POST['move'] == '<') {
	$dx = -1;
	$dy = 0;
}
if ($_POST['move'] == '>') {
	$dx = 1;
	$dy = 0;
}
if ($_POST['move'] == 'down') {
	$dx = 0;
	$dy = 1;
}


$db_path = 'db/games';
$db = unserialize(file_get_contents($db_path));
$arena = $db[$_POST['game_id']]['arena'];
$arena->cleanShoot();
		// echo "<br>";
// echo $db[$_POST['game_id']];
		// echo "<br>";
		// print_r($db);
$fp = fopen($db_path, "w");
flock($fp, LOCK_EX);

if (isset($db[$_POST['game_id']]['speed_dice']) && $db[$_POST['game_id']]['speed_dice'] !== null)
{
	$percent = $db[$_POST['game_id']]['speed_dice'] / 6;
	if ($db[$_POST['game_id']]['pp_to_speed'] > 0)
	{
		$db[$_POST['game_id']]['speed_dice'] = null;
		$db[$_POST['game_id']]['pp_to_speed']--;
	}
	else
		$db[$_POST['game_id']]['speed_dice'] = "played";
}

$ship = getShipByName($_POST['name'], $arena);
if ($ship)
	$ship->move($dx * $percent, $dy * $percent, $arena);

if ($ret != "destroyed")
{
	$db[$_GET['id']]['ship'][$_POST['name']] = $ship;
}

file_put_contents($db_path, serialize($db));
fclose($fp);

header("Refresh:0; index.php?id=".$_POST['game_id']);

header('Location: index.php?id='.$_POST['game_id']);
?>