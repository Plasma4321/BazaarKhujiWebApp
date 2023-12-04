<?php
// Establish a connection to the database
include 'Connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $salary = $_POST["salary"];
    $place = $_POST["place"];
    $employee_password = $_POST["employee_password"];

    // Insert data into the 'employees' table
    $query = "INSERT INTO `employees` (Name, Age, Email, PhoneNumber, Salary, Place, employee_password)
              VALUES ('$name', '$age', '$email', '$phoneNumber', '$salary', '$place', '$employee_password')";

    if ($conn->query($query) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

?>