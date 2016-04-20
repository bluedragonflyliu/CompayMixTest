<?php 
	interface mobile
	{
		public function run();
	}
	class plane implements mobile
	{
		public function run()
		{
			echo "this is plane";
		}

		public function fly()
		{
			echo "airplane";
		}
	}

	class car implements mobile
	{
		public function run()
		{
			echo "this is car<br/>";
		}
	}

	class machine
	{
		function demo(mobile $a)
		{
			$a->fly();
		}
	}
	$obj = new machine();
	$obj ->demo(new plane());
	$obj ->demo(new car());

?>