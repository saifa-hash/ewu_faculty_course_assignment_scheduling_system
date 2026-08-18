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

    $course_id = $_POST['course_id'];
    $faculty_id = $_POST['faculty_id'];
    $semester = $_POST['semester'];

    $sql = "UPDATE section
            SET course_id='$course_id',
                faculty_id='$faculty_id',
                semester='$semester'
            WHERE section_id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_section.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$sql = "SELECT * FROM section WHERE section_id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Section</title>
</head>

<body>

<h2>Update Section</h2>

<form method="post">

    Course ID:
    <input type="number" name="course_id"
           value="<?php echo $row['course_id']; ?>" required>
    <br><br>

    Faculty ID:
    <input type="number" name="faculty_id"
           value="<?php echo $row['faculty_id']; ?>" required>
    <br><br>


    Semester:
    <input type="text" name="semester"
           value="<?php echo $row['semester']; ?>" required>
    <br><br>

    <input type="submit" value="Update Section">

</form>

<br>

<a href="view_section.php">Back to Sections</a>

</body>
</html>
