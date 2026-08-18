<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

$sql = "SELECT * FROM course";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Courses</title>
</head>

<body>

<h2>Course List</h2>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Course Name</th>
    <th>Credit Hours</th>
    <th>Department</th>
    <th>Action</th>
</tr>

<?php

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<tr>";

        echo "<td>" . $row['course_id'] . "</td>";
        echo "<td>" . $row['course_name'] . "</td>";
        echo "<td>" . $row['credit_hours'] . "</td>";
        echo "<td>" . $row['dept'] . "</td>";

        echo "<td>";
        echo "<a href='update_course.php?id=" . $row['course_id'] . "'>Update</a> | ";
        echo "<a href='delete_course.php?id=" . $row['course_id'] . "'>Delete</a>";
        echo "</td>";

        echo "</tr>";
    }

} else {

    echo "<tr><td colspan='5'>No Courses Found</td></tr>";
}

?>

</table>

<br>

<a href="add_course.php">Add Course</a>
<br><br>

<a href="index.php">Back to Home</a>

</body>
</html>
