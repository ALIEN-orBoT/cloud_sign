<?php
include_once "../../models/core_mysql.php";

unset($_SESSION['adminName']);
session_destroy();

echo "<script>alert('退出成功！');window.location.href='./login.html';</script>";
// 