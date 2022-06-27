<?php

// 删除成员
function userdele($mysqli, $uid)
{
    $sql = "DELETE FROM users where uid = ?";
    $mysqli_stmt = $mysqli->prepare($sql); //准备预处理语句
    $mysqli_stmt->bind_param('i', $uid);

    if ($mysqli_stmt->execute()) {
        echo "删除成功";
        echo PHP_EOL;
        echo "<script>alert('删除成功!');window.location.href='../../views/admin/index.php'</script>";
    } else {
        echo $mysqli_stmt->error; //执行失败，错误信息
    }
}
