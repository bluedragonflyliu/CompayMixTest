<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加文章</title>
</head>
<body>
	<?php
	//获取修改的内容
	$id = empty($_GET['id'])?null:$_GET['id'];
	if($_GET['id']){
		require_once "conn.php";
		$sql = "select * from news where id={$_GET['id']}";
		$res = $dbh->query($sql)->fetch();
	}
?>
<form action="action.php" method="post">
	标题：<input type="text" name="title" value="<?=@$res['title']?>"/><br/>
	内容：<textarea name="content" col=40 row=4><?=@$res['content']?></textarea><br/>
	<input type="hidden" name="id" value="<?=$_GET['id']?>" />
	<input type="submit" name="submit" value="<?php empty($id) ? '修改' : '添加'?>" />
</form>
</body>
</html>
