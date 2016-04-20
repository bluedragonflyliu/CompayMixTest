<?php 

try{
    @$file = fopen("2016-01-18error.log",'r');
    if(!$file){
        throw new Exception("文件打开异常");    
    }
    echo 'try';
}catch(Exception $e){
	echo 'catch';
}


?>