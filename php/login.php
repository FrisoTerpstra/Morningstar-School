<?php

    session_start(); // Start the session to manage user sessions

    include "DBcon.php"; //Connection to database
    $error = array(); //Array to hold errors

    function login(){   
         
        // Use globals to access outside variables
        global $dbhandler;
        global $error;

        // Get data from the form and sanitize it
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $passwordd = filter_input(INPUT_POST, "passwordd", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // checks for errors and if so then add them to $error array
        if(empty($username)){
            $error[] = "please add a username";
        }
        if(empty($passwordd)){
            $error[] = "please add a password";
        }

        // If no errors, proceed with login
        if(empty($error)){
            if($dbhandler){
                try{
                $stmt = $dbhandler->prepare("SELECT * FROM `employee` WHERE username = :username"); // prepare the query
                $stmt->bindParam(":username", $username, PDO::PARAM_STR); // bind the username from the self made variable to the ':username' in the query from the database
                $stmt->execute(); // execute the query
                $user = $stmt->fetch(PDO::FETCH_ASSOC); // fetch the user data as an associative array (basicly get all the data from that user)
                if($user && $passwordd === $user['passwordd']){ // check if user exists and password matches
                    $_SESSION['employee_id'] = $user['employee_id']; // set session variable for user id
                    $_SESSION['username'] = $user['username']; // set session variable for username
                    header("Location: entry.php"); // redirect to entry page
                    exit(); // exit to make sure no code is run after the redirect
                }else{
                    $error[] = "Wrong username or password"; // add error if login fails
                }
                
                $stmt->closeCursor(); // close the connection to the database

            }catch(Exception $ex){  // catch any errors
                    printError($ex); // print the error using the printError function
                }
            }
        }
    }    

    if($_SERVER['REQUEST_METHOD'] == 'POST') { //check if the form is submitted
        login(); //call the login function
    }      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>
<body>

<?php
    if(!empty($error)){
        foreach($error as $errors){
            echo "<div>$errors</div>"; //prints each error in a div
        }
    }
?>

<form action="login.php" method="POST">
    <div>   
        <div>    
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">
        </div>    
        <div>
            <label for="passwordd">Password:</label>
            <input type="password" name="passwordd" id="password">
        </div>
        <div>
            <button type="submit">Log in</button>
        </div>
        <div><a href="register.php"> Back to Registration</a></div>
    </div>
</form>

</body>
</html>