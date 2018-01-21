<?php

function getShipByName($name, $arena) {
	foreach ( $arena->getOnScreens() as $current ) {
		if ( $name === $current->getName() ) {
			return $current;
		}
	}
	return null;
}

function getArrayShipByPlayer($player, $arena) {
	foreach ( $arena->getOnScreens() as $current ) {
		if ( $player === $current->getTeam() ) {
			return $current;
		}
	}
	return null;
}


?>
