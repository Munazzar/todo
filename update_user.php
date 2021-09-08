<?php
$userid=$_REQUEST['userid'];
$col=$_REQUEST['col'];
$val=$_REQUEST['val'];
echo $query="update users set $col='$val' where userid='$userid'";
require_once("database_connect.php");

mysqli_query($con,$query);

?>