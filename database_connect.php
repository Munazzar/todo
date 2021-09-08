<?php

$ht = "localhost:3306";
$user = "root";
$pwd = "";
$db = "todo";
$con = mysqli_connect($ht, $user, $pwd, $db);
if (mysqli_connect_errno()) {
    echo "failed to connect to database" . mysqli_connect_error();
}
?>