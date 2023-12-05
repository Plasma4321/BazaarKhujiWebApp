<?php

    include "Connection.php";
    // Get the productID from the form
    $productID = $_POST['productID'];

    // Get the bazaarID from the form
    $bazaarID = $_POST['bazaarID'];

    // Prepare the SQL statement
    $sql = "SELECT * FROM product WHERE productID = ? AND bazaarID = ?";

    // Initialize the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("ii", $productID, $bazaarID);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if the product exists in the current bazaar
    if ($result->num_rows > 0) {
        // Prepare the SQL statement for deletion
        $sql = "DELETE FROM product WHERE productID = ? AND bazaarID = ?";

        // Initialize the statement
        $stmt = $conn->prepare($sql);

        // Bind the parameters
        $stmt->bind_param("ii", $productID, $bazaarID);

        // Execute the statement
        $stmt->execute();

        echo "The product has been deleted.";
    } 
    else {
        // Check if the product exists
        $sql = "SELECT * FROM product WHERE productID = ?";

        // Initialize the statement
        $stmt = $conn->prepare($sql);

        // Bind the parameters
        $stmt->bind_param("i", $productID);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "This product is not part of the current bazaar that you are browsing.";
        } else {
            echo "This product does not exist.";
        }
    }

    $conn->close();
?>