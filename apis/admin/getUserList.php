<?php

include_once "../../models/core_mysql.php";
include_once "../../controllers/admin/getUserList.php";


$arr = getUserList($mysqli);
echo json_encode($arr);
