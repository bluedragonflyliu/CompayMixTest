<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>action</title>
</head>
<body>
	   <?php
    	require_once 'conn.php';
    	$title = $_POST['title'];
    	$content = $_POST['content'];
    	$time = time();
    	if($_POST['submit']=='添加'){
    		$sql = "insert into news values('','$title','$content',$time)";
    		$dbh->query($sql);
    		$id = $dbh->lastInsertId();
    		$filename = "news_{$id}.html";
    		$fp_tmp = fopen("template.html","r");
    		$fp_html = fopen($filename,"w");
    		while(!feof($fp_tmp)){
    			$row = fgets($fp_tmp);
    			$row = replace($row,$title,$content,date('Y-m-d H:i:s',$time));
    			fwrite($fp_html,$row);
    		}
    		fclose($fp_tmp);
    		fclose($fp_html);
    		echo "添加成功并生成静态文件";
    	}else{
    		$sql = "update news set title = $title , content = $content ,time = $time where id ={$_POST['id']}";
    		$dbh->query($sql);
    		$filename = "news_{$_POST['id']}.html";
    		@unlink($filename);
    		$fp_tmp = fopen("template.html","r");
    		$fp_html = fopen($filename,"w");
    		while(!feof($fp_tmp)){
    			$row = fgets($fp_tmp);
    			$row = replace($row,$title,$content,date('Y-m-d H:i:s',$time));
    			fwrite($fp_html,$row);
    		}
    		fclose($fp_tmp);
    		fclose($fp_html);
    		echo "更新成功并更新静态文件";
    	}
    	//逐行替换函数
    		function replace($row,$title,$content,$time){
    			$row=str_replace("{title}",$title,$row);
    			$row=str_replace("{content}",$content,$row);
    			$row=str_replace("{time}",$time,$row);
    			return $row;
    	}
    ?>
</body>
</html>