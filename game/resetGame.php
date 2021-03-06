<?php

include_once('Arena.class.php');
include_once('ScoutOfHorror.class.php');
include_once('Obstacle.class.php');

@session_start();

function resetGame() {
	$arena = new Arena();

	$a = $arena->addOnScreen( new ScoutOfHorror(0, 0, 'a') );
	$b = $arena->addOnScreen( new ScoutOfHorror($arena->getWidth() - 4, $arena->getHeight() - 2, 'b') );

	// space invader 1
	$arena->addOnScreen( new Obstacle(40, 30, 1, 1) );
	$arena->addOnScreen( new Obstacle(46, 30, 1, 1) );
	$arena->addOnScreen( new Obstacle(41, 31, 1, 1) );
	$arena->addOnScreen( new Obstacle(45, 31, 1, 1) );
	$arena->addOnScreen( new Obstacle(40, 32, 7, 1) );
	$arena->addOnScreen( new Obstacle(39, 33, 2, 1) );
	$arena->addOnScreen( new Obstacle(42, 33, 3, 1) );
	$arena->addOnScreen( new Obstacle(46, 33, 2, 1) );
	$arena->addOnScreen( new Obstacle(38, 34, 11, 1) );
	$arena->addOnScreen( new Obstacle(38, 35, 1, 1) );
	$arena->addOnScreen( new Obstacle(40, 35, 7, 1) );
	$arena->addOnScreen( new Obstacle(48, 35, 1, 1) );
	$arena->addOnScreen( new Obstacle(38, 36, 1, 1) );
	$arena->addOnScreen( new Obstacle(40, 36, 1, 1) );
	$arena->addOnScreen( new Obstacle(46, 36, 1, 1) );
	$arena->addOnScreen( new Obstacle(48, 36, 1, 1) );
	$arena->addOnScreen( new Obstacle(41, 37, 2, 1) );
	$arena->addOnScreen( new Obstacle(44, 37, 2, 1) );

	// space invader 2
	$arena->addOnScreen( new Obstacle(102, 42, 1, 1) );
	$arena->addOnScreen( new Obstacle(108, 42, 1, 1) );
	$arena->addOnScreen( new Obstacle(100, 43, 1, 1) );
	$arena->addOnScreen( new Obstacle(103, 43, 5, 1) );
	$arena->addOnScreen( new Obstacle(110, 43, 1, 1) );
	$arena->addOnScreen( new Obstacle(100, 44, 1, 1) );
	$arena->addOnScreen( new Obstacle(102, 44, 7, 1) );
	$arena->addOnScreen( new Obstacle(110, 44, 1, 1) );
	$arena->addOnScreen( new Obstacle(100, 45, 3, 1) );
	$arena->addOnScreen( new Obstacle(104, 45, 3, 1) );
	$arena->addOnScreen( new Obstacle(108, 45, 3, 1) );
	$arena->addOnScreen( new Obstacle(100, 46, 11, 1) );
	$arena->addOnScreen( new Obstacle(101, 47, 9, 1) );
	$arena->addOnScreen( new Obstacle(102, 48, 1, 1) );
	$arena->addOnScreen( new Obstacle(108, 48, 1, 1) );
	$arena->addOnScreen( new Obstacle(101, 49, 1, 1) );
	$arena->addOnScreen( new Obstacle(109, 49, 1, 1) );

	// space invader 3
	$arena->addOnScreen( new Obstacle(53, 70, 2, 1) );
	$arena->addOnScreen( new Obstacle(51, 71, 6, 1) );
	$arena->addOnScreen( new Obstacle(50, 72, 8, 1) );
	$arena->addOnScreen( new Obstacle(50, 73, 2, 1) );
	$arena->addOnScreen( new Obstacle(53, 73, 2, 1) );
	$arena->addOnScreen( new Obstacle(56, 73, 2, 1) );
	$arena->addOnScreen( new Obstacle(50, 74, 8, 1) );
	$arena->addOnScreen( new Obstacle(52, 75, 4, 1) );
	$arena->addOnScreen( new Obstacle(51, 76, 1, 1) );
	$arena->addOnScreen( new Obstacle(53, 76, 2, 1) );
	$arena->addOnScreen( new Obstacle(56, 76, 1, 1) );
	$arena->addOnScreen( new Obstacle(50, 77, 1, 1) );
	$arena->addOnScreen( new Obstacle(57, 77, 1, 1) );



	$db_path = 'db/games';
	if (!file_exists('db'))
		mkdir("db");
	if (!file_exists($db_path))
		file_put_contents($db_path, null);
	$db = unserialize(file_get_contents($db_path));

	if (!$db || !in_array($_GET['id'], array_column($db, 'id')))
	{
		// echo "test B<br>";
		echo "test B<br>";
		$fp = fopen($db_path, "w");
		flock($fp, LOCK_EX);

		$game['id'] = $_GET['id'];
		$game['name'] = "name";

		$game['creator'] = $_SESSION['logged_on_user'];

		$game['ship']['a'] = $a;
		$game['ship']['b'] = $b;

		$game['up_to'] = (mt_rand(1, 2) == 1) ? "a" : "b";
		$game['arena'] = $arena;

		$game['shot_has_been_fired'] = "";
		$game['speed_dice'] = null;
		$game['weapon_dice'] = null;
		$game['pp_set'] = false;
		$game['pp_to_speed'] = null;
		$game['pp_to_shield'] = null;
		$game['pp_to_weapon'] = null;
		
		$db[] = $game;
		file_put_contents($db_path, serialize($db));
		fclose($fp);

	}
}

?>