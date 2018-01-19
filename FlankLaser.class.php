<?php


include_once('Arena.class.php');
include_once('Shoot.class.php');

trait FlankLaser {

#Order decides number of charges [i.e number of times the dice is rolled]
#diceRoll decides range

	private $_short = 10;
	private $_medium = 20;
	private $_long = 30;

	#General for all weapons
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

	#Specific for this one
	public function type($dice_roll, $width, $height, $position_x, $position_y, $arena, $direction_string) {
		$range = $this->_getRange($dice_roll);
		$direction = $this->_setDirection($direction_string);
		$ypoint = $direction;
		$xpoint = 0;

// echo $direction;
// echo "<br>";

		// $direction_x = $this->_set_direction($direction_string);
		// $pos_x = $position_x;
		// $pos_y = $position_y;
// echo $width;
// echo $height;
// echo "<br>";
// echo "test";
// echo "<br>";
// 		echo $dice_roll;
// echo "<br>";
// 		echo $range;
		$pos_y = ($direction > 0) ? $position_y + ($direction * $height) : $position_y + ($direction * $range);

// echo "truc";
// echo "<br>";

		$arena->addOnScreen(new Shoot($position_x, $pos_y, $width, $range));
// echo "arena";
// echo "<br>";
		// sleep(3);
		// $arena->destroyShip($truc);

		// echo $arena;
		// echo "<br>";
		// echo "<br>";
		// echo "<br>";
		// print_r($arena->getOnScreens());
		// echo "<br>";

		// foreach ($arena->getOnScreens() as $k => $elem) {
		// 	echo $elem;
		// 	echo "<br>";
		// // 	// if ($elem->getName() == "shoot") {
		// // 	// 	echo "truc";
		// // 	// }
		// }
		// echo "<br>";

		foreach ($arena->getOnScreens() as $k => $elem) {
			if ($elem->getName() == "shoot") {
				$shoot_key = $k;
				$shoot_width = $elem->getWidth();
				$shoot_height = $elem->getHeight();
				$shoot_pos_x = $elem->getPositionX();
				$shoot_pos_y = $elem->getPositionY();
			}
		}
		// echo ($arena->getOnScreens())[$shoot_key];
		// echo "<br>";
		// echo $shoot_width;
		// echo "<br>";
		// echo $shoot_height;
		// echo "<br>";
		// echo $shoot_pos_x;
		// echo "<br>";
		// echo $shoot_pos_y;
		// echo "<br>";


		// if (($k = array_search("shoot", $arena->getOnScreens())) !== false){	
		// 	echo ($arena->getOnScreens())[$k];
		// 	echo "<br>";
		// }
		// foreach ($arena->getOnScreens() as $elem) {
		// 	if ($elem->isOccupying($x, $y) && $elem instanceof Ship) {
		// 		echo $elem;
		// 		echo "<br>";
		// 	}
		// }

		$i = 0;
		// $j = 0;
		while ($i < $shoot_width)
		{
			$j = 0;
			while ($j < $shoot_height)
			{
				foreach ($arena->getOnScreens() as $elem) {
					if ($elem instanceof ScoutOfHorror && $elem->isOccupying($shoot_pos_x + $i, $shoot_pos_y + $j)) {
						// echo "PAF = ";
						// echo $elem->getName();
						$tab[$elem->getName()][who] = $elem;
						$tab[$elem->getName()][nb_shot]++;
						// $count++;
						// echo "<br>";
					}
				}
				$j++;
			}
			$i++;
		}
		// echo $count;
		// $tab['count'] = $count;
		// print_r($tab);
		if ($tab)
		{
			// print_r($tab);
			return $tab;
		}
		return NULL;

		// while (abs($ypoint) <= $range) 
		// {
		// 	$spray = $width + abs($ypoint) - 1;
		// 	$xpoint = 0 - abs($ypoint) - 1;
		// 	while ($xpoint < $spray)
		// 	{
		// 		$content = $arena->getTileContents($position_x + $xpoint, $position_y + $ypoint);
		// 		if ($content !== NULL && $content->name != $this->name)
		// 			return ($arena->getTileContents($position_x + $xpoint, $position_y + $ypoint));
		// 		$xpoint++;
		// 	}
		// 	$ypoint += $direction;
		// }
		// return NULL;
	}
}