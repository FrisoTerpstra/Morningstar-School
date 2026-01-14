<?php
session_start();
session_destroy(); // Clear session
header("Location: login.php"); // Redirect back to login page
?>