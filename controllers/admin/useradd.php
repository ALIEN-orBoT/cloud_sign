<?php

include_once "../../models/core_mysql.php";
$uid = (int)$_GET["workNumber"];
$username =  $_GET["username"];

useradd($mysqli, $uid, $username);

// 新增成员
function useradd($mysqli, $uid, $username)
{
    // 增
    $sql = "insert into users(uid,username) values(?,?)";
    $mysqli_stmt = $mysqli->prepare($sql); //准备预处理语句
    $mysqli_stmt->bind_param('is', $uid, $username); //s代表string类型
    //执行预处理语句
    if ($mysqli_stmt->execute()) {
        echo "添加成功";
        echo PHP_EOL;
        echo "<script>indow.location.href='../../views/admin/feedback.html'</script>";
    } else {
        echo $mysqli_stmt->error; //执行失败，错误信息
    }
}

$mysqli->close();//mysqli_close($mysqli);
