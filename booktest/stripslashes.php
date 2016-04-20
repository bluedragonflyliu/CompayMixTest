<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php 
	 function  stripslashes_deep ( $value )
		{
	     	$value  =  is_array ( $value )?array_map ( 'stripslashes_deep' ,  $value ): stripslashes ( $value );
	    	return  $value ;
		}
		 // 范例
	 	$array  = array( "f\\'oo" ,  "b\\'ar" , array( "fo\\'o" ,  "b\\'ar" ));
		$array  =  stripslashes_deep ( $array );

		 // 输出
	 	print_r ( $array );

	 	$str = '<p><img _url=\"&lt;embed src=\" http:=\"\" static.video.qq.com=\"\" vid=\"w00183wiad8&amp;auto=0&quot;\" allowfullscreen=\"true\" quality=\"high\" allowscriptaccess=\"always\" type=\"application/x-shockwave-flash\" height=\"280\" width=\"420\"/><embed type=\"application/x-shockwave-flash\" class=\"edui-faked-video\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" src=\"http://static.video.qq.com/TPout.swf?vid=w00183wiad8&auto=0\" width=\"420\" height=\"280\" wmode=\"transparent\" play=\"true\" loop=\"false\" menu=\"false\" allowscriptaccess=\"never\" allowfullscreen=\"true\"/></p>';
	 	echo stripcslashes($str);
 ?> 
</body>
</html>