<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>XML</title>
</head>
<body>
<?PHP 
  $doc = new DOMDocument();
  $doc->load( 'books.xml' );
  
  $books = $doc->getElementsByTagName( "book" );
  foreach( $books as $book )
  {
  $authors = $book->getElementsByTagName( "author" );
  $author = $authors->item(0)->nodeValue;
  
  $publishers = $book->getElementsByTagName( "publisher" );
  $publisher = $publishers->item(0)->nodeValue;
  
  $titles = $book->getElementsByTagName( "title" );
  $title = $titles->item(0)->nodeValue;
  
  echo "$title - $author - $publisher\n";
  }

?>
 <script type="text/javascript">
 var str = "<?xml version='1.0' encoding='utf-8'?><movies><movie border='1'><name>辩护人</name><country>韩国</country></movie><movie><name>V字仇杀队</name><country>美国</country></movie><movie><name>盗梦空间</name><country>美国</country></movie></movies>";

 // var s = '\r\n123456789\r\n';
 // var newStr = s.trim();
 // alert(newStr);
 // alert(newStr.length);  new Object ()  {}  function abc(){}

 var parser=new DOMParser();
   xmlDoc = parser.parseFromString(str,"text/xml");
 
   var movie = xmlDoc.getElementsByTagName('movie');
   // [{name:'辩护人',country:'韩国'}, {name:'V字仇杀队', country:'美国'}]
   var ms = [];
   for(var i=0;i<movie.length;i++){
    //拼接对象
    var name = movie[i].getElementsByTagName('name')[0].innerHTML;
    var country = movie[i].getElementsByTagName('country')[0].innerHTML;
    var info = {name:name,country:country};
    //将对象压入数组
    ms.push(info);
   }

   console.log(ms);

 </script>

</body>
</html>
