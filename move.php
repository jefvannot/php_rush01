<?php

# calls move for the correct ship

include_once('Arena.class.php');
include_once('ScoutOfHorror.class.php');
include_once('Obstacle.class.php');

include_once('getShipByName.php');

session_start();


// echo "test";
// print_r($_POST);
// print_r($_SESSION['arena']);

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

if (isset($_SESSION['speed_dice']) && $_SESSION['speed_dice'] != "" && $_SESSION['speed_dice'] != "played")
{
	$percent = $_SESSION['speed_dice'] / 6;
	$_SESSION['speed_dice'] = "played";
}
else if ($_SESSION['speed_dice'] == "played" && $_SESSION['pp_to_speed'])
{
	$percent = 1;
	$_SESSION['pp_to_speed']--;
}


$shipToMove = getShipByName($_POST['name'], $_SESSION['arena']);
if ($shipToMove)
	$shipToMove->move($dx * $percent, $dy * $percent, $_SESSION['arena']);

header('Location: index.php');

?>