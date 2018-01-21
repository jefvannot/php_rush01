<?php

include_once('Arena.class.php');
include_once('ScoutOfHorror.class.php');
include_once('Obstacle.class.php');

session_start();

$db_path = 'db/games';
$db = unserialize(file_get_contents($db_path));
$arena = $db[$_POST['game_id']]['arena'];
$arena->cleanShoot();

function getShipByName($name, $arena) {
	foreach ($arena->getOnScreens() as $current) {
		if ($name === $current->getName()) {
			return $current;
		}
	}
	error_log('ship not found in getShipByName (move.php)');
	return null;
}

$fp = fopen($db_path, "w");
flock($fp, LOCK_EX);

if (isset($db[$_POST['game_id']]['weapon_dice']) && $db[$_POST['game_id']]['weapon_dice'] != null)
{
	$weapon_dice = $db[$_POST['game_id']]['weapon_dice'];

	if ($db[$_POST['game_id']]['pp_to_weapon'] > 0)
	{
		$db[$_POST['game_id']]['weapon_dice'] = null;
		$db[$_POST['game_id']]['pp_to_weapon']--;
	}
	else
		$db[$_POST['game_id']]['weapon_dice'] = "played";
}

// echo $db[$_POST['game_id']]['ship'][$_SESSION['up_to']]['x'];

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

	
	$db[$_POST['game_id']]['arena'] = $arena;


}

file_put_contents($db_path, serialize($db));
fclose($fp);

$_SESSION['shot_has_been_fired'] = 'ON';
// echo "<br>";
// echo "<br>";
// print_r($arena);
// header('Location: index.php');
header('Location: index.php?id='.$_POST['game_id']);

?>