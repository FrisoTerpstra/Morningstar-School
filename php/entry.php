<?php
    // Start session at the very top
    session_start();
    
    // Check if user is logged in
    if(!isset($_SESSION['username'])){
        header("Location: Hackerpage.php"); // Send back to hacker page
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <div>You are logged in yay</div>

    <?php
    echo "Logged in as: " . $_SESSION['username']; // shows the username of the logged in user
    ?>

    <button><a href="logout.php">Logout</a></button>
    
</body>
</html>