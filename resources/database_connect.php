<?php

$ht="localhost";
$user="id16427402_todolist";
$pwd="Todolistwiu!1";
$db="id16427402_todo";
$con=mysqli_connect($ht,$user,$pwd,$db);
if(mysqli_connect_errno())
{
		echo "failed to connect to database".mysqli_connect_error();
}

?>