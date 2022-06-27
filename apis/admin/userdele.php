<?php

include_once "../../models/core_mysql.php";
include_once "../../controllers/admin/userdele.php";

$uid = (int)$_GET['uid'];
userdele($mysqli, $uid);
