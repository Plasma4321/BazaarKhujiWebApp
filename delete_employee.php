<?php
    include 'Connection.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteEmployeeID"])) {
        $employeeIDToDelete = $_POST["deleteEmployeeID"];
        
        // Check if EmployeeID exists in the employee table
        $checkEmployeeQuery = "SELECT * FROM `market_representative` WHERE EmployeeID = $employeeIDToDelete";
        $employeeResult = $conn->query($checkEmployeeQuery);
        
        if ($employeeResult->num_rows == 0) {
            echo "This EmployeeID does not exist.";
        } else {
            // Check if EmployeeID exists in the bazaar table
            $checkBazaarQuery = "SELECT * FROM `bazaar` WHERE EmployeeID = $employeeIDToDelete";
            $bazaarResult = $conn->query($checkBazaarQuery);
            
            if ($bazaarResult->num_rows > 0) {
                echo "Unfortunately with our current System You need to delete The Bazaar that the Employee Is Assigned To, Then You Can Delete This Employee";
            } else {
                // Performing the delete operation
                $deleteQuery = "DELETE FROM `market_representative` WHERE EmployeeID = $employeeIDToDelete";
                if ($conn->query($deleteQuery) === TRUE) {
                    echo "Employee with ID $employeeIDToDelete deleted successfully.";
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            }
        }
    }
    $conn->close();
    ?>