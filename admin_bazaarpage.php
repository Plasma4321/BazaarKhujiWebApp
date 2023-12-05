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
            margin-top:20px;
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
        a{
            color: red;
        }
    </style>


    <title>AdminBazaar</title>

    
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


    
        
    <h2 style="text-align:center">BAZAAR TABLE</h2>
    <?php
        include "Connection.php";

        $sql = "SELECT bazaar.bazaarID, bazaar.bazaarname, bazaar.bazaarlocation,
                market_representative.Name, bazaar.bazaarIMG 
                FROM bazaar 
                INNER JOIN market_representative ON bazaar.EmployeeID = market_representative.EmployeeID";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>BazaarID</th><th>BazaarName</th><th>BazaarLocation</th><th>RepresentativeName</th><th>BazaarImage</th></tr>";
            while($row = $result->fetch_assoc()) {
                
                echo "<tr>";
                echo "<td><a href='view_bazaar.php?bazaarID=" . $row["bazaarID"] . "'>" . $row["bazaarID"] . "</a></td>";//Will TakeME toAPage
                echo "<td>" . $row["bazaarname"] . "</td>";
                echo "<td>" . $row["bazaarlocation"] . "</td>";
                echo "<td>" . $row["Name"] . "</td>";
                echo "<td><img src='" . $row["bazaarIMG"] . "' width='200' height='150'></td>";

                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo '<h2 style="
                        color: red;
                        background: url(\'Meow.jpg\') center/cover no-repeat;
                        text-align: center;
                        padding: 50px;">
                        No results found
                </h2>';
        }

        $conn->close();
    ?>

    <!-- here enchtype will basically allow me to use binary files as my input type:file for bazaar image -->
    <form action="add_bazaar.php" method="post" enctype="multipart/form-data">
        Bazaar Name: <input type="text" name="bazaarName"><br>
        Bazaar Location: <input type="text" name="bazaarLocation"><br>
        Employee ID: <input type="text" name="employeeID"><br>
        Bazaar Image: <input type="file" name="bazaarImage"><br>
        <div style="text-align:center">
            <button type="submit">ADD BAZAAR</button>
        </div>
    </form>
    
    <form action="delete_bazaar.php" method="post">
        Bazaar ID: <input type="text" name="bazaarID"><br>
        <div style="text-align:center">
            <button type="submit">DELETE BAZAAR</button>
        </div>
    </form>


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