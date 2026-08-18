<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

$sql = "SELECT class_schedule.schedule_id,
               class_schedule.day_of_week,
               class_schedule.start_time,
               class_schedule.end_time,
               class_schedule.room_number,
               course.course_name
        FROM class_schedule
        JOIN section ON class_schedule.section_id = section.section_id
        JOIN course ON section.course_id = course.course_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Schedule</title>
</head>

<body>

<h2>Class Schedule</h2>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Course</th>
    <th>Section</th>
    <th>Day</th>
    <th>Start Time</th>
    <th>End Time</th>
    <th>Room</th>
    <th>Action</th>
</tr>

<?php

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<tr>";

        echo "<td>" . $row['schedule_id'] . "</td>";
        echo "<td>" . $row['course_name'] . "</td>";
        echo "<td>" . $row['day_of_week'] . "</td>";
        echo "<td>" . $row['start_time'] . "</td>";
        echo "<td>" . $row['end_time'] . "</td>";
        echo "<td>" . $row['room_number'] . "</td>";

        echo "<td>";
        echo "<a href='update_schedule.php?id=" . $row['schedule_id'] . "'>Update</a> | ";
        echo "<a href='delete_schedule.php?id=" . $row['schedule_id'] . "'>Delete</a>";
        echo "</td>";

        echo "</tr>";
    }

} else {

    echo "<tr><td colspan='8'>No Schedule Found</td></tr>";
}

?>

</table>

<br>

<a href="add_schedule.php">Add Schedule</a>
<br><br>

<a href="index.php">Back to Home</a>

</body>
</html>
