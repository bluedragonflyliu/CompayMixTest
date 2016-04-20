<?php
$func = function() {
  echo 'func called';
};
var_dump($func); //class Closure#1 (0) { }
echo '<br>';
$reflect =new ReflectionClass('Closure');
var_dump(
  $reflect->isInterface(), //false
  $reflect->isFinal(), //true
  $reflect->isInternal() //true

);

?>