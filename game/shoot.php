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

if (isset($_SESSION['weapon_dice']) && $_SESSION['weapon_dice'] != null)
{
	$weapon_dice = $_SESSION['weapon_dice'];

	if ($_SESSION['pp_to_weapon'] > 0)
	{
		$_SESSION['weapon_dice'] = null;
		$_SESSION['pp_to_weapon']--;
	}
	else
		$_SESSION['weapon_dice'] = "played";
}

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