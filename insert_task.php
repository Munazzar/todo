<?php
session_start();
 $userid=$_SESSION['userid'];
 $title=$_REQUEST['title'];
 $desc=$_REQUEST['desc'];
 $dt=$_REQUEST['date'];
require_once("database_connect.php");
date_default_timezone_set("America/Chicago");
$now = DateTime::createFromFormat('U.u',microtime(true));
$trno=(string)$now->format("YmdHisu");

echo $query="insert into tasks(taskid,userid,title,description, dt, status)values('$trno','$userid','$title','$desc','$dt','0')";
mysqli_query($con, $query);


?>