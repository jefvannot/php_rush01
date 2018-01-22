<?php

abstract class OnScreen {

	protected $name;
	protected $position_x;
	protected $position_y;
	protected $width;
	protected $height;
	protected $team;
	protected $sprite;

	public function __construct( array $kwargs ) {
		if ( !isset( $kwargs['name'] ) 
				|| !isset( $kwargs['x'] )
				|| !isset( $kwargs['y'] )
				|| !isset( $kwargs['width'] )
				|| !isset( $kwargs['height'] )
				|| !isset( $kwargs['team'] )
				|| !isset( $kwargs['sprite'] ) ) {
			$errmsg = get_class($this) . " error: incorrect parameters to constructor";
			throw new Exception($errmsg);
			error_log($errmsg . PHP_EOL );
			/*
			error_log(get_class($this) . " error: incorrect parameters to constructor"
						. PHP_EOL );
			exit(1);*/
		}
		$this->name = $kwargs['name'];
		$this->position_x = $kwargs['x'];
		$this->position_y = $kwargs['y'];
		$this->width = $kwargs['width'];
		$this->height = $kwargs['height'];
		$this->team = $kwargs['team'];
		$this->sprite = $kwargs['sprite'];
	}
	
	public function isOccupying($x, $y) {
		return ( $x >= $this->position_x
				&& $x < $this->position_x + $this->width
				&& $y >= $this->position_y
				&& $y < $this->position_y + $this->height);
	}

	public function getName()		{return $this->name;}
	public function getPositionX()	{return $this->position_x;}
	public function getPositionY()	{return $this->position_y;}
	public function getWidth()		{return $this->width;}
	public function getHeight()		{return $this->height;}
	public function getTeam()		{return $this->team;}
	public function getSprite()		{return $this->sprite;}
}

?>
