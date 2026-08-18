<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

$sql = "SELECT * FROM faculty";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Faculty</title>
</head>

<body>

<h2>Faculty List</h2>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Department</th>
    <th>Designation</th>
    <th>Action</th>
</tr>

<?php

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<tr>";

        echo "<td>" . $row['faculty_id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['dept'] . "</td>";
        echo "<td>" . $row['designation'] . "</td>";

        echo "<td>";
        echo "<a href='update_faculty.php?id=" . $row['faculty_id'] . "'>Update</a> | ";
        echo "<a href='delete_faculty.php?id=" . $row['faculty_id'] . "'>Delete</a>";
        echo "</td>";

        echo "</tr>";
    }

} else {

    echo "<tr><td colspan='5'>No Faculty Found</td></tr>";
}

?>

</table>

<br>

<a href="add_faculty.php">Add Faculty</a>
<br><br>

<a href="index.php">Back to Home</a>

</body>
</html>
