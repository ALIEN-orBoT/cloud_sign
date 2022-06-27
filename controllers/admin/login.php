<?php
include_once('../../models/core_mysql.php');



$adminName = $_POST['adminName'];
$adminPasswd = $_POST['adminPasswd'];

getAdmin($mysqli, $adminName, $adminPasswd);

// 检查管理员信息是否存在，判断登录是否成功
function getAdmin($mysqli, $adminName, $passwd)
{
    $sql = "SELECT admin_name FROM admins WHERE admin_name = ? and passwd = ?";
    $mysqli_stmt = $mysqli->prepare($sql);

    $mysqli_stmt->bind_param('ss', $adminName, $passwd);

    if ($mysqli_stmt->execute()) {
        //绑定结果集中的值到变量
        $mysqli_stmt->bind_result($adminName);

        $res = $mysqli_stmt->fetch();

        //遍历结果集
        if ($res) {
            $_SESSION['adminName'] = $adminName;
            echo "<script>window.location.href='../../views/admin/index.php'</script>";
        } else {
            echo "<script>alert('登录失败');window.location.href='../../views/admin/index.php'</script>";
        }
    }
    //释放结果集
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}



$mysqli->close();//mysqli_close($mysqli);