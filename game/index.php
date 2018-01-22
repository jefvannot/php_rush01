<?php

include_once('Arena.class.php');
include_once('ScoutOfHorror.class.php');
include_once('Obstacle.class.php');
include_once('resetGame.php');
include_once('getShipByName.php');

@session_start();

// include_once('resetGame.php');
// resetGame();
// header('Location: index.php');

if (!isset($_SESSION['arena'])) {
	resetGame();
	$_SESSION['up_to'] = (mt_rand(1, 2) == 1) ? "a" : "b";
}

if ($_SESSION['up_to'] == "")
	$_SESSION['up_to'] = (mt_rand(1, 2) == 1) ? "a" : "b";

if ($_SESSION['speed_dice'] == "played"
	&& $_SESSION['weapon_dice'] == "played"
	&& $_SESSION['pp_to_speed'] == 0
	&& $_SESSION['pp_to_weapon'] == 0)
{
	$_SESSION['up_to'] = ($_SESSION['up_to'] == "a") ? "b" : "a";
	$_SESSION['speed_dice'] = null;
	$_SESSION['weapon_dice'] = null;
	$_SESSION['pp_to_speed'] = null;
	$_SESSION['pp_to_shield'] = null;
	$_SESSION['pp_to_weapon'] = null;
	$_SESSION['pp_set'] = false;
}

function getElemOnMap($x, $y, $arena) {
	$who = null;
	foreach ($arena->getOnScreens() as $elem) {
		if ($elem->isOccupying($x, $y)) {
			$who .= $elem->getName()." ";
		}
	}
	if ($who !== null)
		return $who;
	return "empty";
}

function getPPToSpend($name, $arena) {
	$ship = getShipByName($name, $arena);
	if (isset($ship)) {
		return $ship->getPP();
	}
	return NULL;
}

function printHealthStats($name, $arena) {
	$ship = getShipByName($name, $arena);
	if ($ship) {
		echo $ship->getShell();
	} else {
		echo "Ship is dead!";
	}
}

function printShieldStats($name, $arena) {
	$ship = getShipByName($name, $arena);
	if ($ship) {
		echo $ship->getShield();
	} else {
		echo "No shield on ship " . $name . ".";
	}
}

$a_died = (!getShipByName("a", $_SESSION['arena'])) ? true : false;
$b_died = (!getShipByName("b", $_SESSION['arena'])) ? true : false;


$home_path = "../";
include('../partial/header.php');

?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/all.css"></head>
	<link rel="stylesheet" type="text/css" href="css/game.css"></head>
</head>
<body>
	<div class="content">


		<div class="flex-center">
			<div class='flex-center'>
				<?php $player = 'a'; include('partial/move_form.php'); ?>
			</div>

			<div class='flex-center map'>
				<?php include('partial/map.php'); ?>
			</div>

			<div class="flex-center floor">
				<?php include('partial/floor.php'); ?>
			</div>
			<div class='flex-center'>
					<?php $player = 'b'; include('partial/move_form.php'); ?>
				</div>
		</div>



		<?php 
		if ($a_died) {
			echo "<div class='game-over flex-center'><h1>B WINS</h1></div>";
		}
		else if ($b_died) {
			echo "<div class='game-over flex-center'><h1>A WINS</h1></div>";
		}
		else {
		}
		?>
		<div class="flex-center">
			<form action="reset.php" method="POST">
				<input name="reset" value="reset game" type="submit" />
			</form>
		</div>
		<a href="../index.php" title="">Revenir au lobby</a>
	</div>
</body>
</html>

<?php
if ($_SESSION['shot_has_been_fired'] == "ON") {
	$_SESSION['arena']->cleanShoot();
	$_SESSION['shot_has_been_fired'] = "";
	// header('Location: index.php');
} 
?>
