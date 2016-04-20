<?php
date_default_timezone_set("PRC");
error_reporting(E_ALL); // 输出所有错误
ini_set("display_errors", 'off');
$error_path = $_SERVER['DOCUMENT_ROOT']."/php coretest/date("Y-m-d") ."error.log";
if (!file_exists($error_path)){
  mkdir($error_path, 0777);
  $error_path = $error_path ."/".date("Y-m-d") ."error.log";
  $handle = fopen($error_path, "w"); // 还有，文件打开后都不关闭的吗？
  fclose($handle);
  ini_set("error_log", $error_path);
} else {
  $error_path = $error_path ."/".date("Y-m-d") ."error.log";
  ini_set("error_log", $error_path);
}
echo $_SERVER['DOCUMENT_ROOT'];
?>