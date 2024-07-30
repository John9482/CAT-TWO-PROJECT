<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
    <img src="logo.png" alt="School Logo" class="logo">
        <h1>Students</h1>
    </header>
    <form name="studentForm" action="student.php" method="post" onsubmit="return validateStudentForm()">
        <label for="student_id">Student ID:</label>
        <input type="text" id="student_id" name="student_id"><br>
        <label for="student_name">Student Name:</label>
        <input type="text" id="student_name" name="student_name"><br>
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number"><br>
        <label for="course_details">Course Details:</label>
        <input type="text" id="course_details" name="course_details"><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>


<script>
    function validateStudentForm() {
    let studentId = document.forms["studentForm"]["student_id"].value;
    let studentName = document.forms["studentForm"]["student_name"].value;
    let phoneNumber = document.forms["studentForm"]["phone_number"].value;
    let courseDetails = document.forms["studentForm"]["course_details"].value;

    if (studentId == "" || studentName == "" || phoneNumber == "" || courseDetails == "") {
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
    $student_id = $_POST['student_id'];
    $student_name = $_POST['student_name'];
    $phone_number = $_POST['phone_number'];
    $course_details = $_POST['course_details'];

    $sql = "INSERT INTO course (student_id, student_name, phone_number, course_details)
    VALUES ('$student_id', '$student_name', '$phone_number', '$course_details')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>