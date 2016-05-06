<?php
class Demo{
	private $height = 0;
	private $weight = 0;
	private $nickname = '';
	public function __construct(string $nickname){
		$this->nickname = $nickname;
	}

	public function init(){
		$this->height = 162;
		$this->weight = 68;
	}

	public function getProp(){
		echo $this->nickname."'s height is ".$this->height.' and weight is '.$this->weight;
	}
}
?>