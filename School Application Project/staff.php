<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
    <img src="logo.png" alt="School Logo" class="logo">
        <h1>Staff</h1>
    </header>
    <form name="staffForm" action="staff.php" method="post" onsubmit="return validateStaffForm()">
        <label for="staff_id">Staff ID:</label>
        <input type="text" id="staff_id" name="staff_id"><br>
        <label for="staff_name">Staff Name:</label>
        <input type="text" id="staff_name" name="staff_name"><br>
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number"><br>
        <label for="course_description">Course Description:</label>
        <input type="text" id="course_description" name="course_description"><br>
        <input type="submit" valuse="Submit">
    </form>
</body>
</html>

<script>
    function validateStaffForm() {
    let staffId = document.forms["staffForm"]["staff_id"].value;
    let staffName = document.forms["staffForm"]["staff_name"].value;
    let phoneNumber = document.forms["staffForm"]["phone_number"].value;
    let courseDescription = document.forms["staffForm"]["course_description"].value;

    if (staffId == "" || staffName == "" || phoneNumber == "" || courseDescription == "") {
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
    $staff_id = $_POST['staff_id'];
    $staff_name = $_POST['staff_name'];
    $phone_number = $_POST['phone_number'];
    $course_description = $_POST['course_description'];

    $sql = "INSERT INTO course (staff_id, staff_name, phone_number, course_description)
    VALUES ('$staff_id', '$staff_name', '$phone_number', '$course_description')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>