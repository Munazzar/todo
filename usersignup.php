<?php
$email=$_REQUEST['user'];
$pa=$_REQUEST['pass'];
require_once("database_connect.php");

date_default_timezone_set("America/Chicago");
$now = DateTime::createFromFormat('U.u',microtime(true));
$trno=(string)$now->format("YmdHisu");
$query="insert into users(userid,email,password,name,gsignin) values('$trno','$email','$pa','user','0')";
mysqli_query($con,$query);
header("Location: index.html");
die();
?>