<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>number_format</title>
</head>
<body>
	<?php 
	echo '<pre>';
	$aa = number_format(12345.56,2,'点','千');
	echo $aa."<br />";

	$number = 12345.678;
	list($int, $dec) = explode('.', $number);
	echo $int.'<br />';
	echo $dec.'<br />';

	//中文
	/*setlocale(LC_ALL, 'zh_CN');
	//setlocale(LC_MONETARY, 'zh_CN');
	
	
	$lang = localeconv();
	var_dump($lang);
	$str = iconv('GBK','utf-8',$lang['currency_symbol']);
	print money_format('%n', $number);*/

	setlocale(LC_ALL, 'en');
	var_dump(localeconv());
	setlocale(LC_MONETARY, 'en_US');
	print money_format('%n', $number);
?>
</body>
</html>
