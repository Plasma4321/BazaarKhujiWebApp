

<?php

include "Connection.php";

    // Get the email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database
    $sql = "SELECT * FROM customers WHERE Email='$email' AND customer_password='$password'";
    $result = $conn->query($sql);

    // Check if the user exists
    if ($result->num_rows > 0) {
        // User exists, redirect to the customer homepage
        header("Location: customer_homepage.php");
    } else {
        // User does not exist or password is incorrect
        echo "Invalid email or password";
    }

    $conn->close();

?>