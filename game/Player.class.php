<?php

class Player {

	protected $id;
	protected $name;
	protected $team;
	protected $color;

	public function __construct($id, $name, $team, $color) {
		if ( !isset( $id )
				|| !isset( $name )
				|| !isset( $team )
				|| !isset( $color ) ) {
			$errmsg = get_class($this) . " error: incorrect parameters to constructor";
			throw new Exception($errmsg);
			//error_log($errmsg . PHP_EOL); exit(1);
		}
		$this->id = $id;
		$this->name = $name;
		$this->team = $team;
		$this->color = $color;
	}

	public function getId()		{return $this->id;}
	public function getName()		{return $this->name;}
	public function getTeam()		{return $this->team;}
	public function getColor()		{return $this->color;}
}

?>
