<?php
$f = function(){
    return 100;
};

function testClosure(Closure $callback){
    return $callback();
}

$a = testClosure($f);
print_r($a);exit;