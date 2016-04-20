<?php
/*$clean = false;
function shutdown_func(){
global $clean;
if (!$clean){
die("not a clean shutdown");
}
return false;
}
register_shutdown_function("shutdown_func");

$a = 1;
$a = new FooClass(); // 将因为致命错误而失败
shutdown_func();
$clean = true;*/
/*$bb=get_include_path();
echo '<hr/>',PATH_SEPARATOR,'<hr />';
echo '<pre>';
var_dump($bb);*/



/*function pretty_print_json($json) {
    $result = '';
    $tab = 0;
    $length = strlen($json);
    $indent = isset($indent) ? $indent : '    ';
    $new_line = "\n";
    $prev_char = '';
    $out_of_quotes = true;
      
    for ($i = 0; $i <= $length; $i++) {
        $char = substr($json, $i, 1);
      
        if ($char == '"' && $prev_char != '\\') {
            $out_of_quotes = !$out_of_quotes;
        } else if (($char == '}' || $char == ']') && $out_of_quotes) {
            $result .= $new_line;
            $tab--;

            for ($j = 0; $j < $tab; $j++) {
                $result .= $indent;
            }
        }
        $result .= $char;
              
        if (($char == ',' || $char == '{' || $char == '[') && $out_of_quotes) {
            $result .= $new_line;
            if ($char == '{' || $char == '[') {
                $tab++;
            }  
      
            for ($j = 0; $j < $tab; $j++) {
                $result .= $indent;
            }
        }
        	
        $prev_char = $char;
    }
    
	return $result;
}

$arr = array('name'=>'zhangsan','age'=>30,'addr'=>array('county'=>'china','province'=>'Hebei','city'=>'Tangshan'));
$bb = json_encode($arr);
echo $bb;
echo '<hr />';
echo (pretty_print_json($bb));*/

$string  =  'cup' ;
 $name  =  'coffee' ;
 $str  =  'This is a $string with my $name in it.' ;
echo  $str .  "\n" ;
echo '<hr/>';
eval( "\$mystr = \" $str \";" );
echo  $mystr .  "\n" ;
echo '<hr/>';
echo  $str;
?>