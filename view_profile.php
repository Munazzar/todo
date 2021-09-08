<?php
ob_start();
session_start();

if ($_SESSION['userid'] == null) {
    echo "please login";
    echo "<meta http-equiv='refresh' content='1;url=index.html' >";
    die();
} else {
    
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href='css/tasks.css'>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src='js/add_task.js' type='text/javascript'></script>
        <script src="https://kit.fontawesome.com/8cafc3202a.js" crossorigin="anonymous"></script>
        <link rel='icon' type="image/png" href='images/icon.ico'>
    </head>
    <body>

        <div class='nav'>

            <img src='images/logo.png' width='45px' height='55px'>

            <p class='cm'><a href='activetasks.php'>Active Tasks</a>
            </p>

            <p class='cm'><a href='completed_tasks.php'>Completed Tasks</a>
            </p>

            <p class='cm'><a href='logout.php'>logout</a>
            </p>



        </div>

        <div class='tasks'>
            <h2 style='text-align:center;'>Profile</h2>

            <hr>
            <div class='active_tasks'>
<?php
$userid = $_SESSION['userid'];
require_once("database_connect.php");
$query = "select * from users where userid='$userid'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $userid = $row['userid'];
        echo "<div class='task_div'>";
        echo "Name : <input type='text' value='" . $row['name'] . "' class='input_tag' id='" . $userid . "-name' onblur='update_user(this.id)' ><br>";
        echo "Email : <input type='email' value='" . $row['email'] . "' class='input_tag' id='" . $userid . "-email' onblur='update_user(this.id)' ><br>";
        echo "password : <input type='password' value='" . $row['password'] . "' class='input_tag' id='" . $userid . "-password' onblur='update_user(this.id)' ><br>";
        //echo "<input type='date' value='".$row['dt']."' class='input_tag' id='".$taskid."-dt' onblur='update(this.id)' disabled >";	

        echo "</div>";
    }
}
?>


            </div>
        </div>


    </body>

</html>