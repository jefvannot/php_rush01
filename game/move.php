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

$shipToMove = getShipByName($_POST['name'], $_SESSION['arena']);
if ($shipToMove)
	$shipToMove->move($dx * $percent, $dy * $percent, $_SESSION['arena']);

header('Location: index.php');

?>