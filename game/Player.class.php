<?php

abstract class Player {

	protected $name;
	protected $team;
	protected $color;

	public function __construct( array $kwargs ) {
		if ( !isset( $kwargs['name'] ) 
				|| !isset( $kwargs['team'] )
				|| !isset( $kwargs['color'] ) ) {
			error_log("OnScreen error: incorrect parameters to constructor"
						. PHP_EOL );
			exit(1);
		}
		$this->name = $kwargs['name'];
		$this->team = $kwargs['team'];
		$this->color = $kwargs['color'];
	}

	public function getName()		{return $this->name;}
	public function getTeam()		{return $this->team;}
	public function getColor()		{return $this->color;}
}

?>
