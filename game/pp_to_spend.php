<?php

include_once('Arena.class.php');
include_once('getShipByName.php');

session_start();

$db_path = 'db/games';
$db = unserialize(file_get_contents($db_path));
$arena = $db[$_POST['game_id']]['arena'];

$_POST['pp_speed'] = ($_POST['pp_speed'] == "") ? 0 : $_POST['pp_speed'];
$_POST['pp_shield'] = ($_POST['pp_shield'] == "") ? 0 : $_POST['pp_shield'];
$_POST['pp_weapon'] = ($_POST['pp_weapon'] == "") ? 0 : $_POST['pp_weapon'];

$fp = fopen($db_path, "w");
flock($fp, LOCK_EX);

if (($_POST['pp_speed'] + $_POST['pp_shield'] + $_POST['pp_weapon']) <= $_POST['pp_to_spend'])
{
	$player = getShipByName($_POST['name'], $arena);
	if ($player)
		$player->addToShield($_POST['pp_shield']);

	$db[$_POST['game_id']]['ship'][$_POST['name']] = $player;
	$db[$_POST['game_id']]['pp_to_speed'] = $_POST['pp_speed'];
	$db[$_POST['game_id']]['pp_to_weapon'] = $_POST['pp_weapon'];
	$db[$_POST['game_id']]['pp_set'] = true;

}
else
{
	$db[$_POST['game_id']]['pp_set'] = false;
	$db[$_POST['game_id']]['pp_to_speed'] = null;
	$db[$_POST['game_id']]['pp_to_shield'] = null;
	$db[$_POST['game_id']]['pp_to_weapon'] = null;
}

file_put_contents($db_path, serialize($db));
fclose($fp);

header('Location: index.php?id='.$_POST['game_id']);

?>