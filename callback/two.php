<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php 
		function fun($msg1,$msg2){
	    	echo $msg1;
	    	echo '<br>';
	   		echo $msg2;
	   }
 
   		//call_user_func_array("fun", array('aseoe', '爱思资源网'));



   		class Demo{
		    static function fun($msg1,$msg2){
			    echo $msg1;
			    echo $msg2;
		    }
	   }
 
	   class Test{
		   function fun($msg1,$msg2){
			   echo $msg1;
			   echo $msg2;
			}
	   }
 
   call_user_func_array(array("Demo",'fun'), array('Aseoe', '前端开发'));
 	echo "<hr/>";
   call_user_func_array(array(new Test(), 'fun'), array('Ancto', 'CTO'));

	?>
</body>
</html>