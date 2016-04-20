<?php
//  How to check a variable to see if it can be called
//  as a function.

//
//  Simple variable containing a function
//

/*function someFunction() 
{
}

$functionVariable = 'someFunction';

var_dump(is_callable($functionVariable, false, $callable_name));  // bool(true)

echo '<br />',$callable_name, "<br />";  // someFunction

//
//  Array containing a method
//

class someClass {

  public function somePublicMethod() 
  {
  }
  private function somePrivateMethod() 
  {
  }

}

$anObject = new someClass();

$methodVariable = array($anObject, 'someMethod');

var_dump(is_callable($methodVariable, false, $callable_name));  //  bool(true)

echo '<br />',$callable_name, "<br />";  //  someClass::someMethod
echo '<hr/>';
$methodVariable = array($anObject, 'somePublicMethod');

var_dump(is_callable($methodVariable, false, $callable_name));  //  bool(true)

echo '<br />',$callable_name, "<br />";  //  someClass::somePublicMethod
echo '<hr/>';
$methodVariable = array($anObject, 'somePrivateMethod');

var_dump(is_callable($methodVariable, false, $callable_name));  //  bool(false)

echo '<br />',$callable_name, "<br />";  //  someClass::somePrivateMethod

echo '<hr />';
$methodVariable = array($anObject, 'somePrivateMethod');

var_dump(is_callable($methodVariable, true, $callable_name));  //  bool(true)

echo '<br />',$callable_name, "<br />";  //  someClass::somePrivateMethod*/

$code = mt_rand(100000,999999);
echo $code;
?>