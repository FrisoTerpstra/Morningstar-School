<?php
    // Start session at the very top
    session_start();

    include "DBcon.php"; // Include the database connection file
    
    // Check if user is logged in
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entry Page</title>
    <link rel="stylesheet" href="../css/entry.css">
</head>
<body>
    
    <div class="container">
        <h1>Welcome!</h1>
        
        <div class="username">
            <?php echo "Logged in as: " . $_SESSION['username']; ?>
        </div>

        <div class="buttons">
            <button><a href="users.php">View Users</a></button>
            <button><a href="http://localhost:8080">Database</a></button>
            <button><a href="logout.php">Logout</a></button>
        </div>
    </div>
    
</body>
</html>