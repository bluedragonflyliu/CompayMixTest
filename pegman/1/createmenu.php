<?php 
require_once('./Myapi.php');
$api = new Myapi();
$access_token = $api->access_token;
$url = 'https://qyapi.weixin.qq.com/cgi-bin/menu/create?access_token='.$access_token.'&agentid=25';
$data =  <<<JSON
{
"button":[
       {	
           "type":"click",
           "name":"今日歌曲",
           "key":"V1001_TODAY_MUSIC"
       },
       {
           "name":"菜单",
           "sub_button":[
               {
                   "type":"view",
                   "name":"搜索",
                   "url":"http://www.soso.com/"
               },
               {
                   "type":"click",
                   "name":"赞一下我们",
                   "key":"V1001_GOOD"
               }
           ]
      }
   ]
}
JSON;
$res = $api->httpRequest($url, $data);
var_dump($res);

?>