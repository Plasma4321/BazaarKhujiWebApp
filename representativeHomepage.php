<?php
session_start(); // Start the session at the beginning

// Check if the user is not logged in, then redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: representativeHomepage.php");
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
            background-color: #053262;
            
        }
        .LOGOSECTION{
            text-align: center;
        }
        h1{
            color: #FFF5EE;
            text-align: center;
        }
        nav {
            background-color: #6CF1C4;
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
            background-color: #59F6B0;
            text-align: center; 
            padding: 20px 0;
            margin: 0;
        }

        .social-icon {
            font-size: 30px;
            color: #053262;
            margin: 0 20px;
            cursor: pointer;
            text-decoration: none;
        }
        .show{
            background-color: #C7F6FF;
            padding: 20%;
            text-align:center;
            color: black;
        }

        table {
            width: 60%;
            margin: auto; /* Center the table */
            border-collapse: collapse;
            margin-bottom: 50px;
        }
        
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        
        th {
            background-color: #f2f2f2;
        }
        td{
            color: #FFF5EE;
        }

        .changepprice {
        margin-top: 20px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 300px;
        margin: 0 auto;
    }

    .changepprice h3 {
        margin-bottom: 10px;
        font-size: 18px;
        color: #333;
    }

    .changepprice label {
        display: block;
        margin-bottom: 8px;
        color: #555;
    }

    .changepprice input {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .changepprice button {
        background-color: #4caf50;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .changepprice button:hover {
        background-color: #45a049;
    }
    </style>


    <title>RepresentativeHome</title>

    
    <div class="LOGOSECTION">
        <img src="Logo.png" alt="LOGO" style="width: 200px; height: 150px;">
    </div>
    <nav>
        <a href="logout.php">Logout</a>
    </nav>
    
</head>



<body>
    
<h1>DISPLAYING</h1>

<!-- ADDING SCRIPT + ADDING VIEW -->
<?php
// After successful login
// Get the email of the logged-in user

include "Connection.php";

$email = $_SESSION['email'];

// Query to get the EmployeeID
$employeeQuery = "SELECT * FROM `market_representative` WHERE Email = '$email'";
$employeeResult = mysqli_query($conn, $employeeQuery);

if ($employeeResult && mysqli_num_rows($employeeResult) > 0) {
    // Fetch the employee data
    $employeeData = mysqli_fetch_assoc($employeeResult);
    $employeeID = $employeeData['EmployeeID'];

    // Query to get the bazaar details
    $bazaarQuery = "SELECT * FROM `bazaar` WHERE EmployeeID = '$employeeID'";
    $bazaarResult = mysqli_query($conn, $bazaarQuery);

    // Check for query execution success
    if ($bazaarResult) {
        // Check if a row is returned, indicating the bazaar exists
        if (mysqli_num_rows($bazaarResult) > 0) {
            // Fetch the bazaar data
            $bazaarData = mysqli_fetch_assoc($bazaarResult);

            // Now you can display the bazaar data on the page
            // For example, to display the bazaar name:
            echo "<h1>Bazaar Name: " . $bazaarData['bazaarname'] . "</h1>";
        } else {
            // No bazaar assigned to this representative
            echo "No bazaar assigned.";
        }
    } else {
        // Query execution failed
        echo "Database error: " . mysqli_error($conn);
    }
} else {
    // Employee not found or query execution failed
    echo "Employee not found or database error: " ;
}
?>

<div >

    <h2 style="text-align:center;">EMPLOYEE TABLE</h2>

    <!-- VIEWING SCRIPT -->
    <?php
    include 'Connection.php';
    // SQL QUERY  
    $query = "SELECT productID, productName, productPrice, productPicture 
    FROM
        product p
    JOIN
        bazaar b ON p.bazaarID = b.bazaarID
    JOIN
        market_representative m ON b.EmployeeID = m.EmployeeID
    WHERE
        m.Email = '$email';"; 
    // FETCHING DATA FROM DATABASE 
    $result = $conn->query($query); 
    
    if ($result->num_rows > 0)  
    { 
        echo "<table border='1'>";
        echo "<tr><th>Product ID</th><th>Product Name</th><th>Product Price</th><th>Product Picture</th></tr>";
        // OUTPUT DATA OF EACH ROW 
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["productID"]. "</td>
                    <td>" . $row["productName"]. "</td>
                    <td>" . $row["productPrice"]. "</td>
                    <td><img src='" . $row["productPicture"]. "' alt='Product Image' width='200' height='150'></td>
                  </tr>";
        }
        
        echo "</table>";
    }
    else { 
        echo "0 results"; 
    } 

    $conn->close(); 
    ?>


    </div>

    <?php
        include 'update_pprice.php'; // Include the file containing the update logic
    ?>

    <div class="changepprice">
         <!-- FORM FOR UPDATING PRODUCT PRICE -->
         <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h3>Change Product Price:</h3>
            <label for="productId">Product ID:</label>
            <input type="text" name="productId" required>

            <label for="newPrice">New Price:</label>
            <input type="text" name="newPrice" required>

            <button type="submit" name="changePrice">Change</button>
        </form>
    </div>

    <script>
    // JavaScript to reload the page after form submission
    <?php if (isset($_POST["changePrice"])) : ?>
        // Check if the form was submitted and refresh the page
        window.location.href = window.location.pathname + window.location.search + window.location.hash;
    <?php endif; ?>
</script>

 </body>

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

</html>