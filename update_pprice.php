<?php
include 'Connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["changePrice"])) {
    $productId = $_POST["productId"];
    $newPrice = $_POST["newPrice"];

    // Validate and sanitize input as needed

    // Update product price in the database
    $updateQuery = "UPDATE `product` SET productPrice = '$newPrice' WHERE productID = '$productId'";
    $updateResult = $conn->query($updateQuery);

    if ($updateResult) {
        echo "<p>Product price updated successfully!</p>";
    } else {
        echo "<p>Error updating product price: " . $conn->error . "</p>";
    }
}
?>