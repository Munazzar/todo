<?php
$taskid=$_REQUEST['taskid'];
$col=$_REQUEST['col'];
$val=$_REQUEST['val'];
echo $query="update tasks set $col='$val' where taskid='$taskid'";
require_once("database_connect.php");

mysqli_query($con,$query);

?>