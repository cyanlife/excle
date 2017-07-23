<?php
$db = mysqli_connect('localhost', 'root', '', 'zhidao');


if (mysqli_connect_errno() > 0) {
    exit('database false'.mysqli_connect_errno());
}


mysqli_set_charset($db, 'UTF8');
//echo date('Y-m-d H:i:s',time());