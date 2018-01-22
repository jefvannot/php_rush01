<?php

class Team {

	protected $name;
	protected $team;
	protected $color;

	public function __construct($name, $team, $color) {
		if ( !isset( $name ) 
				|| !isset( $team )
				|| !isset( $color ) ) {
			$errmsg = get_class($this) . " error: incorrect parameters to constructor";
			throw new Exception($errmsg);
			//error_log($errmsg . PHP_EOL); exit(1);
		}
		$this->name = $name;
		$this->team = $team;
		$this->color = $color;
	}

	public function getName()		{return $this->name;}
	public function getTeam()		{return $this->team;}
	public function getColor()		{return $this->color;}
}

?>
