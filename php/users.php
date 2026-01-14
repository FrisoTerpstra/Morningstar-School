<?php
    session_start(); // Start the session
    include "DBcon.php"; // Include the database connection file
    
    // Check if logged in
    if(!isset($_SESSION['username'])){
        header("Location: login.php"); // Redirect to login page
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="../css/users.css">
</head>
<body>

    <div class="container">
        <h1>Users List</h1>
        
        <div class="username">
            Logged in as: <?php echo $_SESSION['username']; ?>
        </div>

        <?php
        if($dbhandler){
            try{
                $stmt = $dbhandler->prepare("SELECT firstName, lastName, username FROM employee");
                $stmt->execute();

                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo "<table>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                    </tr>";

                foreach($users as $user){
                    echo "<tr>
                        <td>". $user['firstName'] . "</td>
                        <td>". $user['lastName'] . "</td>
                        <td>". $user['username'] . "</td>
                    </tr>";
                }
                echo "</table>";
            }catch(Exception $ex){
                printError($ex);
            }
        }
        ?>
        
        <button><a href="entry.php">Back to Entry Page</a></button>
    </div>

</body>
</html>