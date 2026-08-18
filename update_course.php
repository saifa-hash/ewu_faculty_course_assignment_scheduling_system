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

    $course_name = $_POST['course_name'];
    $credit_hours = $_POST['credit_hours'];
    $dept = $_POST['dept'];

    $sql = "UPDATE course
            SET course_name='$course_name',
                credit_hours='$credit_hours',
                dept='$dept'
            WHERE course_id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_course.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$sql = "SELECT * FROM course WHERE course_id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Course</title>
</head>

<body>

<h2>Update Course</h2>

<form method="post">

    Course Name:
    <input type="text" name="course_name"
           value="<?php echo $row['course_name']; ?>" required>
    <br><br>

    Credit Hours:
    <input type="number" name="credit_hours"
           value="<?php echo $row['credit_hours']; ?>" required>
    <br><br>

    Department:
    <input type="text" name="dept"
           value="<?php echo $row['dept']; ?>" required>
    <br><br>

    <input type="submit" value="Update Course">

</form>

<br>

<a href="view_course.php">Back to Courses</a>

</body>
</html>