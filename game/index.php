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

$file_path = 'db/games';
if (!file_exists('db'))
	mkdir("db");
if (!file_exists($file_path))
	file_put_contents($file_path, null);
$db = unserialize(file_get_contents($file_path));
$arena = $db[$_GET['id']]['arena'];
$game = $db[$_GET['id']];

// echo $db[$_GET['id']]['player_a'];
// echo $db[$_GET['id']]['creator'];

if (!$db || !$arena) {
	// echo "bra";
	resetGame();
	$db = unserialize(file_get_contents($file_path));
	$arena = $db[$_GET['id']]['arena'];
	// $_SESSION['up_to'] = (mt_rand(1, 2) == 1) ? "a" : "b";
}

// print_r($_SESSION);

// if ($db[$_GET['id']]['up_to'] == "")
	// $db[$_GET['id']]['up_to'] = (mt_rand(1, 2) == 1) ? "a" : "b";

if ($db[$_GET['id']]['speed_dice'] == "played"
	&& $db[$_GET['id']]['weapon_dice'] == "played"
	&& $db[$_GET['id']]['pp_to_speed'] == 0
	&& $db[$_GET['id']]['pp_to_weapon'] == 0)
{

	$fp = fopen($db_path, "w");
	flock($fp, LOCK_EX);
	// $db[$_POST['game_id']]['arena'] = $arena;

	$db[$_GET['id']]['up_to'] = ($db[$_GET['id']]['up_to'] == "a") ? "b" : "a";
	$db[$_GET['id']]['speed_dice'] = null;
	$db[$_GET['id']]['weapon_dice'] = null;
	$db[$_GET['id']]['pp_to_speed'] = null;
	$db[$_GET['id']]['pp_to_shield'] = null;
	$db[$_GET['id']]['pp_to_weapon'] = null;
	$db[$_GET['id']]['pp_set'] = false;

	file_put_contents($file_path, serialize($db));
	fclose($fp);
}



// print_r($_GET);



		// $fp = fopen($file_path, "w");
		// flock($fp, LOCK_EX);
		// $tmp['login'] = $_SESSION['logged_on_user'];
		// $tmp['time'] = time();
		// $tmp['msg'] = $_POST['msg'];
		// $db[] = $tmp;
		// file_put_contents($file_path, serialize($game));
		// fclose($fp);


function getElemOnMap($x, $y, $arena) {
	// $db = unserialize(file_get_contents($file_path));



	foreach ($arena->getOnScreens() as $elem) {
		if ($elem->isOccupying($x, $y)) {
			$who .= $elem->getName()." ";
		}
	}
	if ($who)
		return $who;
	return "empty";
}

function getPPToSpend($name, $arena) {
	$ship = getShipByName($name, $arena);
	if ($ship) {
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
// echo "dfs";

// $a_died = (!getShipByName("a", $arena)) ? true : false;
// $b_died = (!getShipByName("b", $arena)) ? true : false;


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

		<a href="../index.php" style="margin-left: 50px;"> 🔙 Revenir au lobby</a>

		<div class="board">
			<div class='flex-center'>
				<?php 
					$player = ($db[$_GET['id']][creator] == $_SESSION[logged_on_user]) ? 'a' : 'b'; 
					include('partial/move_form.php');
				?>
			</div>

			<div class='map'>
				<?php include('partial/map.php'); ?>
			</div>

			<div class="flex-center floor">
				<?php include('partial/floor.php'); ?>
			</div>
			<!-- <div class='flex-center'> -->
				<!-- <?php $player #= 'b'; #include('partial/move_form.php'); ?> -->
			<!-- </div> -->
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
<!-- 		<div class="flex-center">
			<form action="reset.php" method="POST">
				<input name="reset" value="reset game" type="submit" />
			</form>
		</div> -->
	</div>
</body>
</html>

<?php
// if ($_SESSION['shot_has_been_fired'] == "ON") {
	// ($_SESSION['arena'])->cleanShoot();

	// $db_path = 'db/games';
	// $db = unserialize(file_get_contents($db_path));
	// $arena = $db[$_POST['game_id']]['arena'];
	// $fp = fopen($db_path, "w");
	// flock($fp, LOCK_EX);
	// $db[$_POST['game_id']]['arena'] = $arena->cleanShoot();
	// file_put_contents($db_path, serialize($db));
	// fclose($fp);

	// $_SESSION['shot_has_been_fired'] = "";
	// header('Location: index.php');
// } 
?>
