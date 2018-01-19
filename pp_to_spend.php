<?php

include_once('Arena.class.php');
include_once('getShipByName.php');

session_start();

// echo $_POST['pp_to_spend'];
// echo $_POST['pp_speed'];
// echo $_POST['pp_shield'];
// echo $_POST['pp_weapon'];

// echo "<br>";

$_SESSION['pp_to_speed'] = ($_POST['pp_speed'] == "") ? 0 : $_POST['pp_speed'];
$_SESSION['pp_to_shield'] = ($_POST['pp_shield'] == "") ? 0 : $_POST['pp_shield'];
$_SESSION['pp_to_weapon'] = ($_POST['pp_weapon'] == "") ? 0 : $_POST['pp_weapon'];

// echo $_SESSION['pp_to_speed'];
// echo "<br>";
// echo $_SESSION['pp_to_shield'];
// echo "<br>";
// echo $_SESSION['pp_to_weapon'];
// echo "<br>";

if (($_SESSION['pp_to_speed'] + $_SESSION['pp_to_shield'] + $_SESSION['pp_to_weapon']) <= $_POST['pp_to_spend'])
{
	$player = getShipByName($_POST['name'], $_SESSION['arena']);
	if ($player)
		$player->addToShield($_POST['pp_shield']);
	$_SESSION['pp_set'] = true;

}
else
{
	$_SESSION['pp_set'] = false;
	$_SESSION['pp_to_speed'] = null;
	$_SESSION['pp_to_shield'] = null;
	$_SESSION['pp_to_weapon'] = null;
}
header('Location: index.php');

?>