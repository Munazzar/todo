<?php

session_start();
$email = $_REQUEST['user'];
$pa = $_REQUEST['password'];
require_once("database_connect.php");
date_default_timezone_set("America/Chicago");
echo "Loading, please wait...";
$query = "select * from users where email='$email' and password='$pa'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['userid'] = $row["userid"];
        $_SESSION['email'] = $row["email"];
        $_SESSION['name'] = $row["name"];
    }
}
echo "<meta http-equiv='refresh' content='2;url=activetasks.php' >"
?>
	