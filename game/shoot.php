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

$db_path = 'db/games';
$db = unserialize(file_get_contents($db_path));
$arena = $db[$_POST['game_id']]['arena'];

// echo $db[$_POST['game_id']]['ship'][$_SESSION['up_to']]['x'];
$arena->cleanShoot();

// print_r($arena);
$ship = getShipByName($_POST['name'], $arena);
if ($ship)
{
	$ship->fight(array("dice_roll" => $weapon_dice,
		"width" => $ship->getWidth(),
		"height" => $ship->getHeight(),
		"position_x" => $ship->getPositionX(),
		"position_y" => $ship->getPositionY(),
		"arena" => $arena,
		"direction" => $_POST['shoot']));

	$fp = fopen($db_path, "w");
	flock($fp, LOCK_EX);
	$db[$_POST['game_id']]['arena'] = $arena;
	file_put_contents($db_path, serialize($db));
	fclose($fp);

}
$_SESSION['shot_has_been_fired'] = 'ON';
// echo "<br>";
// echo "<br>";
// print_r($arena);
// header('Location: index.php');
header('Location: index.php?id='.$_POST['game_id']);

?>