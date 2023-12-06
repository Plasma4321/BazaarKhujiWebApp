<?php
include "Connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $bazaarName = htmlspecialchars($_POST['bazaarName']);
    $bazaarLocation = htmlspecialchars($_POST['bazaarLocation']);
    $employeeID = htmlspecialchars($_POST['employeeID']);

    // Check if the employee ID exists in the database
    $sql = "SELECT * FROM market_representative WHERE EmployeeID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $employeeID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        die("This Employee does not exist in database.");
    }

    $stmt->close();

    // Check if the employee ID is already assigned to another bazaar
    $sql = "SELECT * FROM bazaar WHERE EmployeeID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $employeeID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        die("1 Representative can only Represent 1 Bazaar.");
    }

    $stmt->close();

    // Upload the image
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["bazaarImage"]["name"]);

    // Check if the file is an image
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        die("Sorry, only JPG, JPEG, and PNG files are allowed.");
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["bazaarImage"]["tmp_name"], $target_file)) {
        // Insert the data into the database using prepared statement
        $sql = "INSERT INTO bazaar (bazaarname, bazaarlocation, EmployeeID, bazaarIMG) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $bazaarName, $bazaarLocation, $employeeID, $target_file);

        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            die("Error inserting record: " . $stmt->error);
        }

        $stmt->close();
    } else {
        die("Error uploading file.");
    }
}

$conn->close();
?>
