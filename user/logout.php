<?php
// Start the session if it's not already started
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect the user to a login page or any other page you prefer
header("Location: login.php");
exit();
?>