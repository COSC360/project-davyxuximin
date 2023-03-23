<?php
session_start();
unset($_SESSION['user_id']); // Unset the user_id session variable
session_destroy(); // Destroy the session
header('Location: login.php'); // Redirect the user to the login page
exit();
?>
