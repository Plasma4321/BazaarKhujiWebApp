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
        .show{
            background-color: #004f00;
            padding: 30%;
            color: #adf175;
        }
    </style>


    <title>AdminHome</title>

    
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

        
        <?php
        
            include 'Connection.php';
        
            // Query to show total employees
            $employees_query = "SELECT COUNT(*) as total_employees FROM employees";
            $employees_result = $conn->query($employees_query);
            $row_employees = $employees_result->fetch_assoc();
            $total_employees = $row_employees['total_employees'];

            // Query to show total customers
            $customers_query = "SELECT COUNT(*) as total_customers FROM customers";
            $customers_result = $conn->query($customers_query);
            $row_customers = $customers_result->fetch_assoc();
            $total_customers = $row_customers['total_customers'];

            // Close connection
            $conn->close();
            ?>
        
        <div class="show">
            <h1>Total Employees: <?php echo $total_employees; ?></h1>
            <h1>Total Customers: <?php echo $total_customers; ?></h1>
        </div>
        

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