<?php
interface process{
	public function process();
}
class playerencode implements process{
	public function process(){
		echo "encode<br/>";
	}
}

class playeroutput implements process{
	public function process(){
		echo "output<br/>";
	}
}
class playProcess{
	private $message = null;
	public function __construct(){
	}
	public function callback(event $event){
		$this->message=$event->click();
		if($this->message instanceof process){
			$this->message->process();
		}
	}
}

class mp4{
	public function work(){
		$playProcess = new playProcess();
		$playProcess->callback(new event('encode'));
		$playProcess->callback(new event('output'));
	}
}
class event{
	private $m;

	public function __construct($me){
		$this->m = $me;
	}

	public function click(){
		switch ($this->m) {
			case 'encode':
				return new playerencode();
				break;
			case 'output':
				return new playeroutput();
				break;
			
		}
	}
}
$mp4 = new mp4;
$mp4->work();
?>