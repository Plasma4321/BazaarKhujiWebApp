<?php
include "Connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $bazaarID = htmlspecialchars($_POST['bazaarID']);

    // Validate form data (add more validation as needed)
    if (empty($bazaarID)) {
        die("Please enter a bazaar ID.");
    }

    // Check if the bazaar ID exists in the database
    $sql = "SELECT * FROM bazaar WHERE bazaarID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bazaarID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        die("This bazaar does not exist in database.");
    }

    // Get the image file name from the database
    $row = $result->fetch_assoc();
    $image_file = $row["bazaarIMG"];

    $stmt->close();

    // Delete the record from the database using prepared statement
    $sql = "DELETE FROM bazaar WHERE bazaarID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bazaarID);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        die("Error deleting record: " . $stmt->error);
    }

    $stmt->close();

    // Delete the image file from the uploads folder
    if (unlink($image_file)) {
        echo " also Image file deleted successfully";
    } else {
        die("Error deleting image file.");
    }
}

$conn->close();
?>
