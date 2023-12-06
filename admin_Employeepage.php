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
        body{
            margin: 0;
        }
        .LOGOSECTION{
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

        .social-icon {
            font-size: 30px;
            color: #ff0000;
            margin: 0 20px;
            cursor: pointer;
            text-decoration: none;
        }
        .MID{

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
        button{
            padding 5px;
            background-color:cyan; 
            border-radius:5px; 
            width:100px;

        }
        
    
    </style>


    <title>AdminEmployee</title>

    
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

    <h2 style="text-align:center;">EMPLOYEE TABLE</h2>

    <!-- VIEWING SCRIPT -->
    <?php
    include 'Connection.php';
    // SQL QUERY 
    $query = "SELECT market_representative.*, bazaar.bazaarname FROM `market_representative` LEFT JOIN `bazaar` ON market_representative.EmployeeID = bazaar.EmployeeID;"; 
    // FETCHING DATA FROM DATABASE 
    $result = $conn->query($query); 
    
    if ($result->num_rows > 0)  
    { 
        echo "<table border='1'>";
        echo "<tr><th>EmployeeID</th><th>Name</th><th>Age</th><th>Email</th><th>PhoneNumber</th><th>Salary</th><th>Bazaar Name</th><th>employee_password</th></tr>";
        // OUTPUT DATA OF EACH ROW 
        while($row = $result->fetch_assoc()) 
        { 
            echo "<tr><td>" . $row["EmployeeID"]. 
            "</td><td>" . $row["Name"].
            "</td><td>" . $row["Age"]. 
            "</td><td>" . $row["Email"].
            "</td><td>" . $row["PhoneNumber"]. 
            "</td><td>" . $row["Salary"].
            "</td><td>" . $row["bazaarname"].
            "</td><td>" . $row["employee_password"].
            "</td></tr>"; 
        } 
        echo "</table>";
    }  
    else { 
        echo "0 results"; 
    } 

    $conn->close(); 
    ?>


    </div>
    

    <h2 style="text-align:center;">Insert Employee Data</h2>

    <!-- INSERT SCRIPT INSIDE ACTION FILE -->
    <form action="insert_employeedata.php" method="post">

        <div style="display:flex; ">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="age">Age:</label>
            <input type="text" id="age" name="age" required>
        </div>

        <div style="display:flex;">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            <label for="employee_password">Password:</label>
            <input type="password" id="employee_password" name="employee_password" required>
            
        </div>

        <div style="display:flex;">
            <label for="salary">Salary:</label>
            <input type="text" id="salary" name="salary" required>
            <label for="phoneNumber">Phone Number:</label>
            <input type="text" id="phoneNumber" name="phoneNumber" required>
        </div>

        <div style="text-align:center;">
            <button  type="submit">Insert</button>
        </div>
    </form>
    
    
    <h2 style="text-align:center;">DELETE EMPLOYEE</h2>
    <form action="" method="post" >
        <div style="text-align:center;">
            <label for="deleteEmployeeID">EmployeeID to Delete:</label>
            <input type="text" id="deleteEmployeeID" name="deleteEmployeeID" required>
            <button type="submit">Delete</button>
        </div>
    </form>

    <!-- DELETION SCRIPT -->
    <?php
    include 'Connection.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteEmployeeID"])) {
        $employeeIDToDelete = $_POST["deleteEmployeeID"];
    
        // Performing the delete operation
        $deleteQuery = "DELETE FROM `market_representative` WHERE EmployeeID = $employeeIDToDelete";
        if ($conn->query($deleteQuery) === TRUE) {
            echo "Employee with ID $employeeIDToDelete deleted successfully.";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
    $conn->close();
    ?>


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