<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>这是一个测试</h1>
	<?php echo $this->value['data']; ?>,<?php echo $this->value['person']; ?>
	<br/>
	<ul>
		
	</ul>
	<?php 
		echo $pai*2;
	?>
	<?php if( $data =='abc'){?>
		我是abc<br/>
	<?php }else if( $data =='def'){?>
		我是def<br/>
	<?php }else{?>
		我就是我，<?php echo $this->value['data']; ?><br/>
	<?php } ?>
	
	1213234-------------
</body>
</html>