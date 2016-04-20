var fs = require("fs");
//阻塞方式
/*var data = fs.readFileSync('mytest.txt');
console.log(data.toString());
console.log('程序执行结束！');*/
//非阻塞
fs.readFile('mytest.txt',function(err,data){
	if(err) return console.error(err);
	console.log(data.toString());
	});
console.log('程序执行结束！');