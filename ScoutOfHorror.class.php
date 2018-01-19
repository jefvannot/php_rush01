<?php

include_once('Ship.class.php');
include_once ('FlankLaser.class.php');

class ScoutOfHorror extends Ship {

	use FlankLaser;

	public function __construct($x, $y, $name) {
		parent::__construct( array ( 'name' => $name
									, 'x' => $x
									, 'y' => $y
									, 'width' => 4
									, 'height' => 2
									, 'max_shell' => 10
									, 'shield' => 5
									, 'pp' => 5
									, 'speed' => 15
									, 'agility' => 4));
	}

	public function fight(array $kwargs) {
		$tab = $this->type(
			$kwargs['dice_roll'],
			$kwargs['width'],
			$kwargs['height'],
			$kwargs['position_x'],
			$kwargs['position_y'],
			$kwargs['arena'],
			$kwargs['direction']);
		if ($tab === NULL)
			error_log("ship that was shot was null (fight function, ScoutOfHorror.class.php)");
		else {
			foreach ($tab as $k => $v) {
				($v[who])->shipIsShot($v[nb_shot], $kwargs['arena']);
			}
		}
	}
	
	public function __toString() {
		return "ScoutOfHorror" . parent::__toString();
	}
}

?>