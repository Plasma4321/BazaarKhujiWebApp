<?php
include "Connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $age = $_POST["age"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"]; 

    $sql = "INSERT INTO customers (Name, Age, PhoneNumber, Email, customer_password) VALUES ('$name', '$age', '$phone', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
