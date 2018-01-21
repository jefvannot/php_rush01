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
		// print_r($db[$_POST['game_id']]);
		// echo "<br>";
		// echo "<br>";
		// print_r($db[$_POST['game_id']]['arena']);
		// echo "<br>";
		// echo "<br>";
		// // print_r($db[0]['arena']);
		// echo "<br>";
		// echo "<br>";
		// print_r($db);

if (isset($_SESSION['speed_dice']) && $_SESSION['speed_dice'] !== null)
{
	$percent = $_SESSION['speed_dice'] / 6;
	if ($_SESSION['pp_to_speed'] > 0)
	{
		$_SESSION['speed_dice'] = null;
		$_SESSION['pp_to_speed']--;
	}
	else
		$_SESSION['speed_dice'] = "played";
}

$ship = getShipByName($_POST['name'], $arena);
if ($ship)
	$ret = $ship->move($dx * $percent, $dy * $percent, $arena);

if ($ret != "destroyed")
{
		$fp = fopen($db_path, "w");
		flock($fp, LOCK_EX);
	// echo "<br>test";
	$db[$_GET['id']]['ship'][$_SESSION['up_to']]['x'] = $ret[pos_x];
	// echo $db[$_GET['id']]['ship'][$_SESSION['up_to']]['x'];
	$db[$_GET['id']]['ship'][$_SESSION['up_to']]['y'] = $ret[pos_y];
	file_put_contents($db_path, serialize($db));
		fclose($fp);
}

header('Location: index.php?id='.$_POST['game_id']);

?>