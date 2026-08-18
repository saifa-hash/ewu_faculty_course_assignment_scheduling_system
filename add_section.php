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

    $course_id = $_POST['course_id'];
    $faculty_id = $_POST['faculty_id'];
    $semester = $_POST['semester'];

    $sql = "INSERT INTO section (course_id, faculty_id, semester)
            VALUES ('$course_id', '$faculty_id', '$semester')";

    if ($conn->query($sql) === TRUE) {
        echo "Section added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Section</title>
</head>

<body>

<h2>Add Section</h2>

<form method="post">

    Course ID:
    <input type="number" name="course_id" required>
    <br><br>

    Faculty ID:
    <input type="number" name="faculty_id" required>
    <br><br>

    Semester:
    <input type="text" name="semester" required>
    <br><br>

    <input type="submit" value="Add Section">

</form>

<br>

<a href="index.php">Back to Home</a>

</body>
</html>