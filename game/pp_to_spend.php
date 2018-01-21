<?php

include_once('Arena.class.php');
include_once('getShipByName.php');

session_start();

$_SESSION['pp_to_speed'] = ($_POST['pp_speed'] == "") ? 0 : $_POST['pp_speed'];
$_SESSION['pp_to_shield'] = ($_POST['pp_shield'] == "") ? 0 : $_POST['pp_shield'];
$_SESSION['pp_to_weapon'] = ($_POST['pp_weapon'] == "") ? 0 : $_POST['pp_weapon'];


$db_path = 'db/games';
$db = unserialize(file_get_contents($db_path));
$arena = $db[$_POST['game_id']]['arena'];

if (($_SESSION['pp_to_speed'] + $_SESSION['pp_to_shield'] + $_SESSION['pp_to_weapon']) <= $_POST['pp_to_spend'])
{
	$player = getShipByName($_POST['name'], $arena);
	if ($player)
		$player->addToShield($_SESSION['pp_to_shield']);
	$_SESSION['pp_set'] = true;

	$fp = fopen($db_path, "w");
	flock($fp, LOCK_EX);
	$db[$_POST['game_id']]['ship'][$_POST['game_id']] = $player;
	file_put_contents($db_path, serialize($db));
	fclose($fp);

}
else
{
	$_SESSION['pp_set'] = false;
	$_SESSION['pp_to_speed'] = null;
	$_SESSION['pp_to_shield'] = null;
	$_SESSION['pp_to_weapon'] = null;
}
// header('Location: index.php');
header('Location: index.php?id='.$_POST['game_id']);

?>