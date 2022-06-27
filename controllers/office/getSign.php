<?php
include_once "../../models/core_mysql.php";

$uid = (int)$_GET["workNumber"];
$username =  $_GET["username"];

//  查询到用户的uid后返回，然后根据返回的uid更新数据库
$rsuid = getUserIsExist($mysqli, $uid, $username);
$rsuid = (int)$rsuid;
updateSign($mysqli, $rsuid);

$mysqli->close();


//查询是否存在该用户，存在则更新数据库 设置为已签到
function getUserIsExist($mysqli, $uid, $username)
{
    $sql = "SELECT uid FROM users WHERE uid = ? AND username = ?";
    $mysqli_stmt = $mysqli->prepare($sql);

    $mysqli_stmt->bind_param('is', $uid, $username);
    if ($mysqli_stmt->execute()) {
        //绑定结果集中的值到变量
        $mysqli_stmt->bind_result($uid);
        $res = $mysqli_stmt->fetch();
        //遍历结果集
        if ($res) {
            echo "学号:" . $uid;
        } else {
            echo "<script>window.location.href='../../views/office/failed.html'</script>";
            return null;
        }
    }
    //释放结果集
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
    return $uid;
}
// 签到 更新打卡时间和状态
function updateSign($mysqli, $uid)
{
    $isSign = 1;  //表示已打卡
    $nowTime = date('Y-m-d h:i:s', time()); //date('Y-m-d h:i:s',time());获取当前时间的函数
    $sql = "UPDATE users SET is_sign = ? , sign_time = ? WHERE uid =?";
    $mysqli_stmt = $mysqli->prepare($sql);
    $mysqli_stmt->bind_param('isi', $isSign, $nowTime, $uid);
    if ($mysqli_stmt->execute()) {
        echo PHP_EOL;
        // window.location.href js控制跳转到新页面  
        echo "<script>window.location.href='../../views/office/feedback.html'</script>";
    } else {
        echo $mysqli_stmt->error;
    }
}
