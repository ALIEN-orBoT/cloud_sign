
<?php
// 连接数据库

header('content-type:text/html;charset=utf-8');
$host = "localhost";
$user = "root";
$password = "";
$db = "cloud_signIn";

$mysqli = new mysqli($host, $user, $password, $db); //实例化mysqli对象，连接数据库
if ($mysqli->connect_error) {
    die("Connection failed" . $mysqli->connect_error);
}
$mysqli->set_charset('utf8'); //设置字符集
// echo "连接成功";

// 启用session
session_start(); // 可以起到全局打开session的作用