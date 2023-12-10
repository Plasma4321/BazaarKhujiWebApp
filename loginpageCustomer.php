<?php
include "Connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>CUSTOMER LOGIN</title>


    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #053262;
            color: #053262;
        }
        p{
            font-weight: bold;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            
        }

        .form-container {
            background-color: #90F0CC;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            width: 80%;
            height: 60%;
        }

        .form-container .form-image {
            flex: 1;
            background: url('hello-2488.gif') center/cover no-repeat ;
            position: relative;
        }

        .LOGINTYPE{
            display:flex;
            text-align:center;
            justify-content:right;
            margin-bottom: 20px;
        }

        .text_on_pic{
            color: black;
            top: 10%;
            position: absolute;
            width: 100%;
            text-align: center;
            justify-content: center;
        }

        .info {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .info i {
            margin-right: 10px;
        }

        .form-container .form-content {
            flex: 1;
            padding: 20px;
        }

        .form-container form {
            max-width: 400px;
            margin: 0 auto;
        }

        .form-container label, .form-container input, .form-container button {
            display: block;
            margin-bottom: 5px;
        }
        .form-container input, .form-container textarea{
            width: 70%;
        }

        .form-container button {
            margin: 1%;
            background-color: #053262;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 70%;
        }
        
    </style>
    


</head>
<body>



<div class="container">
    <div class="form-container">
        <div class="form-image">
            <div class="text_on_pic">
                    
                <h2>Address</h2>
                <div class="info">
                    <i class="icon fas fa-map-marker-alt"></i>
                    <p>Bangladesh, Dhanmondi</p>
                </div>
                <h2>Phone</h2>
                <div class="info">
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                    <p >+880 123456789</p>
                </div>
                <h2>Support</h2>
                <div class="info">

                    <i class="fa fa-envelope-open" aria-hidden="true"></i>
                    <a href="mailto:admin@gmail.com?subject=NeedHelp&body=whatiwanttotypeis">admin@gmail.com</a>
                </div>
            </div>
        </div>
        

        <div class="form-content">
        <h3 style=text-align:center;>SELECT USER TYPE </h3>
            <div class=LOGINTYPE>
                
                
            <select id="userType">
                <option value="">Select...</option>
                <option value="loginpageCustomer.php">Customer</option>
                <option value="loginpageRepresentative.php">Bazaar Representative</option>
                <option value="loginpageAdmin.php">Admin</option>
            </select>
        <button type="button" onclick="redirectToPage()">Select</button>
            </div>

            <!-- Depending on btn either REG/LOG will show -->
            <button style="padding: 2px;width:100px;display:flex; " onclick="showRegisterForm()">Register</button>
            <button style="padding: 2px;width:100px;display:flex; " onclick="showLoginForm()">Login</button>
            

            <div id="loginForm" style="display:none">
            <h2>Login</h2>
            <form action="/submit_login" method="post">
                Email:<br>
                <input type="text" name="email"><br>
                Password:<br>
                <input type="password" name="password"><br><br>
                <input type="submit" value="Submit">
            </form> 
            </div>

            <div id="registerForm" style="display:none">
            <h2>Register</h2>
            <form action="submit_register.php" method="post">
                Name:
                <input type="text" name="name">
                Age:
                <input type="text" name="age">
                Phone Number:
                <input type="text" name="phone">
                Email:
                <input type="text" name="email">
                Password:
                <input type="password" name="password"><br><br>
                <input type="submit" value="Submit">
            </form> 

            </div>
            
        </div>
    </div>
</div>


<script>
function redirectToPage() {
  var x = document.getElementById("userType").value;
  if (x) {
    window.location.href = x;
  }
}

function showLoginForm() {
  document.getElementById('loginForm').style.display='block';
  document.getElementById('registerForm').style.display='none';
}

function showRegisterForm() {
  document.getElementById('registerForm').style.display='block';
  document.getElementById('loginForm').style.display='none';
}
</script>

</body>
</html>