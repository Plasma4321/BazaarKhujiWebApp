<?php
session_start(); // Start the session at the beginning

// Check if the user is not logged in, then redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: loginpageAdmin.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <style>
        body {
            margin: 0;
        }

        .LOGOSECTION {
            text-align: center;
        }

        nav {
            background-color: #adf175;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0px 15px;
        }

        nav ul {
            list-style: none;
            display: flex;
        }

        nav li {
            margin: 0 50px;
        }

        nav a {
            text-decoration: none;
            color: #000000;
            font-weight: bold;
            font-size: 20px;
        }

        .social-box {
            background-color: #adf175;
            text-align: center;
            padding: 20px 0;
            margin: 0;
        }

        .MID{
            
        }
        .social-icon {
            font-size: 30px;
            color: #ff0000;
            margin: 0 20px;
            cursor: pointer;
            text-decoration: none;
        }

        table{
            margin-left: auto;
            margin-right: auto;
        }

        th, td {
            padding: 5px;
            text-align: center;
            background-color: #11131a;
            color: #40e200;
        }

        th {
            background-color: #11131a;
            color: #40e200;
        }

        form{
            color: red;
        }
        form input{
            color: green;
            margin-right: 20px;
            margin-bottom:5px;
        }
        form label{
            
        }

    </style>

    <title>AdminCustomer</title>

    <div class="LOGOSECTION">
        <img src="FatBat.jpg" alt="LOGO" style="width: 200px; height: 150px;">
    </div>
    <nav>
        <ul>
            <li><a href="admin_homepage.php">HOME</a></li>
            <li><a href="admin_bazaarpage.php">BAZAAR</a></li>
            <li><a href="admin_CUSTOMERpage.php">CUSTOMER</a></li>
            <li><a href="admin_Employeepage.php">EMPLOYEE</a></li>
        </ul>

        <a href="logout.php">Logout</a>
    </nav>
</head>
<body>

<div class="MID">

    <h2 style="text-align:center;">CUSTOMER TABLE</h2>
    
    <!-- VIEWING SCRIPT -->
    <?php
    include 'Connection.php';
    // SQL QUERY 
    $query = "SELECT customers.*, feedback.feedback_text FROM `customers` LEFT JOIN `feedback` ON customers.CustomerID = feedback.customerID;"; 
    // FETCHING DATA FROM DATABASE 
    $result = $conn->query($query); 
    
    if ($result->num_rows > 0)  
    { 
        echo "<table border='1'>";
        echo "<tr><th>CustomerID</th><th>Name</th><th>Age</th><th>Email</th><th>PhoneNumber</th><th>customer_password</th><th>Feedback Text</th></tr>";
        // OUTPUT DATA OF EACH ROW 
        while($row = $result->fetch_assoc()) 
        { 
            echo "<tr><td>" . $row["CustomerID"]. 
            "</td><td>" . $row["Name"].
            "</td><td>" . $row["Age"]. 
            "</td><td>" . $row["Email"].
            "</td><td>" . $row["PhoneNumber"]. 
            "</td><td>" . $row["customer_password"].
            "</td><td>" . $row["feedback_text"].
            "</td></tr>"; 
        } 
        echo "</table>";
    }  
    else { 
        echo "0 results"; 
    } 

    $conn->close(); 
    ?>
    

    <h2 style="text-align:center;">DELETE CUSTOMER</h2>
    <form method="post" action="">
        <div style="text-align:center;">
            <label for="deleteCustomerID">CustomerID to Delete:</label>
            <input type="text" id="deleteCustomerID" name="deleteCustomerID" required>
            <button type="submit">Delete</button>
        </div>
    </form>

    <!-- DELETION SCRIPT -->
    <?php
    include 'Connection.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteCustomerID"])) {
        $customerIDToDelete = $_POST["deleteCustomerID"];
    
        // Check if the customer ID exists in the database
        $checkQuery = "SELECT * FROM `customers` WHERE CustomerID = $customerIDToDelete";
        $checkResult = $conn->query($checkQuery);
        if ($checkResult->num_rows == 0) {
            echo "This customer ID does not exist in the database.";
        } else {
            // Delete feedback of the customer
            $deleteFeedbackQuery = "DELETE FROM `feedback` WHERE customerID = $customerIDToDelete";
            if ($conn->query($deleteFeedbackQuery) === TRUE) {
                echo "Feedback of the customer with ID $customerIDToDelete deleted successfully.";
            } else {
                echo "Error deleting feedback: " . $conn->error;
            }
        
            // Delete the customer
            $deleteCustomerQuery = "DELETE FROM `customers` WHERE CustomerID = $customerIDToDelete";
            if ($conn->query($deleteCustomerQuery) === TRUE) {
                echo "Customer with ID $customerIDToDelete deleted successfully.";
            } else {
                echo "Error deleting customer: " . $conn->error;
            }
        }
    }

    $conn->close();
    ?>

</div>

<footer>
    <div class="social-box">
        <a href="mailto:your-email@example.com" class="social-icon" target="_blank">
            <i class="fas fa-envelope"></i>
        </a>
        <a href="https://www.facebook.com/your-facebook-profile" class="social-icon" target="_blank">
            <i class="fab fa-facebook"></i>
        </a>
        <a href="tel:+1234567890" class="social-icon" target="_blank">
            <i class="fas fa-phone"></i>
        </a>
    </div>
</footer>

</body>
</html>
