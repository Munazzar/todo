<?php
$taskid=$_REQUEST['taskid'];
echo $query="update tasks set status=1 where taskid='$taskid'";
require_once("database_connect.php");

mysqli_query($con,$query);

?>