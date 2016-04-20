<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<style type="text/css">
	#container{
		width:800px;
		height:300px;
		margin:20 auto;
	}
	.rows{
		width:100%;
		float: left;
	}
	.clear{
		clear: both;
	}
	#submit{
		margin-top: 130px;
		position: absolute;
		z-index: 20000;
	}
</style>
<body>
<?php 

	  	require_once "conn.php";
        $stmt=$dbh->prepare("select * from news");
        $stmt->execute();
		$rows = $stmt->fetchAll();
		foreach ($rows as $key => $value) {
			echo $value['title'];
			echo '<br>';
			echo $value['content'];
		}
	?>
<form action='./getContent.php' method ='post'>
		<div class='rows'>
			<script id="container1" name="content" type="text/plain">
			<?php
       	 		echo $value['content'];
        	?>
        </script> 
			<!-- <script id="container2" name="content" type="text/plain"></script>  -->
			<!-- <script id="container3" name="content" type="text/plain"></script>  -->
			<!-- <div id="container" name="content" type="text/plain"></div> -->
		</div>
		<div class='clear'></div>
		<div class='rows' id='submit'>
			<button>提交</button>
		</div>
	</form>

    <!-- 配置文件 -->
    <script type="text/javascript" src="./UEditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="./UEditor/ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
       var ue = UE.getEditor('container1', {
   		 	
		});
       /*
       var ue = UE.getEditor('container2', {
   		 autoHeight: false
		});

       var ue = UE.getEditor('container3', {
   		 autoHeight: false
		});
		*/
    </script>
	

</body>
</html>
