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
    $bazaar_image_file = $row["bazaarIMG"];

    $stmt->close();

    // Get all product images associated with the bazaar
    $sql = "SELECT productPicture FROM product WHERE bazaarID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bazaarID);
    $stmt->execute();
    $result = $stmt->get_result();

    $product_images = [];
    while ($row = $result->fetch_assoc()) {
        $product_images[] = $row["productPicture"];
    }

    $stmt->close();

    // Delete all products associated with the bazaar
    $sql = "DELETE FROM product WHERE bazaarID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bazaarID);

    if ($stmt->execute()) {
        echo "All products associated with the bazaar deleted successfully";
    } else {
        die("Error deleting products: " . $stmt->error);
    }

    $stmt->close();

    // Delete the record from the database using prepared statement
    $sql = "DELETE FROM bazaar WHERE bazaarID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bazaarID);

    if ($stmt->execute()) {
        echo " | Record deleted successfully | ";
    } else {
        die("Error deleting record: " . $stmt->error);
    }

    $stmt->close();

    // Delete the bazaar image file from the uploads folder
    if (unlink($bazaar_image_file)) {
        echo "Bazaar image file deleted successfully";
    } else {
        die("Error deleting bazaar image file.");
    }

    // Delete the product image files from the uploads folder
    foreach ($product_images as $image_file) {
        if (unlink($image_file)) {
            echo " | Product image file $image_file deleted successfully | ";
        } else {
            die("Error deleting product image file $image_file.");
        }
    }
}

$conn->close();
?>
