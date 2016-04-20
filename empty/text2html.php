<?php 
	$str = file_get_contents('./file/test.txt');
	//echo $str;
	
	

	function pc_text2html($s) {

		//$s = htmlentities($s);

		$grafs = split("\r\n", $s);

		for ($i=0,$j=count($grafs); $i<$j;$i++) {
			//链接到类似http或ftp URL的目标
			$grafs[$i] = preg_replace('/((ht|f)tp:\/\/[^\s&]+)/', '<a href="$1">$1</a>', $grafs[$i]);
			//链接到email地址
			$grafs[$i] = preg_replace('/^([a-zA-Z0-9_\.\-]+\@([-a-z0-9\-]+\.)+[a-z]{2,})+$/i','<a href="mailto:$1">$1</a>', $grafs[$i]);
			//开始一个新段落
			$grafs[$i] = '<p>'.$grafs[$i].'</p>';
		}
		return implode("\r\n", $grafs);
	}

	$str = pc_text2html($str);
	
	require_once 'class.html2text.inc';
	$html = file_get_contents('http://baike.baidu.com/link?url=GwCAXGvKZIdF1NkFjM8RJffUQ5ANuevl34kLoETkmqzUQaKEuZD-_JaKJ-ryMRvBlJMz02S8AXEyghQVg6PA9Bolsb4aAp5AOlCoFDd2f4ltCNN6V4YhiPYL4jDqsvw4MNezoHv-MHGCdJoFlXpHPa');
	$converter = new html2text($html);
	$plain_text = $converter->get_text();
	file_put_contents('./file/text2.txt', $plain_text);
?>