<?php

// 获取所有用户数据
function getUserList($mysqli)
{
    $arr = array();
    $sql = "SELECT users.uid,users.username,users.is_sign,users.sign_time FROM users";
    $mysqli_stmt = $mysqli->prepare($sql);

    if ($mysqli_stmt->execute()) {

        //绑定结果集中的值到变量
        $uid = null;
        $users = null;
        $isSign = null;
        $signTime = null;

        $mysqli_stmt->bind_result($uid, $users, $isSign, $signTime);
        //遍历结果集
        while ($mysqli_stmt->fetch()) {
            array_push($arr, array($uid, $users, $isSign, $signTime));
        }
        // var_dump($arr);
    }
    //释放结果集
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();

    return $arr;
}
