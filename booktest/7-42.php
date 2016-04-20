<?php 
if($argc <2) {
	print "$argv[0]: classes1.php [,...]\n";
	exit;
}
foreach (array_slice($argv, 1) as $filename) {
	include_once $filename;
}

$methods = array();
foreach (get_declared_classes() as $class) {
	$r = new ReflectionClass($class);
	if ($r->isUserDefined()) {
		foreach ($r->getMethods() as $method) {
			if ($method->getDeclaringClass()->getName() == $class) {
				$signature = "$class::".$method->getName();
				$methods[$signature] = $method;
			}
		}
	}
}
$function = array();
$defined_functions = get_defined_functions();
foreach ($defined_functions['user'] as $function) {
	$functions[$function] = new ReflectionFunction($function);
}

function sort_methods($a, $b) {
	list($a_class, $a_method) = explode('::', $a);
	list($b_class, $b_method) = explode('::', $b);

	if ($cmp = strcasecmp($a_class, $b_class)) {
		return $cmp;
	}
	return strcasecmp($a_method, $b_method);
}
uksort($methods, 'sort_methods');

unset($functions['sort_methods']);
ksort($functions);

foreach(array_merge($functions, $methods) as $name => $reflect) {
	$file = $reflect->getFileName();
	$line = $reflect->getStartLine();

	printf("%-255| %-40s | %6d\n", "$name()", $file, $line);
}