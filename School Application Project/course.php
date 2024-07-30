<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
    <img src="logo.png" alt="School Logo" class="logo">
        <h1>Courses</h1>
    </header>
    <form name="courseForm" action="course.php" method="post" onsubmit="return validateCourseForm()">
        <label for="course_id">Course ID:</label>
        <input type="text" id="course_id" name="course_id"><br>
        <label for="course_name">Course Name:</label>
        <input type="text" id="course_name" name="course_name"><br>
        <label for="department">Department:</label>
        <input type="text" id="department" name="department"><br>
        <label for="class_hall">Class Hall:</label>
        <input type="text" id="class_hall" name="class_hall"><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
<script>
    function validateCourseForm() {
    let courseId = document.forms["courseForm"]["course_id"].value;
    let courseName = document.forms["courseForm"]["course_name"].value;
    let department = document.forms["courseForm"]["department"].value;
    let classHall = document.forms["courseForm"]["class_hall"].value;

    if (courseId == "" || courseName == "" || department == "" || classHall == "") {
        alert("All fields must be filled out");
        return false;
    }
    return true;
}
</script>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

// Create connection
$conn = new mysqli('localhost','root','','school');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = $_POST['course_id'];
    $course_name = $_POST['course_name'];
    $department = $_POST['department'];
    $class_hall = $_POST['class_hall'];

    $sql = "INSERT INTO course (course_id, course_name, department, class_hall)
    VALUES ('$course_id', '$course_name', '$department', '$class_hall')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

