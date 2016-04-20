<?php
//must-revalidate:如果服务器明确指出资源的过期时间或者保鲜时间，
//而且生命了资源的修改时间或者ETag之类的标识，那么就有一个问题，有效时间内若用到了该资源，
//就需要用must-revalidate确保资源最新

header('Cache-Control:max-age=5000,must-revalidate');
header('Last-Modified:'.gmdate('D,d M Y H:i:s').'GMT');
header('Expires:'.gmdate('D,d M Y H:i:s',time()+'5000').'GMT');
header("content-type:text/html;charset=utf-8");
echo '我不刷新';
/*echo "PHP_SELF : " . $_SERVER['PHP_SELF'] . "<br />"; 
echo "GATEWAY_INTERFACE : " . $_SERVER['GATEWAY_INTERFACE'] . "<br />"; 
echo "SERVER_ADDR : " . $_SERVER['SERVER_ADDR'] . "<br />"; 
echo "SERVER_NAME : " . $_SERVER['SERVER_NAME'] . "<br />"; 
echo "SERVER_SOFTWARE : " . $_SERVER['SERVER_SOFTWARE'] . "<br />"; 
echo "SERVER_PROTOCOL : " . $_SERVER['SERVER_PROTOCOL'] . "<br />"; 
echo "REQUEST_METHOD : " . $_SERVER['REQUEST_METHOD'] . "<br />"; 
echo "REQUEST_TIME : " . $_SERVER['REQUEST_TIME'] . "<br />"; 
echo "REQUEST_TIME_FLOAT : " . $_SERVER['REQUEST_TIME_FLOAT'] . "<br />"; 
echo "QUERY_STRING : " . $_SERVER['QUERY_STRING'] . "<br />"; 
echo "DOCUMENT_ROOT : " . $_SERVER['DOCUMENT_ROOT'] . "<br />"; 
echo "HTTP_ACCEPT : " . $_SERVER['HTTP_ACCEPT'] . "<br />"; 
echo "HTTP_ACCEPT_CHARSET : " . $_SERVER['HTTP_ACCEPT_CHARSET'] . "<br />"; 
echo "HTTP_ACCEPT_ENCODING : " . $_SERVER['HTTP_ACCEPT_ENCODING'] . "<br />"; 
echo "HTTP_ACCEPT_LANGUAGE : " . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "<br />"; 
echo "HTTP_CONNECTION : " . $_SERVER['HTTP_CONNECTION'] . "<br />"; 
echo "HTTP_HOST : " . $_SERVER['HTTP_HOST'] . "<br />"; 
echo "HTTP_REFERER : " . $_SERVER['HTTP_REFERER'] . "<br />"; 
echo "HTTP_USER_AGENT : " . $_SERVER['HTTP_USER_AGENT'] . "<br />"; 
echo "HTTPS : " . $_SERVER['HTTPS'] . "<br />"; 
echo "REMOTE_ADDR : " . $_SERVER['REMOTE_ADDR'] . "<br />"; 
echo "REMOTE_HOST : " . $_SERVER['REMOTE_HOST'] . "<br />"; 
echo "REMOTE_PORT : " . $_SERVER['REMOTE_PORT'] . "<br />"; 
echo "REMOTE_USER : " . $_SERVER['REMOTE_USER'] . "<br />"; 
echo "REDIRECT_REMOTE_USER : " . $_SERVER['REDIRECT_REMOTE_USER'] . "<br />"; 
echo "SCRIPT_FILENAME : " . $_SERVER['SCRIPT_FILENAME'] . "<br />"; 
echo "SERVER_ADMIN : " . $_SERVER['SERVER_ADMIN'] . "<br />"; 
echo "SERVER_PORT : " . $_SERVER['SERVER_PORT'] . "<br />"; 
echo "SERVER_SIGNATURE : " . $_SERVER['SERVER_SIGNATURE'] . "<br />"; 
echo "PATH_TRANSLATED : " . $_SERVER['PATH_TRANSLATED'] . "<br />"; 
echo "SCRIPT_NAME : " . $_SERVER['SCRIPT_NAME'] . "<br />"; 
echo "REQUEST_URI : " . $_SERVER['REQUEST_URI'] . "<br />"; 
echo "PHP_AUTH_DIGEST : " . $_SERVER['PHP_AUTH_DIGEST'] . "<br />"; 
echo "PHP_AUTH_USER : " . $_SERVER['PHP_AUTH_USER'] . "<br />"; 
echo "PHP_AUTH_PW : " . $_SERVER['PHP_AUTH_PW'] . "<br />"; 
echo "AUTH_TYPE : " . $_SERVER['AUTH_TYPE'] . "<br />"; 
echo "PATH_INFO : " . $_SERVER['PATH_INFO'] . "<br />"; 
echo "ORIG_PATH_INFO : " . $_SERVER['ORIG_PATH_INFO'] . "<br />";*/
echo  $_SERVER['PROCESSOR_IDENTIFIER'].'<br />';
?>