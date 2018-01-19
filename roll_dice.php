<?php

@session_start();

if ($_POST['action'] == 'move')
	$_SESSION['speed_dice'] = mt_rand(1, 6);

if ($_POST['action'] == 'shoot')
	$_SESSION['weapon_dice'] = mt_rand(1, 6);

header('Location: index.php');

?>