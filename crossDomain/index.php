<?php 
 header('content-type:text/html;charset=utf-8');
 if(isset($_GET['callback'])){
 	 $callback=$_GET['callback'];
 	}
// header("Access-Control-Allow-Origin：http://127.0.0.1:8080/domain");
//1.实例化pdo对象
 $pdo = new PDO('mysql:host=localhost;dbname=mytest;charset=utf8;port=3306','root','');
 //mysql数据库类型字符串 必须要小写
 //utf8中间没有-

 //2.发送sql指令
 $stmt = $pdo->query("select * from study limit 10");

 //3.处理返回的结果
 //1处理方法
 // foreach($stmt as $k=>$v){
 // var_dump($v);
 // }

  //2种处理方法  提取一条结果
 // $row = $stmt->fetch();
 // var_dump($row);

  //3种处理方法  把所有的结果提取
 $rows = $stmt->fetchAll();//fetch提取   all是所有的意思
 $rows['fun'] = $callback;
 $data = $_GET['datatables'];
 $data++;
 $rows['datatables']=$data;
echo  $callback. "(".json_encode($rows).")";  
?>