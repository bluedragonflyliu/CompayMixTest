<?php 
if ($argc < 2 ) {
	print "$argv[0]: function/method, class1.php [,...classN.php]<br />";
	exit;
}
$function = $argv[1];
foreach (array_slice($argv, 2) as $filename) {
	include_once $filename;
}

try {
	if(strpos($function, '::')) {
		list($class, $method) = explode('::', $function);
		$reflect = new ReflectionMethod($class, $method);

	} else {
		$reflect = new ReflectionFunction($function);
	}
	$file = $reflect->getFileName();
	$line = $reflect->getStartLine();
	printf("%s|%s|%d\n", "$function()", $file, $line);
} catch (ReflectionException $e) {
	printf("%s not fount .\n", "$function()");
}
?>