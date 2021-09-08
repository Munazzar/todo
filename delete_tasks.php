<?php

$taskid = $_REQUEST['taskid'];
 $query = "delete from tasks where taskid='$taskid'";
require_once("database_connect.php");

mysqli_query($con, $query);
?>