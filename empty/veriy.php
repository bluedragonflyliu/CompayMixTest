<?php
    //告诉浏览器我现在输出的是一个图像
    header('Content-type:image/jpeg');
    //1、创建画布
    $img = imagecreatetruecolor(120,40);

    //2、确定颜色
    $backgroundColor = imagecolorallocate($img,220,87,37);//现在我已经有了一个颜色
    $color1 = imagecolorallocate($img,255,255,255);

    //将这个颜色应用到画布上面
    imagefill($img,5,5,$backgroundColor);

    $str = 'zhangsan';
    $length = strlen($str);

    for($i=1;$i<$length;$i++){
         imagettftext($img,20,0,($i-1)*20+5,30,$color1,'./font/'.mt_rand(1,6).'.ttf',$str[$i-1]);
    }
    //3、画或者写
    //imageline($img,10,10,100,100,$color1);
    //imagesetpixel($img,50,50,$color1);
    //imagerectangle($img,10,10,100,200,$color1);
   
    //$array = imagettfbbox(20,0,'./simkai.ttf','曰人人');


    //4、保存或者输出
    imagejpeg($img);

    //5、关闭资源
    imagedestroy($img);
?>