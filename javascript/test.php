<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>test</title>
</head>
<body>
<div id='pid'></div>
	<script>
		//document.write('hello javascript!');
		var mydiv = document.getElementById('pid');
		mydiv.innerHTML='zhangsan';
		var a = null;
		var b = undefined;
		var c = 0;
	
		//console.log(typeof(b));
		//console.log(typeof(a));

		var person = new Object();
		person.name = 'zhangsan';
		person.eat = function() {
			alert('人是铁饭是钢，一顿不吃饿得慌。:)');
		}
		//console.log(person.name);
		//person.eat();

		var  rabbit = {
			name : '兔八哥',
			age:100,//注意每个语句的后面是逗号啊
			fight:function(){
				alert('兔八哥正在和达菲鸭火拼中！');
			},
		};
		//console.log(rabbit['name']);
		//rabbit.fight();

		var d = 10;
		var e = '10';
		console.log(d==e); 
	</script>
	
</body>
</html>