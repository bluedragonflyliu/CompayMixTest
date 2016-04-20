<?php
header('content-type:text/html;charset=utf-8');
$kv = new SaeKV();
// 初始化KVClient对象
$ret = $kv->init();
$sVerifyEchoStr = $kv->get('sVerifyEchoStr');
echo  $sVerifyEchoStr;
echo '<br />';

$aa = $kv->get('aa');
echo  $aa;
echo '<br />';
?>