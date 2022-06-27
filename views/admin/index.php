<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理员首页</title>
    <link rel="stylesheet" href="../../static/pkg/bootstrap-4.6.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../static/css/admin/index.css">
    <script src="../../static/pkg/jquery-3.6.0/jquery-3.6.0.min.js"></script>
</head>

<body>

    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link disabled">
                <?php
                include_once "../../models/core_mysql.php";
                if (isset($_SESSION['adminName'])) {
                    echo "当前操作员：" . $_SESSION['adminName'];
                } else {
                    echo '<script>window.location.href="./login.html"</script>';
                }
                ?>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./useradd.html">添加成员</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./logout.php">退出</a>
        </li>
    </ul>

    <div class="container">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">UID</th>
                    <th scope="col">姓名</th>
                    <th scope="col">今日是否签到</th>
                    <th scope="col">打卡日期</th>
                    <th scope="col">操作</th>
                </tr>
            </thead>
            <tbody id="userList">
                <!-- <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr> -->
            </tbody>
        </table>

    </div>

    <script src="../../static/pkg/bootstrap-4.6.1-dist/js/bootstrap.min.js"></script>
    <script>
        fetch('../../apis/admin/getUserList.php', {
            method: 'GET',
            mode: 'cors',
            credentials: 'include'
        }).then(response => {
            return response.json()
        }).then(data => {
            let userList = document.querySelector('#userList');

            data.forEach(v => {
                if (v[2] ? isSign = "是" : isSign = "否")
                    userList.innerHTML += `<tr>
                    <th scope="row">${v[0]}</th>
                    <td>${v[1]}</td>
                    <td>${isSign}</td>
                    <td>${v[3]}</td>
                    <td><a class="btn btn-danger" href="../../apis/admin/userdele.php?uid=${v[0]}">删除</a></td>
                </tr>`;
            })

            console.log(data)
        })
    </script>
</body>

</html>