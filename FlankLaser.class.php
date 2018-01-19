<?php

include_once('Arena.class.php');
include_once('Shoot.class.php');

trait FlankLaser {
	private $_short = 10;
	private $_medium = 20;
	private $_long = 30;

	private function _getRange($dice_roll) {
		if ($dice_roll === 6)
			return ($this->_long);
		if ($dice_roll === 5)
			return ($this->_medium);
		return ($this->_short);
	}
	
	private function _setDirection($direction)
	{
		if ($direction === "down")
			return 1;
		else
			return -1;
	}

	public function type($dice_roll, $width, $height, $position_x, $position_y, $arena, $direction_string) {
		$range = $this->_getRange($dice_roll);
		$direction = $this->_setDirection($direction_string);
		$pos_y = ($direction > 0) ? $position_y + ($direction * $height) : $position_y + ($direction * $range);
		
		$arena->addOnScreen(new Shoot($position_x, $pos_y, $width, $range));
		
		foreach ($arena->getOnScreens() as $k => $elem) {
			if ($elem->getName() == "shoot") {
				$shoot_key = $k;
				$shoot_width = $elem->getWidth();
				$shoot_height = $elem->getHeight();
				$shoot_pos_x = $elem->getPositionX();
				$shoot_pos_y = $elem->getPositionY();
			}
		}

		$i = 0;
		while ($i < $shoot_width)
		{
			$j = 0;
			while ($j < $shoot_height)
			{
				foreach ($arena->getOnScreens() as $elem) {
					if ($elem instanceof ScoutOfHorror && $elem->isOccupying($shoot_pos_x + $i, $shoot_pos_y + $j)) {
						$tab[$elem->getName()][who] = $elem;
						$tab[$elem->getName()][nb_shot]++;
					}
				}
				$j++;
			}
			$i++;
		}
		if ($tab) {
			return $tab;
		}
		return NULL;
	}
}