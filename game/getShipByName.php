<?php

function getShipByName($name, $arena) {
	foreach ( $arena->getOnScreens() as $current ) {
		if ( $name === $current->getName() ) {
			return $current;
		}
	}
	return null;
}

function getArrayShipByPlayer($team, $arena) {
	foreach ( $arena->getOnScreens() as $current ) {
		if ( $team === $current->getTeam() ) {
			$tab[] = $current;
		}
	}
	return $tab;
}


?>
