<?php
ob_start();
session_start();
//print_r($_SESSION);
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

            <p class='cm'><a href='completed_tasks.php'>Completed Tasks</a>
            </p>

            <p class='cm'><a href='view_profile.php'>profile</a>
            </p>

            <p class='cm'><a href='logout.php'>logout</a>
            </p>



        </div>

        <div class='tasks'>
            <h2 style='text-align:center;'>Active Tasks</h2>
            <button class='addt' id="add_new"> + Add Task</button>

            <div class='create_task hide' id='new' >
                <input type='text' id='t-title' placeholder="Enter Task" class='new-input'> <br>
                <textarea placeholder="Enter Details" cols='25' rows='3'  class='new-input' id='t-desc'>
                </textarea>
                <br>
                <input type='date' placeholder="select date" class='new-input' id='t-dt'>
                <br>
                <button class='ct'>Create Task</button>
                <button class='cancel-bt'>Cancel</button>
            </div>
            <hr>
            <div class='active_tasks'>
<?php
$userid = $_SESSION['userid'];
require_once("database_connect.php");
$query = "select * from tasks where userid='$userid' and status=0";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $taskid = $row['taskid'];
        echo "<div class='task_div'>";
        echo "<input type='text' value='" . $row['title'] . "' class='input_tag' id='" . $taskid . "-title' onblur='update(this.id)'><br>";
        echo "<textarea class='input_tag' rows='1' id='" . $taskid . "-description' onblur='update(this.id)'>" . $row['description'] . "</textarea>";
        echo "<input type='date' value='" . $row['dt'] . "' class='input_tag' id='" . $taskid . "-dt' onblur='update(this.id)' >";
        echo "<button class='success' name='completed'  value='$taskid'>Mark completed</button>";
        echo "<button class='delete-bt' name='delete' value='$taskid'>Delete</button>";
        echo "</div>";
    }
}
?>


            </div>
        </div>


    </body>

</html>