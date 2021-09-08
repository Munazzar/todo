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

            <p class='cm'><a href='view_profile.php'>profile</a>
            </p>

            <p class='cm'><a href='logout.php'>logout</a>
            </p>



        </div>

        <div class='tasks'>
            <h2 style='text-align:center;'>Completed Tasks</h2>

            <hr>
            <div class='active_tasks'>
<?php
$userid = $_SESSION['userid'];
require_once("database_connect.php");
$query = "select * from tasks where userid='$userid' and status=1";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $taskid = $row['taskid'];
        echo "<div class='task_div'>";
        echo "<input type='text' value='" . $row['title'] . "' class='input_tag' id='" . $taskid . "-title' onblur='update(this.id)' disabled><br>";
        echo "<textarea class='input_tag' rows='1' id='" . $taskid . "-description' onblur='update(this.id)' disabled>" . $row['description'] . "</textarea>";
        echo "<input type='date' value='" . $row['dt'] . "' class='input_tag' id='" . $taskid . "-dt' onblur='update(this.id)' disabled >";

        echo "</div>";
    }
}
?>


            </div>
        </div>


    </body>

</html>