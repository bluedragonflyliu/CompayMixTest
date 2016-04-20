<?php 
require_once('./Myapi.php');
$api = new Myapi();
$access_token = $api->access_token;
$url = 'https://qyapi.weixin.qq.com/cgi-bin/material/add_mpnews?access_token='.$access_token;
$data =  <<<JSON
{
    "agentid":25,
    "mpnews":{
           "articles":[
            {
               "title": "images_test",
               "thumb_media_id": "2-G6nrLmr5EC3MMb_-zK1dDdzmd0p7cNliYu9V5w7o8K0",
               "author": "liufu",
               "content_source_url": "http://pegman.sinaapp.com/images/logo.png",
               "content": "jojpokp[l[lyftrderseawaefsfcgu9",
               "digest": "这是一个测试偶",
               "show_cover_pic": "0"
              },
           //此处有多篇文章
            ]
    },
}
JSON;
$res = $api->httpRequest($url, $data);
var_dump($res);

?>