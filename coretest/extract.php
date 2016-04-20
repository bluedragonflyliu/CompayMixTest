<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php 
		/* 假定 $var_array 是 wddx_deserialize 返回的数组*/
		$a= 'zhangsan';
		require_once('./one.php');
		$size  =  "large" ;
		 $var_array  = array( "color"  =>  "blue" ,
		                    "size"   =>  "medium" ,
		                    "shape"  =>  "sphere" );
		 extract ( $var_array ,  EXTR_PREFIX_SAME ,  "wddx" );
		 
		// echo  " $color ,  $size ,  $shape ,  $wddx_size \n" ;
	?>
</body>
</html>