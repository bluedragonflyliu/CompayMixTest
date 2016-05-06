<?php
	include './phpqrcode/phpqrcode.php'; 
	QRcode::png('http://www.baidu.com/',false,$pixelPerPoint = 4, $outerFrame = 4,false);
	