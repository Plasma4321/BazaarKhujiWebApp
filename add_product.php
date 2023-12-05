<?php
    include "Connection.php";

    // Get the form data
    $bazaarID = $_POST["bazaarID"];
    $productName = $_POST["productName"];
    $productPrice = $_POST["productPrice"];

    // Check if file was uploaded
    if(isset($_FILES['productPicture'])) {
        $file = $_FILES['productPicture'];

        // File properties
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];

        // Work out the file extension
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        // Check if the file is of the correct format
        if($file_ext === 'jpg' || $file_ext === 'png' || $file_ext === 'gif') {
            if($file_error === 0) {
                if($file_size <= 2097152) {
                    $file_name_new = uniqid('', true) . '.' . $file_ext;
                    $file_destination = 'uploads/' . $file_name_new;

                    if(move_uploaded_file($file_tmp, $file_destination)) {
                        // Insert the new product into the product table
                        $sql = "INSERT INTO product (productName, productPicture, productPrice, bazaarID) VALUES ('$productName', '$file_destination', '$productPrice', '$bazaarID')";
                        if ($conn->query($sql) === TRUE) {
                            echo "New product added successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                } else {
                    echo "Your file is too big!";
                }
            } else {
                echo "There was an error uploading your file!";
            }
        } else {
            echo "You can't upload files of this type!";
        }
    }

    $conn->close();
?>
