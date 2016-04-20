<?php
class Lang
{
  private $name = 'php';
}
$closure = function () {
  return $this->name;
};
$bind_closure = Closure::bind($closure, new Lang(), 'Lang');
echo $bind_closure(); //php
echo '<br /><pre>';
var_dump($bind_closure);

$f = function () {
    return 100;
};

function testClosure(Closure $callback)
{
    return $callback();
}

$a = testClosure($f);
print_r($a);

echo '<hr />';

class A {

    public $base = 100;

}

class B {

    private $base = 1000;
}

$f = function () {
    return $this->base + 3;
};


$a = Closure::bind($f, new A);
print_r($a());

echo PHP_EOL;

$b = Closure::bind($f, new B , 'B');
print_r($b());

echo PHP_EOL;