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

$sql = "DELETE FROM faculty WHERE faculty_id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: view_faculty.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
