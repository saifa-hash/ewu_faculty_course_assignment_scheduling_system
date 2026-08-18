<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

$sql = "SELECT section.section_id,
               section.semester,
               course.course_name,
               faculty.name AS faculty_name
        FROM section
        JOIN course ON section.course_id = course.course_id
        JOIN faculty ON section.faculty_id = faculty.faculty_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Sections</title>
</head>

<body>

<h2>Section List</h2>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Course</th>
    <th>Faculty</th>
    <th>Semester</th>
    <th>Action</th>
</tr>

<?php

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<tr>";

        echo "<td>" . $row['section_id'] . "</td>";
        echo "<td>" . $row['course_name'] . "</td>";
        echo "<td>" . $row['faculty_name'] . "</td>";
        echo "<td>" . $row['semester'] . "</td>";

        echo "<td>";
        echo "<a href='update_section.php?id=" . $row['section_id'] . "'>Update</a> | ";
        echo "<a href='delete_section.php?id=" . $row['section_id'] . "'>Delete</a>";
        echo "</td>";

        echo "</tr>";
    }

} else {

    echo "<tr><td colspan='5'>No Sections Found</td></tr>";
}

?>

</table>

<br>

<a href="add_section.php">Add Section</a>
<br><br>

<a href="index.php">Back to Home</a>

</body>
</html>