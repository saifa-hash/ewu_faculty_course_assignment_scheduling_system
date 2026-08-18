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

    $name = $_POST['name'];
    $dept = $_POST['dept'];
    $designation = $_POST['designation'];

    $sql = "INSERT INTO faculty (name, dept, designation)
            VALUES ('$name', '$dept', '$designation')";

    if ($conn->query($sql) === TRUE) {
        echo "Faculty added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Faculty</title>
</head>

<body>

<h2>Add Faculty</h2>

<form method="post">

    Name:
    <input type="text" name="name" required>
    <br><br>

    Department:
    <input type="text" name="dept" required>
    <br><br>

    Designation:
    <input type="text" name="designation" required>
    <br><br>

    <input type="submit" value="Add Faculty">

</form>

<br>

<a href="index.php">Back to Home</a>

</body>
</html>
