	<?php 
	$choices = array('eggs'=>'Eggs Benedict', 'toast'=>'Buttered Toast with Jam','coffee'=> 'piping Hot Coffee');
	if(array_intersect($_POST['food'],array_keys($choices)) !=$_POST['food']){
		echo 'You must select only valid choices.';
	} else {
		
	}
	?>