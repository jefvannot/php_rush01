<?php

include_once('Ship.class.php');
include_once ('FlankLaser.class.php');

class Shoot extends Ship {

	public function __construct($x, $y, $width, $height) {
		parent::__construct( array ( 'name' => 'shoot'
									, 'x' => $x
									, 'y' => $y
									, 'width' => $width
									, 'height' => $height
									, 'max_shell' => 42000
									, 'shield' => 42
									, 'pp' => 0
									, 'speed' => 0
									, 'agility' => 0));
	}

	public function fight(array $kwargs) {
		error_log("shoot");
	}
	
	public function __toString() {
		return "Shoot" . parent::__toString();
	}
}

?>