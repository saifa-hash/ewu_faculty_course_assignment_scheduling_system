<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['role'] != 'Admin') {
    header("Location: index.php");
    exit();
}

include 'db_connect.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $section_id = $_POST['section_id'];
    $day_of_week = $_POST['day_of_week'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $room_number = $_POST['room_number'];

    $sql = "UPDATE class_schedule
            SET section_id='$section_id',
                day_of_week='$day_of_week',
                start_time='$start_time',
                end_time='$end_time',
                room_number='$room_number'
            WHERE schedule_id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_schedule.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$sql = "SELECT * FROM class_schedule WHERE schedule_id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Schedule</title>
</head>

<body>

<h2>Update Class Schedule</h2>

<form method="post">

    Section ID:
    <input type="number" name="section_id"
           value="<?php echo $row['section_id']; ?>" required>
    <br><br>

    Day:
    <input type="text" name="day_of_week"
           value="<?php echo $row['day_of_week']; ?>" required>
    <br><br>

    Start Time:
    <input type="time" name="start_time"
           value="<?php echo $row['start_time']; ?>" required>
    <br><br>

    End Time:
    <input type="time" name="end_time"
           value="<?php echo $row['end_time']; ?>" required>
    <br><br>

    Room Number:
    <input type="text" name="room_number"
           value="<?php echo $row['room_number']; ?>" required>
    <br><br>

    <input type="submit" value="Update Schedule">

</form>

<br>

<a href="view_schedule.php">Back to Schedule</a>

</body>
</html>
