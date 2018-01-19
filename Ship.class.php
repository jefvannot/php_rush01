<?php

include_once('OnScreen.class.php');

abstract class Ship extends OnScreen {

	protected $max_shell;
	protected $shell;
	protected $default_shield;
	protected $shield;
	protected $speed;
	protected $agility;
	protected $pp;

	public function __construct(array $kwargs) {
		parent::__construct($kwargs);
		
		if (!isset($kwargs['max_shell'])
			|| !isset($kwargs['shield'])
			|| !isset($kwargs['pp']) 
			|| !isset($kwargs['speed'])
			|| !isset($kwargs['agility'])) {
			error_log("Ship error: incorrect parameters to constructor"
				. PHP_EOL );
		exit(1);
	}
	$this->max_shell = $kwargs['max_shell'];
	$this->defaultShield = $kwargs['shield'];
	$this->pp = $kwargs['pp'];
	$this->shield = $kwargs['shield'];
	$this->speed = $kwargs['speed'];
	// echo $this->shield;
	# setup for starting the game
	$this->shell = $this->max_shell;
}

	# should be called at the beginning of each turn to reset things
#	public function beginningOfTurn() {
#		$this->shield = $this->default_shield;
#	}

public abstract function fight(array $kwargs);

public function __toString() {
	return sprintf( "%s[ shell: %d ; default_shield: %d ; position (%d, %d) ]"
		, $this->name, $this->shell, $this->default_shield
		, $this->position_x, $this->position_y);
}

	# happens when a ship is hit with a shot
public function shipIsShot($nb_shot, $arena) {
		// echo "test";
	while ($nb_shot) {
		if ($this->shield == 0)
			$this->shell = $this->shell - 1;
		else
			$this->shield = $this->shield - 1;
		if ($this->shell <= 0)
		{
			$arena->destroyShip($this);
			return ;
		}
		$nb_shot--;
	}
}

public function addToShield($nb_pp_to_add) {
	$this->shield += $nb_pp_to_add;
}




public function stayInTheMap($x, $y, $arena)
{
		#check if the ship has gone out of the map
	if($this->position_x + $x < 0 
		|| $this->position_x + $x + $this->width > $arena->getWidth()
		|| $this->position_y + $y < 0 
		|| $this->position_y + $y + $this->height > $arena->getHeight())
	{
		$arena->destroyShip($this);
		return FALSE;
	}
	return TRUE;
}

public function move($x, $y, $arena) {
	$dx = round($x * $this->getSpeed());
	$dy = round($y * $this->getSpeed());
	// echo $dx."   &   ".$dy;

	if ($this->stayInTheMap($dx, $dy, $arena) == TRUE)
	{
		$i = 0;
		while ($i < $this->width)
		{

			$j = 0;
			while ($j < $this->height) {
				$res = $arena->getTileContents($this->position_x + $dx + $i, $this->position_y + $dy + $j);
				if ($res !== null && $res->name != $this->name)
					$content++;
				$j++;
			}
			$i++;
		}
		if ($content) {
			$arena->destroyShip($this);
		} else {
			$this->position_x += $dx;
			$this->position_y += $dy;
		}
	}
}

public function getShell() {		return $this->shell; }
public function getShield() {		return $this->shield; }
public function getSpeed() {		return $this->speed; }
public function getPP() {		return $this->pp; }
public function getAgility() {		return $this->agility; }
} 

?>