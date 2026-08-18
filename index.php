<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>EWU Faculty Course Assignment & Scheduling System</title>
</head>

<body>

<h2>EWU Faculty Course Assignment & Scheduling System</h2>

<p>
    Welcome, <?php echo $_SESSION['username']; ?>!
</p>

<p>
    Your role: <?php echo $_SESSION['role']; ?>
</p>

<ul>

    <?php
    // Admin can add, update and delete
    if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'Admin') {
    ?>

        <li><a href="add_faculty.php">Add Faculty</a></li>

    <?php } ?>

    <li><a href="view_faculty.php">View Faculty</a></li>


    <?php
    if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'Admin') {
    ?>

        <li><a href="add_course.php">Add Course</a></li>

    <?php } ?>

    <li><a href="view_course.php">View Courses</a></li>


    <?php
    if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'Admin') {
    ?>

        <li><a href="add_section.php">Add Section</a></li>

    <?php } ?>

    <li><a href="view_section.php">View Sections</a></li>


    <?php
    if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'Admin') {
    ?>

        <li><a href="add_schedule.php">Add Class Schedule</a></li>

    <?php } ?>

    <li><a href="view_schedule.php">View Schedule</a></li>


    <li><a href="logout.php">Logout</a></li>

</ul>

</body>
</html>s