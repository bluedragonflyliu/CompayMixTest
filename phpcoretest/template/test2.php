<?php
$string  =  'The quick brown fox jumped over the lazy dog.' ;
echo $string.'<br/><pre>';

 $patterns  = array();
 $patterns [ 0 ] =  '/quick/' ;
 $patterns [ 1 ] =  '/brown/' ;
 $patterns [ 2 ] =  '/fox/' ;
 $replacements  = array();
 $replacements [ 2 ] =  'bear' ;
 $replacements [ 1 ] =  'black' ;
 $replacements [ 0 ] =  'slow' ;
 var_dump($patterns);
var_dump($replacements);
ksort($replacements);
var_dump($replacements);
echo  preg_replace ( $patterns ,  $replacements ,  $string );
?>