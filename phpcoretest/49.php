<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>工厂模式</title>
</head>
<body>
	<?php 
		class cook{
			public function meal(){
				echo '蒜蓉西蓝花<br/>';
			}
			public function drink(){
				echo '西红柿疙瘩汤<br />';
			}
			public function ok(){
				echo '完毕<br />';
			}

		}

		interface Command{
			public function execute();
		}
		class MealCommand implements Command{
			private $cook;
			public function __construct(cook $cook){
				$this->cook = $cook;
			}
			public function execute(){
				$this->cook->meal();
			}
		}
		class DrinkCommand implements Command{
			private $cook;
			public function __construct(cook $cook){
				$this->cook = $cook;
			}
			public function execute(){
				$this->cook->drink();
			}
		}
		class cookControl{
			private $mealcommand;
			private $drinkcommand;

			public function addCommond(Command $mealcommand, Command $drinkcommand){
				$this->mealcommand = $mealcommand;
				$this->drinkcommand = $drinkcommand;
			}
			public function callmeal(){
				$this->mealcommand->execute();
			}
			public function calldrink(){
				$this->drinkcommand->execute();
			}
		}
		$control = new cookControl;
		$cook = new cook;
		$mealcommand = new MealCommand($cook);
		$drinkcommand = new DrinkCommand($cook);

		$control->addCommond($mealcommand,$drinkcommand);
		$control->callmeal();
		$control->calldrink();
	?>
</body>
</html>