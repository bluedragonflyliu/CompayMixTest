<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>这是一个测试</h1>
	{$data},{$person}
	<br/>
	<ul>
		
	</ul>
	<?php 
		echo $pai*2;
	?>
	{if $data =='abc'}
		我是abc<br/>
	{elseif $data =='def'}
		我是def<br/>
	{else}
		我就是我，{$data}<br/>
	{/if}
	{#这是注释部分#}
	1213234-------------
</body>
</html>