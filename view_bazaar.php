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
    <title>BazaarProductsPage</title>
    <style>
        body{
            margin: 0;
            text-align:center;
            background-color:#cdf784;
            
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
            margin:auto;
        }

        th, td {
            padding: 50px;
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
            font-weight: bold;
        }
        form input{
            color: green;
            margin-right: 20px;
            margin-bottom:5px;
        }
        form label{
            
        }
        button{
            padding: 6px;
            background-color:#40e200; 
            border-radius:10px; 
            width:100px;
            color:white;
            border-color: #adf175;
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
    </style>

</head>
<body>


<h1>DISPLAYING</h1>

<!-- ADDING SCRIPT + ADDING VIEW -->
<?php
    include "Connection.php";

    // Get the bazaarID from the query parameter
    $bazaarID = $_GET["bazaarID"];

    // Query the database to get the bazaarname for the given bazaarID
    $sql = "SELECT bazaarname FROM bazaar WHERE bazaarID = $bazaarID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output the name
        $row = $result->fetch_assoc();
        echo "<h2>" . $row["bazaarname"] . "</h2>";
    } else {
        // Output a message if no name is found
        echo "<p>No name found for bazaarID: $bazaarID</p>";
    }

    // Query the database to get the bazaarImage for the given bazaarID
    $sql = "SELECT bazaarIMG FROM bazaar WHERE bazaarID = $bazaarID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output the image
        $row = $result->fetch_assoc();
        echo "<img src='" . $row["bazaarIMG"] . "' width='200' height='150'>";
    } else {
        // Output a message if no image is found
        echo "No image found for bazaarID: $bazaarID";
    }

    // Form for adding a new product
    echo "<h2>Add a new product</h2>
      <form action='add_product.php' method='post' enctype='multipart/form-data'>
        <input type='hidden' name='bazaarID' value='$bazaarID'>
        Product Name: <input type='text' name='productName' required>
        <br>
        Product Picture: <input type='file' name='productPicture' accept='.jpg,.png,.gif' required>
        <br>
        Product Price: <input type='text' name='productPrice' required>
        <br>
        <button type='submit'>Add Bazaar</button>
      </form>";

      $conn->close();
?>

    <h1>VIEW CURRENT PRODUCTS</h1>

<!-- VIEW SCRIPT -->
    <?php

        include "Connection.php";

        // Query the database to get all the products that have the same bazaarID as the current page
        $sql = "SELECT productID, productName, productPicture, bazaarID FROM product WHERE bazaarID = $bazaarID";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output the products in a table
            echo "<table>";
            echo "<tr><th>ProductID</th><th>ProductName</th><th>ProductPicture</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["productID"] . "</td>";
                echo "<td>" . $row["productName"] . "</td>";
                echo "<td><img src='" . $row["productPicture"] . "' width='200' height='150'></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            // Will Output this if no products are found
            echo "<p>No products added yet for this bazaar";
        }

        $conn->close();
    ?>


<h1>DELETE PRODUCT FROM CURRENT BAZAAR</h1>

<!-- DELETE SCRIPT inside file-->
<form method="POST" action="delete_product.php">
    <label for="productID">Product ID:</label><br>
    <input type="text" id="productID" name="productID" required><br>
    <input type="hidden" id="bazaarID" name="bazaarID" value="<?php echo $_GET['bazaarID']; ?>">
    <button type="submit">Delete Product</button>
</form>

</body>
</html>


