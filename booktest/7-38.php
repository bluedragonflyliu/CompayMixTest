<?php
	class LogFile {
		protected $filename;
		protected $handle;

		public function __construct($filename) {
			$this->filename = $filename;
			$this->open();
		}

		private function open () {
			$this->handle =fopen($this->filename,'a');
		}

		public function __destruct() {
			echo 'aaa';
			fclose($this->handle);
		}

		public function __sleep () {
			return array('filename');
		}

		public function __wakeup() {
			$this->open();
		}
	}
	$logfile=new LogFile('./tmp/file.txt');
	$serialized = serialize($logfile);
	$fp= fopen('./tmp/7-38.txt','a');
	fwrite($fp, $serialized);
	fclose($fp);