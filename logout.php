<?php
session_start(); // Start the session at the beginning

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: loginpageAdmin.php");
exit();
?>