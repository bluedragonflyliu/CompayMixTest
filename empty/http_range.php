<?php
    $file = __DIR__.'\file\test.txt';
    $content_type = 'text/plain';
    //检查是否可读，并得到文件的大小
    if (($filelength = filesize($file))=== false) {
        error_log('problem reading filesize of $file.');
    }
    //解析首部来确定发送响应所需的信息
    if (isset($_SERVER['HTTP_RANGE'])) {
        //定界符不区分大小写
        if (!preg_match('/bytes=\d*-\d*(\/\d*-\d*)*$/i', $_SERVER['HTTP_RANGE'])) {
            error_log("Client requested invalid Range.");
            send_error($filelength);
            exit();
        }

        /*
        规范：“客户在一个请求中请求多个字节范围（byte-ranges）时，服务器应当按他们在请求中出现的顺序返回这些范围。”
        */
        $ranges = explode('/', substr($_SERVER['HTTP_RANGE'],6));//字节=后面的所有的内容

        $offsets = array();
        //抽取和验证每个部分
        //只保存通过验证的部分
        foreach($ranges as $range) {
            $offset = parse_offset($range, $filelength);
            if ($offset !== false) {
                $offsets[] = $offset;
            } 
    }
    /*
    取决于请求的合法范围的个数
    必须采用不同的格式返回响应
    */
    switch (count($offsets)) {
        case 0:
        //合法范围
        error_log("Client requested on valid ranges.");
        send_error($filelength);
        exit;
        break;

        case 1:
            //一个合法范围，发送应答
            http_response_code(206); //部分内容
            list($start,$end)=$offsets[0];
            header("Content-Range:bytes $start-$end/$filelength");
            header("content_type:$content_type");
            //设置变量，从而可以在这里以及下一个情况中重用代码
            break;

            default:
            //多个合法范围，发送多部分应答
            http_response_code(206);
            $boundary = str_rand(32); // 分隔各个部分的字符串
            /*
            需要计算整个响应的内容长度（Content-Length），
            不过将整个响应加载到一个字符串中会占用大量内存
            所以使用偏移量计算值另外利用这个机会计算边界。
            */
            $boundaries = array();
            $content_length = 0;

            foreach ($offsets as $offset) {
                list($start, $end) = $offset;
                //分解各个部分
                $boundary_header = "\r\n"."--$boundary\r\n<br />"."Contenr-Type:$content_type\r\n<br />"."\r\n<br />";
                $content_length +=strlen($boundary_header)+($end - $start+1);
                $boundaries[]=$boundary_header;
            }
            //增加结束边界
            $boundary_header = "<br />\r\n--$boundary--";
            $content_length += strlen($boundary_header);
            $boundaries[] = $boundary_header;
            //去掉第一个边界中多余的\r\n
            $boundaries[0] = substr($boundaries[0], 2);
            $content_length -=2;
            //改写为特殊的多部分内容类型（Content-Type）
            $content_type = "multipart/byteranges;boundary=$boundary";

    }
} else {
    //发送整个文件
    //设置变量，就好像这是从Range首部抽取的
    $start = 0;
    $end = $filelength-1;
    $offset = array($start, $end);
    $offsets = array($offset);
    $content_length = $filelength;
    $boundaries = array(0 => '', 1=>'');
}
//指出得到的是什么
header("Content-Type:".$content_type);
header("Content-Length:".$content_length);
//提供给用户
echo'****',$file,'****';
$handle = fopen($file, 'r');
if ($handle) {
    $offsets_count = count($offsets);
    //输出各个边界符合文件的适当部分
    for ($i = 0; $i<$offsets_count; $i++) {
       // print $boundaries[$i];
        list($start, $end) = $offsets[$i];
        echo '&&&&&&',$offsets[$i],'&&&&&';
        echo '%%%%%',$start,'******';
        echo '%%%%',$end,'%%%%%%';
        send_range($handle,$start, $end);
    }
    //结束边界
   // print $boundaries[$i];
    fclose($handle);
}
//在文件中移动适当的位置
//按块输出所请求的部分
function send_range($handle, $start, $end) {
    $line_length = 4096;//魔法数
   
    if(fseek($handle, $start) ===-1) {
        error_log("Error:fseek()fail.");
    }
    $left_to_read = $end - $start+1;
    do {
        $length = min($line_length, $left_to_read);
        if (($buffer = fread($handle, $length)) !==false) {

            echo $buffer,'<br />';
        } else {
            error_log("Error:fread()fail.");
        }
    } while ($left_to_read -=$length);
}
//发送首部失败
function send_error($filelength) {
    http_response_code(416);
    header("Content-Range:bytes */$filelength"); //响应吗416要求发送这个首部
}
//将一个偏移量转换为文件中的开始位置和结束位置
//或者，如果偏移量是非法的，则返回false
function parse_offset($range, $filelength) {
    /*
    规范：“字节范围规范（byte-range-spec）中的首字节位置（first-byte-pos）值指定了范围中第一个字节的字节偏移量。”
    规范：“末字节位置（last-byte-pos）值指定了范围中最后一个字节的字节范围偏移量也就是指定的字节位置包含在范围内。”
    */

    list($start, $end) = explode('-',$range);
    //$start = $range;
    /*
    规范：“后缀字节范围规范（suffix-byte-range-spec）用于指定尸体后缀，长度由后缀长度（suffix-length）值指定的。”
    */
    if ($start ==='') {
        if($end === '' || $end === 0 ) {
            //请求范围“-”或“-0”
            return false;
        } else {
            /*
             规范：“如果实体比指定的后缀长度（suffix-length）短，”
             则使用整个实体体（entity-body）。
             规范：“字节偏移值从0开始。”
            */
             $start = max(0,$filelength-$end);
             $end = $filelength-1;
        }
        /*
        规范：“如果没有提供末字节位置（last-byte-pos）值，或者如果这个值大于或者等于实体体（entity-body）的当前长度，末字节位置则等于实体体当前长度（字节数）减1”
        */
        if( $end ==='' || $end>$filelength-1 ) {
            $end = $filelength-1;

        }
        /*
        规范：“如果提供了末字节的位置（last-byte-pos）值，他必须大于或等于字节范围（byte-range-spec）中的首字节位置（first-byte-pos），否则在在语法上字节范围规范就是不合法的。”
        这还会捕获起始位置大于文件长度的情况
        */
        if ($start > $end) {
            return false;
        }
        return array($start, $end);
    }
}
    //生成一个随机字符串来分隔响应的各个部分
    function str_rand($length = 32, $characters='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        if (!is_int($length) || $length<0){
            return false;
        }
        $characters_length = strlen($characters) -1;
        $string = '';
        for($i = $length; $i>0; $i--){
            $string .=$characters[mt_rand(0,$characters_length)] ;

        }
        return $string;
    }
?>
