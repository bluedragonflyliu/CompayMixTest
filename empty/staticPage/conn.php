    <?php
    	$dsn = "mysql:host=localhost;dbname=mytest;charset=utf8";
    	$user = "root";
    	$password = "";
    	try{
    		$dbh = new PDO($dsn,$user,$password);
    	}catch(PDOException $e){
    		echo "连接失败".$e->getMessage();
    	}
    ?>