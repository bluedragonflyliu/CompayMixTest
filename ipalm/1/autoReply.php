<?php
require_once('./Myapi.php');
$Myapi = new Myapi();
$access_token = $Myapi->access_token;
$url = "https://api.weixin.qq.com/cgi-bin/get_current_autoreply_info?access_token=$access_token";
$res = $Myapi->httpsRequest($url);
var_dump($res);
?>