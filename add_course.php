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

    $course_name = $_POST['course_name'];
    $credit_hours = $_POST['credit_hours'];
    $dept = $_POST['dept'];

    $sql = "INSERT INTO course (course_name, credit_hours, dept)
            VALUES ('$course_name', '$credit_hours', '$dept')";

    if ($conn->query($sql) === TRUE) {
        echo "Course added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Course</title>
</head>

<body>

<h2>Add Course</h2>

<form method="post">

    Course Name:
    <input type="text" name="course_name" required>
    <br><br>

    Credit Hours:
    <input type="number" name="credit_hours" required>
    <br><br>

    Department:
    <input type="text" name="dept" required>
    <br><br>

    <input type="submit" value="Add Course">

</form>

<br>

<a href="index.php">Back to Home</a>

</body>
</html>
