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

    $name = $_POST['name'];
    $dept = $_POST['dept'];
    $designation = $_POST['designation'];

    $sql = "UPDATE faculty
            SET name='$name',
                dept='$dept',
                designation='$designation'
            WHERE faculty_id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_faculty.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$sql = "SELECT * FROM faculty WHERE faculty_id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Faculty</title>
</head>

<body>

<h2>Update Faculty</h2>

<form method="post">

    Name:
    <input type="text" name="name"
           value="<?php echo $row['name']; ?>" required>
    <br><br>

    Department:
    <input type="text" name="dept"
           value="<?php echo $row['dept']; ?>" required>
    <br><br>

    Designation:
    <input type="text" name="designation"
           value="<?php echo $row['designation']; ?>" required>
    <br><br>

    <input type="submit" value="Update Faculty">

</form>

<br>

<a href="view_faculty.php">Back to Faculty</a>

</body>
</html>