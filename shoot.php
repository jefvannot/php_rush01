<?php

include_once('Arena.class.php');
include_once('ScoutOfHorror.class.php');
include_once('Obstacle.class.php');

session_start();

function getShipByName($name, $arena) {
	foreach ($arena->getOnScreens() as $current) {
		if ($name === $current->getName()) {
			return $current;
		}
	}
	error_log('ship not found in getShipByName (move.php)');
	return null;
}


$direction_shoot = $_POST['shoot'];

$weapon_dice = (isset($_SESSION['weapon_dice']) && $_SESSION['weapon_dice'] != "played") ? $_SESSION['weapon_dice'] : 1;

// echo $_SESSION['weapon_dice'];
// echo "<br>";
// echo "weapon_dice = ".$weapon_dice;
// echo "<br>";
// // print_r($_POST);
if ($_SESSION['weapon_dice'] == "played")
{
	$weapon_dice = 6;
	$_SESSION['pp_to_weapon']--;
}

$_SESSION['weapon_dice'] = "played";

$shipThatShoots = getShipByName($_POST['name'], $_SESSION['arena']);
if ($shipThatShoots)
{
	$shipThatShoots->fight(array("dice_roll" => $weapon_dice,
									"width" => $shipThatShoots->getWidth(),
									"height" => $shipThatShoots->getHeight(),
									"position_x" => $shipThatShoots->getPositionX(),
									"position_y" => $shipThatShoots->getPositionY(),
									"arena" => $_SESSION['arena'],
									"direction" => $_POST['shoot']));
}
$_SESSION['shot_has_been_fired'] = 'ON';
header('Location: index.php');

?>