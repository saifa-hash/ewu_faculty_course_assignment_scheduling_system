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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $section_id = $_POST['section_id'];
    $day_of_week = $_POST['day_of_week'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $room_number = $_POST['room_number'];

    $sql = "INSERT INTO class_schedule
            (section_id, day_of_week, start_time, end_time, room_number)
            VALUES
            ('$section_id', '$day_of_week', '$start_time', '$end_time', '$room_number')";

    if ($conn->query($sql) === TRUE) {
        echo "Schedule added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Schedule</title>
</head>

<body>

<h2>Add Class Schedule</h2>

<form method="post">

    Section ID:
    <input type="number" name="section_id" required>
    <br><br>

    Day:
    <input type="text" name="day_of_week" placeholder="Sunday" required>
    <br><br>

    Start Time:
    <input type="time" name="start_time" required>
    <br><br>

    End Time:
    <input type="time" name="end_time" required>
    <br><br>

    Room Number:
    <input type="text" name="room_number" required>
    <br><br>

    <input type="submit" value="Add Schedule">

</form>

<br>

<a href="index.php">Back to Home</a>

</body>
</html>